<?php
$ch = curl_init();

// Set URL dan opsi cURL
curl_setopt($ch, CURLOPT_URL, 'http://127.0.0.1:8080');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);

// Eksekusi cURL dan dapatkan respons
$response = curl_exec($ch);

// Periksa apakah ada kesalahan cURL
if (curl_errno($ch)) {
    echo 'Error: ' . curl_error($ch);
}

// Tutup koneksi cURL
curl_close($ch);

// Menampilkan respons
echo $response;

// $url = 'http://localhost:8000/cek2';
// $response = file_get_contents($url);

// // Menampilkan respons
// echo $response;

?>