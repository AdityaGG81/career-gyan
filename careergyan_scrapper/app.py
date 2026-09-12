import json
import logging
from typing import List, Optional
from fastapi import FastAPI, BackgroundTasks, HTTPException
from fastapi.middleware.cors import CORSMiddleware
from fastapi.staticfiles import StaticFiles
from fastapi.responses import FileResponse, Response
from pydantic import BaseModel
from pathlib import Path

from config import DATA_DIR, TARGET_URL, PORT, HOST
from crawler import CareerGyanCrawler
from indexer import KnowledgeIndexer
from rag_engine import CareerGyanRAG

logging.basicConfig(level=logging.INFO, format="%(asctime)s [%(levelname)s] %(message)s")
logger = logging.getLogger("API")

app = FastAPI(
    title="CareerGyan Website Q&A API",
    description="Intelligent RAG Exploration & Question-Answering API for CareerGyan.in",
    version="1.0.0"
)

# Enable CORS for careergyan.in and any frontend chatbot integration
app.add_middleware(
    CORSMiddleware,
    allow_origins=["*"],
    allow_credentials=True,
    allow_methods=["*"],
    allow_headers=["*"],
)

# Initialize RAG Engine
rag_engine = CareerGyanRAG()

class ChatMessage(BaseModel):
    role: str
    content: str

class ChatRequest(BaseModel):
    message: str
    history: Optional[List[ChatMessage]] = []
    top_k: Optional[int] = 5

class SourceItem(BaseModel):
    title: str
    url: str

class ChatResponse(BaseModel):
    reply: str
    sources: List[SourceItem]
    status: str = "success"

@app.get("/api/status")
def get_status():
    crawled_file = DATA_DIR / "crawled_pages.json"
    pages_count = 0
    if crawled_file.exists():
        try:
            with open(crawled_file, "r", encoding="utf-8") as f:
                pages_count = len(json.load(f))
        except Exception:
            pass

    vectors_count = 0
    try:
        vectors_count = rag_engine.collection.count()
    except Exception:
        pass

    return {
        "status": "online",
        "target_url": TARGET_URL,
        "crawled_pages": pages_count,
        "indexed_chunks": vectors_count,
        "openai_configured": bool(rag_engine.openai_client and rag_engine.api_key)
    }

@app.post("/api/chat", response_model=ChatResponse)
def chat_endpoint(req: ChatRequest):
    if not req.message or not req.message.strip():
        raise HTTPException(status_code=400, detail="Message cannot be empty")

    history_dicts = [{"role": h.role, "content": h.content} for h in (req.history or [])]
    result = rag_engine.answer_question(
        query=req.message.strip(),
        conversation_history=history_dicts,
        top_k=req.top_k or 5
    )

    return ChatResponse(
        reply=result["reply"],
        sources=[SourceItem(**s) for s in result["sources"]],
        status="success"
    )

def run_crawl_and_index():
    logger.info("Background crawl initiated...")
    crawler = CareerGyanCrawler()
    crawler.run()
    logger.info("Crawl complete. Reindexing ChromaDB...")
    indexer = KnowledgeIndexer()
    indexer.index_crawled_data()
    logger.info("Background crawl and indexing finished!")

@app.post("/api/crawl")
def trigger_crawl(background_tasks: BackgroundTasks):
    background_tasks.add_task(run_crawl_and_index)
    return {"message": "Crawl & index job started in background"}

@app.get("/api/widget.js")
def get_widget_js():
    widget_path = Path(__file__).resolve().parent / "widget.js"
    if widget_path.exists():
        return Response(content=widget_path.read_text(encoding="utf-8"), media_type="application/javascript")
    return Response(content="// widget.js not found", media_type="application/javascript")

# Serve test UI
STATIC_DIR = Path(__file__).resolve().parent / "static"
STATIC_DIR.mkdir(exist_ok=True)
app.mount("/static", StaticFiles(directory=str(STATIC_DIR)), name="static")

@app.get("/")
def serve_home():
    index_html = STATIC_DIR / "index.html"
    if index_html.exists():
        return FileResponse(str(index_html))
    return {"message": "CareerGyan Q&A API is active. Go to /docs for Swagger UI."}

if __name__ == "__main__":
    import uvicorn
    uvicorn.run("app:app", host=HOST, port=PORT, reload=False)
