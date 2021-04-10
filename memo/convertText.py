
from docx import Document

d = Document("Section_1-Advance User Management.docx")

for par in d.paragraphs:
    print(par.text.encode('utf-8'))
    

