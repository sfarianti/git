<!DOCTYPE html>
<html>
<head>
    <title>PDF with QR Code</title>
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
        }
        .info {
            margin-top: 20px;
        }
        .qr-code {
            position: absolute;
            top: 700px;
            left: 450px;
        }
        .existing-pdf {
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="info">
        <p>{!! nl2br(e($info)) !!}</p>
    </div>
    <div class="qr-code">
        <img src="data:image/png;base64,{{ $qrCode }}" alt="QR Code">
    </div>
    <div class="existing-pdf">
        <object data="{{ storage_path('app/public/' . $filePath) }}" type="application/pdf" width="100%" height="600px"> 
        </object>
    </div>
</body>
</html>
