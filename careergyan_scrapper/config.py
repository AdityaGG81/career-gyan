import os
from pathlib import Path
from dotenv import load_dotenv

# Load .env file
load_dotenv()

BASE_DIR = Path(__file__).resolve().parent
DATA_DIR = BASE_DIR / "data"
CHROMA_DIR = BASE_DIR / "chroma_db"

DATA_DIR.mkdir(exist_ok=True)
CHROMA_DIR.mkdir(exist_ok=True)

# Configuration settings
OPENAI_API_KEY = os.getenv("OPENAI_API_KEY", "")
TARGET_URL = os.getenv("TARGET_URL", "https://careergyan.in")
OPENAI_EMBEDDING_MODEL = os.getenv("OPENAI_EMBEDDING_MODEL", "text-embedding-3-small")
OPENAI_CHAT_MODEL = os.getenv("OPENAI_CHAT_MODEL", "gpt-4o-mini")

PORT = int(os.getenv("PORT", "8000"))
HOST = os.getenv("HOST", "0.0.0.0")

# Crawler settings
MAX_CRAWL_PAGES = int(os.getenv("MAX_CRAWL_PAGES", "60"))
CRAWL_DELAY = float(os.getenv("CRAWL_DELAY", "0.4")) # seconds between requests to be polite
