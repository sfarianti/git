import sys
import qrcode
from reportlab.pdfgen import canvas
from reportlab.lib.pagesizes import A4
from reportlab.lib.units import mm
from PyPDF2 import PdfFileWriter, PdfFileReader
import io

def add_qrcode_to_pdf(input_pdf_path, output_pdf_path, data):
     # Buat QR code
    qr = qrcode.QRCode(
        version=1,
        error_correction=qrcode.constants.ERROR_CORRECT_L,
        box_size=10,
        border=4,
    )
    qr.add_data(data)
    qr.make(fit=True)
    img = qr.make_image(fill='black', back_color='white')
    
    # Simpan QR code ke buffer
    qr_buffer = io.BytesIO()
    img.save(qr_buffer, format="PNG")
    qr_buffer.seek(0)
    
    # Buat halaman PDF baru dengan QR code
    packet = io.BytesIO()
    c = canvas.Canvas(packet, pagesize=A4)
    c.drawImage(qr_buffer, 100, 700, width=200, height=200)
    c.drawString(100, 680, "Scan QR code untuk mendapatkan informasi lebih lanjut.")
    c.save()

    # Pindahkan ke awal buffer
    packet.seek(0)
    
    # Baca PDF yang ada
    existing_pdf = PdfFileReader(open(input_pdf_path, "rb"))
    output = PdfFileWriter()

    # Tambahkan halaman dari PDF yang ada ke output
    for page_num in range(existing_pdf.getNumPages()):
        page = existing_pdf.getPage(page_num)
        output.addPage(page)

    # Baca halaman QR code dari buffer dan tambahkan ke output
    qr_pdf = PdfFileReader(packet)
    qr_page = qr_pdf.getPage(0)
    output.addPage(qr_page)

    # Tulis output ke file
    with open(output_pdf_path, "wb") as outputStream:
        output.write(outputStream)

if __name__ == "__main__":
    input_pdf = sys.argv[1]
    output_pdf = sys.argv[2]
    data = sys.argv[3]
    add_qrcode_to_pdf(input_pdf, output_pdf, data)