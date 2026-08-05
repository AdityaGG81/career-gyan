import pdfplumber
import json
import sys
import os
import re

def parse_ai_cutoff(pdf_path):
    records = []
    print(f"Parsing AI Cutoff: {pdf_path}")
    with pdfplumber.open(pdf_path) as pdf:
        for page_num, page in enumerate(pdf.pages):
            tables = page.extract_tables()
            for table in tables:
                # The AI table has headers: ['Sr. No', 'All India\nMerit', 'Choice Code', 'Institute Name', 'Course Name', 'Merit Exam', 'Type', 'Seat Type']
                # Sometimes headers are repeated or spread across pages
                for row in table:
                    if not row or not row[0]: continue
                    if row[0] == 'Sr. No' or 'Choice Code' in row: continue
                    
                    # Row data
                    merit_val = row[1] if len(row) > 1 else ''
                    choice_code = row[2] if len(row) > 2 else ''
                    institute = row[3] if len(row) > 3 else ''
                    course = row[4] if len(row) > 4 else ''
                    seat_type = row[7] if len(row) > 7 else 'AI'
                    
                    if not choice_code or not choice_code.isdigit():
                        continue
                    
                    # Extract merit and percentile from "15943 (86.5868550)"
                    merit_no = None
                    percentile = 0.0
                    if merit_val:
                        m = re.search(r'(\d+)\s*\(([\d\.]+)\)', merit_val.replace('\n', ' '))
                        if m:
                            merit_no = int(m.group(1))
                            percentile = float(m.group(2))
                    
                    college_code = choice_code[:4] if len(choice_code) == 9 else choice_code[:5]
                    # Format: "01101 - Shri Sant Gajanan Maharaj..."
                    if '-' in institute:
                        institute = institute.split('-', 1)[1].strip()
                    
                    if course:
                        course = course.replace('\n', ' ').strip()
                    else:
                        # Extract course from institute string if it merged
                        course = ""
                    
                    records.append({
                        'college_code': int(college_code) if college_code.isdigit() else college_code,
                        'college_name': institute,
                        'branch_code': choice_code,
                        'branch_name': course,
                        'category': seat_type,
                        'category_full': 'All India',
                        'percentile': percentile,
                        'year': 2026,
                        'round': 'CAP Round I',
                        'status': None,
                        'quota': 'AI',
                        'merit_no': merit_no,
                        'percentile_band': None
                    })
    return records

