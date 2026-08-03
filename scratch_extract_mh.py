import pdfplumber
import sys

pdf_path = "MH_CutOff.pdf"
if len(sys.argv) > 1:
    pdf_path = sys.argv[1]

with pdfplumber.open(pdf_path) as pdf:
    first_page = pdf.pages[0]
    print("--- TEXT ---")
    print(first_page.extract_text())
