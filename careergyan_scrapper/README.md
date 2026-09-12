# CareerGyan Website Exploration & Q&A API

An intelligent RAG (Retrieval-Augmented Generation) exploration and Q&A system for [CareerGyan.in](https://careergyan.in) powered by OpenAI.

---

## 🌟 Key Features
- **Automated Web Crawler**: Traverses `careergyan.in` sitemap and internal pages, extracting clean textual content, titles, and course/college catalogs.
- **Smart Vector Indexing**: Chunks pages with URL/heading context and indexes them into ChromaDB vector database.
- **OpenAI RAG Q&A Engine**: Answers user queries with high accuracy, motivation, and links directly back to CareerGyan pages using `gpt-4o-mini` and `text-embedding-3-small`.
- **REST API (FastAPI)**: Lightweight, high-performance API endpoint (`POST /api/chat`) ready for any chatbot frontend.
- **Interactive Control Center**: Visual testing sandbox at `http://localhost:8000` with real-time stats and query testing.
- **Drop-in Chatbot Widget**: Embed directly onto any page of CareerGyan with a single `<script>` line.

---

## 🚀 Quick Start Guide

### 1. Configure your OpenAI API Key
Edit the `.env` file in the project folder:
```env
OPENAI_API_KEY=sk-your-actual-openai-api-key-here
TARGET_URL=https://careergyan.in
OPENAI_CHAT_MODEL=gpt-4o-mini
OPENAI_EMBEDDING_MODEL=text-embedding-3-small
PORT=8000
```

### 2. Crawl and Index CareerGyan
Run the crawler and vector indexer (this scrapes `careergyan.in` and generates the knowledge embeddings):
```bash
python crawler.py
python indexer.py
```

### 3. Start the API Server
```bash
python app.py
```
Or with uvicorn:
```bash
uvicorn app:app --host 0.0.0.0 --port 8000 --reload
```

Open `http://localhost:8000` in your browser to view the **CareerGyan AI Control Center & Sandbox**.

---

## 🔌 Connecting to Your Website Chatbot

### Method A: Connect Your Existing Chatbot Code
In your website's chatbot JavaScript, send a `POST` request to `/api/chat`:

```javascript
async function askCareerGyanAI(userMessage) {
  const response = await fetch("http://localhost:8000/api/chat", {
    method: "POST",
    headers: { "Content-Type": "application/json" },
    body: JSON.stringify({
      message: userMessage,
      history: conversationHistory // Optional: [{role: "user", content: "..."}, {role: "assistant", content: "..."}]
    })
  });

  const data = await response.json();
  console.log("AI Answer:", data.reply);
  console.log("Verified Sources:", data.sources);
  return data;
}
```

### Method B: Drop-in Floating Chat Widget
Simply add this line to your website's HTML before `</body>`:
```html
<script src="http://localhost:8000/api/widget.js"></script>
```

---

## 📡 API Reference

### 1. `POST /api/chat`
**Request Body**:
```json
{
  "message": "What career guidance does CareerGyan offer for engineering?",
  "history": [],
  "top_k": 5
}
```
**Response**:
```json
{
  "reply": "CareerGyan offers comprehensive engineering guidance covering entrance exams (JEE Main, MHT CET), cutoff predictions, and reviews for top engineering colleges across Maharashtra and India...",
  "sources": [
    {
      "title": "Top Engineering Colleges in Maharashtra",
      "url": "https://careergyan.in/explore/engineering-colleges"
    }
  ],
  "status": "success"
}
```

### 2. `GET /api/status`
Returns current system health, number of indexed chunks, and crawled pages.

### 3. `POST /api/crawl`
Triggers an on-demand background recrawl of `careergyan.in` to refresh the knowledge base.
