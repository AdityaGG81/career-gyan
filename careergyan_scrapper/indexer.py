import json
import logging
import chromadb
from chromadb.utils import embedding_functions
from openai import OpenAI

from config import (
    DATA_DIR,
    CHROMA_DIR,
    OPENAI_API_KEY,
    OPENAI_EMBEDDING_MODEL,
)

logging.basicConfig(level=logging.INFO, format="%(asctime)s [%(levelname)s] %(message)s")
logger = logging.getLogger("Indexer")

COLLECTION_NAME = "careergyan_kb"

def chunk_text(text, max_words=350, overlap_words=50):
    words = text.split()
    if len(words) <= max_words:
        return [text]

    chunks = []
    start = 0
    while start < len(words):
        end = start + max_words
        chunk = " ".join(words[start:end])
        chunks.append(chunk)
        if end >= len(words):
            break
        start += (max_words - overlap_words)
    return chunks

class KnowledgeIndexer:
    def __init__(self, api_key=OPENAI_API_KEY):
        self.api_key = api_key
        self.chroma_client = chromadb.PersistentClient(path=str(CHROMA_DIR))

        # Setup embedding function
        if self.api_key and self.api_key != "your_openai_api_key_here":
            self.embed_fn = embedding_functions.OpenAIEmbeddingFunction(
                api_key=self.api_key,
                model_name=OPENAI_EMBEDDING_MODEL
            )
            logger.info(f"Using OpenAI Embedding model: {OPENAI_EMBEDDING_MODEL}")
        else:
            logger.warning("No OpenAI API key detected. Using local default ChromaDB embedding function.")
            self.embed_fn = embedding_functions.DefaultEmbeddingFunction()

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
                embedding_function=self.embed_fn,
                metadata={"description": "CareerGyan Knowledge Base"}
            )


    def index_crawled_data(self, input_file=None):
        if input_file is None:
            input_file = DATA_DIR / "crawled_pages.json"

        if not input_file.exists():
            raise FileNotFoundError(f"Crawled data file not found at {input_file}. Run crawler.py first.")

        with open(input_file, "r", encoding="utf-8") as f:
            pages = json.load(f)

        logger.info(f"Loaded {len(pages)} pages from {input_file}. Starting chunking...")

        documents = []
        metadatas = []
        ids = []

        for page_idx, page in enumerate(pages):
            url = page["url"]
            title = page.get("title", "")
            meta_desc = page.get("meta_description", "")
            content = page.get("content", "")

            # Prefix chunk with page title and description context for superior vector retrieval
            header_context = f"Page Title: {title}\nURL: {url}\n"
            if meta_desc:
                header_context += f"Description: {meta_desc}\n"
            header_context += "\n"

            text_chunks = chunk_text(content, max_words=300, overlap_words=40)

            for chunk_idx, chunk in enumerate(text_chunks):
                chunk_id = f"doc_{page_idx}_chunk_{chunk_idx}"
                full_text = f"{header_context}{chunk}"

                documents.append(full_text)
                metadatas.append({
                    "url": url,
                    "title": title,
                    "chunk_index": chunk_idx,
                    "page_index": page_idx
                })
                ids.append(chunk_id)

        logger.info(f"Generated {len(documents)} total chunks. Inserting/Updating ChromaDB vector store...")

        # Batch upsert to ChromaDB in batches of 100
        batch_size = 100
        for i in range(0, len(documents), batch_size):
            b_docs = documents[i:i+batch_size]
            b_meta = metadatas[i:i+batch_size]
            b_ids = ids[i:i+batch_size]

            self.collection.upsert(
                ids=b_ids,
                documents=b_docs,
                metadatas=b_meta
            )
            logger.info(f"  Indexed batch {i//batch_size + 1}/{(len(documents)-1)//batch_size + 1} ({len(b_docs)} chunks)")

        total_count = self.collection.count()
        logger.info(f"Vector database indexing complete! Total vectors in collection: {total_count}")
        return total_count

if __name__ == "__main__":
    indexer = KnowledgeIndexer()
    indexer.index_crawled_data()
