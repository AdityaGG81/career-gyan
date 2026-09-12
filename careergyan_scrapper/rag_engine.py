import logging
import chromadb
from chromadb.utils import embedding_functions
from openai import OpenAI

from config import (
    CHROMA_DIR,
    OPENAI_API_KEY,
    OPENAI_CHAT_MODEL,
    OPENAI_EMBEDDING_MODEL,
)
from indexer import COLLECTION_NAME

logging.basicConfig(level=logging.INFO, format="%(asctime)s [%(levelname)s] %(message)s")
logger = logging.getLogger("RAGEngine")

SYSTEM_PROMPT = """You are the official AI Career Counselor and Virtual Guide for **CareerGyan** (Indian Institute of Career Management - https://careergyan.in).

Your Mission:
1. Provide accurate, empathetic, and highly actionable educational and career guidance to students and parents based on the CareerGyan knowledge base.
2. Answer questions about:
   - Career exploration (over 5000+ career paths)
   - Aptitude tests and personalized guidance
   - College options (Engineering, Medical, Management, Defense, Tech, etc.)
   - Entrance exams (MHT CET, JEE Main/Advanced, NEET, CAT, etc.) and college cutoffs
   - Admission procedures, syllabus, and course details
3. Ground your answers in the provided website context. When relevant, cite the specific page URLs so the user can click directly to explore further on CareerGyan.
4. If a question is completely unrelated to education, careers, colleges, exams, or CareerGyan's services, politely redirect the student to focus on their academic and career goals.
5. Format your response cleanly using markdown (bullet points, bold key terms) for easy reading on mobile and desktop chatbots.
"""

class CareerGyanRAG:
    def __init__(self, api_key=OPENAI_API_KEY, chat_model=OPENAI_CHAT_MODEL):
        self.api_key = api_key
        self.chat_model = chat_model
        self.chroma_client = chromadb.PersistentClient(path=str(CHROMA_DIR))

        # Setup embedding function matching indexer
        if self.api_key and self.api_key != "your_openai_api_key_here":
            self.embed_fn = embedding_functions.OpenAIEmbeddingFunction(
                api_key=self.api_key,
                model_name=OPENAI_EMBEDDING_MODEL
            )
            self.openai_client = OpenAI(api_key=self.api_key)
        else:
            self.embed_fn = embedding_functions.DefaultEmbeddingFunction()
            self.openai_client = None

        try:
            self.collection = self.chroma_client.get_collection(
                name=COLLECTION_NAME,
                embedding_function=self.embed_fn
            )
        except Exception:
            try:
                self.chroma_client.delete_collection(name=COLLECTION_NAME)
            except Exception:
                pass
            self.collection = self.chroma_client.create_collection(
                name=COLLECTION_NAME,
                embedding_function=self.embed_fn
            )


    def retrieve(self, query: str, top_k: int = 5):
        try:
            results = self.collection.query(
                query_texts=[query],
                n_results=top_k
            )
            documents = results.get("documents", [[]])[0]
            metadatas = results.get("metadatas", [[]])[0]
            distances = results.get("distances", [[]])[0] if "distances" in results else []

            hits = []
            for idx in range(len(documents)):
                meta = metadatas[idx] if idx < len(metadatas) else {}
                hits.append({
                    "content": documents[idx],
                    "title": meta.get("title", ""),
                    "url": meta.get("url", ""),
                    "score": distances[idx] if idx < len(distances) else None
                })
            return hits
        except Exception as e:
            logger.error(f"Retrieval error: {e}")
            return []

    def answer_question(self, query: str, conversation_history: list = None, top_k: int = 5):
        # 1. Retrieve relevant website context
        hits = self.retrieve(query, top_k=top_k)

        # Deduplicate sources
        sources = []
        seen_urls = set()
        for hit in hits:
            u = hit.get("url")
            t = hit.get("title") or u
            if u and u not in seen_urls:
                seen_urls.add(u)
                sources.append({"title": t, "url": u})

        # 2. Build context string
        context_blocks = []
        for i, hit in enumerate(hits, 1):
            context_blocks.append(f"--- Document [{i}] Source: {hit['url']} ---\n{hit['content']}\n")
        context_text = "\n".join(context_blocks)

        # 3. Check if OpenAI API key is active
        if not self.openai_client or not self.api_key or self.api_key == "your_openai_api_key_here":
            # Helpful fallback response if API key is not yet set
            if hits:
                top_pages = "\n".join([f"- [{s['title']}]({s['url']})" for s in sources[:4]])
                reply = (
                    f"### CareerGyan Information Found\n\n"
                    f"I found the following relevant information on CareerGyan for your query **\"{query}\"**:\n\n"
                    f"{hits[0]['content'][:400]}...\n\n"
                    f"**Explore more on CareerGyan:**\n{top_pages}\n\n"
                    f"*(Note: Set your `OPENAI_API_KEY` in `.env` to enable full conversational LLM answers)*"
                )
            else:
                reply = (
                    f"Hello! I am the CareerGyan Assistant. Please set your `OPENAI_API_KEY` in `.env` "
                    f"and make sure the crawler has indexed the site."
                )
            return {"reply": reply, "sources": sources}

        # 4. Prepare chat messages
        messages = [{"role": "system", "content": SYSTEM_PROMPT}]

        # Append recent conversation history
        if conversation_history:
            for item in conversation_history[-6:]:
                role = item.get("role", "user")
                if role in ("user", "assistant"):
                    messages.append({"role": role, "content": item.get("content", "")})

        user_content = (
            f"Context from CareerGyan Website:\n"
            f"{context_text}\n\n"
            f"User Question: {query}\n\n"
            f"Provide a direct, helpful, and motivating answer based on the context above. Include relevant CareerGyan links from the context."
        )
        messages.append({"role": "user", "content": user_content})

        # 5. Call OpenAI
        try:
            response = self.openai_client.chat.completions.create(
                model=self.chat_model,
                messages=messages,
                temperature=0.3,
                max_tokens=800
            )
            reply = response.choices[0].message.content.strip()
            return {"reply": reply, "sources": sources}

        except Exception as e:
            logger.error(f"OpenAI completion error: {e}")
            return {
                "reply": f"Sorry, I encountered an issue connecting to the AI service: {str(e)}",
                "sources": sources
            }

if __name__ == "__main__":
    rag = CareerGyanRAG()
    res = rag.answer_question("What does CareerGyan offer for students?")
    print("REPLY:\n", res["reply"])
    print("\nSOURCES:\n", res["sources"])
