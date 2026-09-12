import re
import time
import json
import logging
import xml.etree.ElementTree as ET
from urllib.parse import urljoin, urlparse
import requests
from bs4 import BeautifulSoup

from config import TARGET_URL, DATA_DIR, MAX_CRAWL_PAGES, CRAWL_DELAY

logging.basicConfig(level=logging.INFO, format="%(asctime)s [%(levelname)s] %(message)s")
logger = logging.getLogger("Crawler")

HEADERS = {
    "User-Agent": "CareerGyan-AI-Bot/1.0 (+https://careergyan.in/bot-info)"
}

class CareerGyanCrawler:
    def __init__(self, base_url=TARGET_URL, max_pages=MAX_CRAWL_PAGES):
        self.base_url = base_url.rstrip("/")
        self.domain = urlparse(self.base_url).netloc
        self.max_pages = max_pages
        self.visited = set()
        self.queue = []
        self.documents = []
        self.output_file = DATA_DIR / "crawled_pages.json"

    def is_valid_url(self, url):
        parsed = urlparse(url)
        # Stay on the same domain
        if parsed.netloc and parsed.netloc != self.domain:
            return False
        # Avoid static files, admin, auth, or query-heavy pagination duplicates
        path = parsed.path.lower()
        if any(path.endswith(ext) for ext in [".png", ".jpg", ".jpeg", ".gif", ".svg", ".css", ".js", ".ico", ".pdf", ".zip"]):
            return False
        if any(p in path for p in ["/admin", "/login", "/register", "/logout", "/password"]):
            return False
        return True

    def normalize_url(self, url):
        parsed = urlparse(urljoin(self.base_url, url))
        # strip anchor tags and trailing slashes
        clean_url = f"{parsed.scheme}://{parsed.netloc}{parsed.path}".rstrip("/")
        return clean_url if clean_url else self.base_url

    def fetch_sitemap_urls(self):
        sitemap_urls = []
        sitemap_locs = [
            f"{self.base_url}/sitemap.xml",
            f"{self.base_url}/sitemap-1.xml"
        ]
        
        for s_url in sitemap_locs:
            try:
                resp = requests.get(s_url, headers=HEADERS, timeout=10)
                if resp.status_code == 200:
                    root = ET.fromstring(resp.content)
                    # Support standard urlset or sitemapindex
                    for child in root:
                        for sub in child:
                            if "loc" in sub.tag:
                                loc = sub.text.strip()
                                if loc.endswith(".xml"):
                                    # Nested sitemap
                                    if loc not in sitemap_locs:
                                        sitemap_locs.append(loc)
                                elif self.is_valid_url(loc):
                                    sitemap_urls.append(self.normalize_url(loc))
            except Exception as e:
                logger.warning(f"Error reading sitemap {s_url}: {e}")

        logger.info(f"Discovered {len(sitemap_urls)} URLs from sitemaps")
        return sitemap_urls

    def extract_clean_content(self, html, url):
        soup = BeautifulSoup(html, "html.parser")

        # Get meta info
        title = ""
        if soup.title and soup.title.string:
            title = soup.title.string.strip()
        elif soup.find("h1"):
            title = soup.find("h1").get_text(strip=True)
        else:
            title = url

        meta_desc = ""
        desc_tag = soup.find("meta", attrs={"name": "description"}) or soup.find("meta", attrs={"property": "og:description"})
        if desc_tag and desc_tag.get("content"):
            meta_desc = desc_tag["content"].strip()

        # Remove unwanted tags
        for element in soup(["script", "style", "noscript", "svg", "iframe", "header", "nav", "footer"]):
            element.decompose()

        # Also remove navbar and footer classes if any remain
        for el in soup.find_all(class_=re.compile(r"(navbar|site-footer|doodle|advertisement|adsbygoogle)", re.I)):
            el.decompose()

        # Convert remaining structure into readable text with headings
        lines = []
        for elem in soup.find_all(["h1", "h2", "h3", "h4", "h5", "h6", "p", "li", "th", "td"]):
            text = elem.get_text(" ", strip=True)
            if not text or len(text) < 3:
                continue
            
            tag = elem.name.lower()
            if tag.startswith("h"):
                level = tag[1]
                lines.append(f"\n{'#' * int(level)} {text}\n")
            elif tag == "li":
                lines.append(f"- {text}")
            else:
                lines.append(text)

        raw_content = "\n".join(lines)
        # Collapse multiple blank lines
        clean_content = re.sub(r"\n{3,}", "\n\n", raw_content).strip()

        # Collect outgoing internal links
        links = []
        for a in soup.find_all("a", href=True):
            href = a["href"]
            norm = self.normalize_url(href)
            if self.is_valid_url(norm):
                links.append(norm)

        return title, meta_desc, clean_content, links

    def run(self):
        logger.info(f"Starting crawl for {self.base_url} (Limit: {self.max_pages} pages)")

        # Prioritize core pages
        priority_pages = [
            self.base_url,
            f"{self.base_url}/about",
            f"{self.base_url}/explore",
            f"{self.base_url}/colleges",
            f"{self.base_url}/job-corner",
            f"{self.base_url}/explore/engineering-colleges",
            f"{self.base_url}/explore/medical-colleges",
            f"{self.base_url}/explore/management-colleges",
            f"{self.base_url}/explore/government-defence",
            f"{self.base_url}/explore/modern-tech",
        ]

        # Add sitemap URLs
        sitemap_urls = self.fetch_sitemap_urls()

        # Combine queue
        seen = set()
        for u in priority_pages + sitemap_urls:
            norm = self.normalize_url(u)
            if norm not in seen and self.is_valid_url(norm):
                self.queue.append(norm)
                seen.add(norm)

        logger.info(f"Initial crawl queue populated with {len(self.queue)} unique URLs")

        while self.queue and len(self.visited) < self.max_pages:
            current_url = self.queue.pop(0)
            if current_url in self.visited:
                continue

            self.visited.add(current_url)
            logger.info(f"[{len(self.visited)}/{self.max_pages}] Crawling: {current_url}")

            try:
                resp = requests.get(current_url, headers=HEADERS, timeout=12)
                if resp.status_code != 200:
                    logger.warning(f"HTTP {resp.status_code} for {current_url}")
                    continue

                content_type = resp.headers.get("content-type", "").lower()
                if "text/html" not in content_type:
                    continue

                title, meta_desc, content, new_links = self.extract_clean_content(resp.text, current_url)

                if len(content) > 60: # Only keep pages with meaningful text
                    self.documents.append({
                        "url": current_url,
                        "title": title,
                        "meta_description": meta_desc,
                        "content": content,
                        "length": len(content)
                    })
                    logger.info(f"  -> Extracted '{title}' ({len(content)} chars)")

                # Queue new links
                for link in new_links:
                    if link not in self.visited and link not in seen and len(self.queue) < 500:
                        self.queue.append(link)
                        seen.add(link)

                time.sleep(CRAWL_DELAY)

            except Exception as e:
                logger.error(f"Error crawling {current_url}: {e}")

        # Save results
        with open(self.output_file, "w", encoding="utf-8") as f:
            json.dump(self.documents, f, indent=2, ensure_ascii=False)

        logger.info(f"Crawl finished! Total {len(self.documents)} pages saved to {self.output_file}")
        return self.documents

if __name__ == "__main__":
    crawler = CareerGyanCrawler()
    crawler.run()