def parse_mh_cutoff(pdf_path):
    records = []
    print(f"Parsing MH Cutoff: {pdf_path}")
    with pdfplumber.open(pdf_path) as pdf:
        for page_num, page in enumerate(pdf.pages):
            if page_num % 100 == 0:
                print(f" Processing page {page_num+1}/{len(pdf.pages)}")
                
            # Extract words to reconstruct lines with bounding boxes
            words = page.extract_words()
            lines = []
            # Group words into lines based on vertical proximity
            if not words: continue
            
            # Sort words by top, then x0
            words.sort(key=lambda w: (round(w['top'], 1), w['x0']))
            current_line = []
            current_top = words[0]['top']
            
            for w in words:
                if abs(w['top'] - current_top) > 5:  # new line
                    lines.append({
                        'text': ' '.join(wd['text'] for wd in current_line),
                        'top': current_line[0]['top'],
                        'bottom': current_line[0]['bottom']
                    })
                    current_line = [w]
                    current_top = w['top']
                else:
                    current_line.append(w)
            if current_line:
                lines.append({
                    'text': ' '.join(wd['text'] for wd in current_line),
                    'top': current_line[0]['top'],
                    'bottom': current_line[0]['bottom']
                })
                
            tables = page.find_tables()
            
            # Combine lines and tables, sort by top coordinate
            elements = []
            for line in lines:
                elements.append({'type': 'line', 'top': line['top'], 'data': line['text']})
            for table in tables:
                elements.append({'type': 'table', 'top': table.bbox[1], 'data': table})
                
            elements.sort(key=lambda x: x['top'])
            
            current_college = ""
            current_college_code = ""
            current_course = ""
            current_course_code = ""
            current_status = ""
            
            for el in elements:
                if el['type'] == 'line':
                    text = el['data'].strip()
                    # Check for college code and name
                    # e.g. 01002 - Government College of Engineering, Amravati
                    m_college = re.match(r'^(\d{4,5})\s*-\s*(.+)$', text)
                    if m_college:
                        code = m_college.group(1)
                        name = m_college.group(2)
                        if len(code) <= 5 and not text.startswith(code + code): # just a heuristic
                            # wait, courses also match this! course codes are 9 or 10 digits
                            pass
                        
                    m_course = re.match(r'^(\d{9,10})\s*-\s*(.+)$', text)
                    if m_course:
                        current_course_code = m_course.group(1)
                        current_course = m_course.group(2)
                        
                        # college code is prefix of course code
                        cc_len = len(current_course_code) - 5
                        current_college_code = current_course_code[:cc_len]
                        # the previous line might have been the college name, let's just find the college name using prefix matching if needed
                        
                    elif re.match(r'^(\d{4,5})\s*-\s*(.+)$', text):
                        # it's a college name
                        m = re.match(r'^(\d{4,5})\s*-\s*(.+)$', text)
                        current_college_code = m.group(1)
                        current_college = m.group(2)
                        
                    elif text.startswith('Status:'):
                        current_status = text
                
                elif el['type'] == 'table':
                    if not current_course_code:
                        continue
                        
                    table_data = el['data'].extract()
                    if not table_data or len(table_data) < 2:
                        continue
                        
                    # Find the row that contains the actual cutoffs (identifiable by numbers with parenthesis)
                    value_row_idx = -1
                    for idx, row in enumerate(table_data):
                        if not row: continue
                        # Check if any cell in this row has the cutoff format "123 (99.0)"
                        has_cutoff = False
                        for cell in row:
                            if cell and re.search(r'\d+\s*\([\d\.]+\)', str(cell).replace('\n', ' ')):
                                has_cutoff = True
                                break
                        if has_cutoff:
                            value_row_idx = idx
                            break
                            
                    if value_row_idx <= 0:
                        continue
                        
                    headers = table_data[value_row_idx - 1]
                    values = table_data[value_row_idx]
                    
                    for col_idx in range(1, len(headers)):
                        category = headers[col_idx]
                        val_str = values[col_idx] if col_idx < len(values) else None
                        
                        if category and val_str:
                            category = category.replace('\n', '').strip()
                            # Skip if category is something weird
                            if len(category) > 15 or 'Seat' in category:
                                continue
                                
                            val_str = val_str.replace('\n', ' ')
                            m = re.search(r'(\d+)\s*\(([\d\.]+)\)', val_str)
                            if m:
                                merit_no = int(m.group(1))
                                percentile = float(m.group(2))
                                
                                records.append({
                                    'college_code': int(current_college_code) if current_college_code.isdigit() else current_college_code,
                                    'college_name': current_college,
                                    'branch_code': current_course_code,
                                    'branch_name': current_course,
                                    'category': category,
                                    'category_full': category,
                                    'percentile': percentile,
                                    'year': 2026,
                                    'round': 'CAP Round I',
                                    'status': current_status,
                                    'quota': 'MH',
                                    'merit_no': merit_no,
                                    'percentile_band': None
                                })
    return records

if __name__ == '__main__':
    ai_records = []
    mh_records = []
    if os.path.exists('AI_CutOff.pdf'):
        ai_records = parse_ai_cutoff('AI_CutOff.pdf')
        print(f"Extracted {len(ai_records)} AI records.")
    
    if os.path.exists('MH_CutOff.pdf'):
        mh_records = parse_mh_cutoff('MH_CutOff.pdf')
        print(f"Extracted {len(mh_records)} MH records.")
        
    all_records = ai_records + mh_records
    
    if all_records:
        output_path = os.path.join('database', 'data', 'mht_cet_cutoffs_2026.json')
        os.makedirs(os.path.dirname(output_path), exist_ok=True)
        with open(output_path, 'w', encoding='utf-8') as f:
            json.dump(all_records, f, ensure_ascii=False, indent=2)
        print(f"Saved {len(all_records)} records to {output_path}")
    else:
        print("No records extracted.")
