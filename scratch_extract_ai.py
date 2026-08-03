import pdfplumber
import sys

pdf_path = "AI_CutOff.pdf"
if len(sys.argv) > 1:
    pdf_path = sys.argv[1]

print(f"Opening {pdf_path}...")
with pdfplumber.open(pdf_path) as pdf:
    # Print the first page's text to see its structure
    first_page = pdf.pages[0]
    print("--- TEXT ---")
    print(first_page.extract_text())
    
    print("\n--- TABLES ---")
    tables = first_page.extract_tables()
    for i, table in enumerate(tables):
        print(f"Table {i+1}:")
        for row in table:
            print(row)
        print("-" * 40)
