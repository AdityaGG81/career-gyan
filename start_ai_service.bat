@echo off
echo =========================================================
echo       CareerGyan AI Scrapper & RAG Service Starter
echo =========================================================
echo.
cd /d "%~dp0careergyan_scrapper"
echo Starting FastAPI Q&A service on http://127.0.0.1:8001 ...
echo Press Ctrl+C to stop the service.
echo.
python -m uvicorn app:app --host 0.0.0.0 --port 8001 --reload
pause
