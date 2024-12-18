<?php
// Client.php

// URL dari RESTful API server
$url = "http://localhost/finalprojek/rest/Server.php";

// HTTP GET request ke server
$response = file_get_contents($url);


if ($response !== false) {
    $data = json_decode($response, true);

    
    if (is_array($data) && !isset($data['message'])) {
        // Iterasi untuk menampilkan semua data wisata
        foreach ($data as $wisata) {
            echo "Lokasi: " . $wisata['Nama_Lokasi'] . "\n";
            echo "Deskripsi: " . $wisata['Deskripsi_Lokasi'] . "\n";
            echo "Kategori: " . $wisata['Kategori'] . "\n";
            echo "Rating: " . $wisata['Rating'] . "\n";
            echo "Waktu Buka: " . $wisata['Waktu_Buka'] . "\n";
            echo "Kontak: " . $wisata['Kontak_Lokasi'] . "\n\n";
        }
    } elseif (isset($data['message'])) {

        echo $data['message'] . "\n";
    } else {
        echo "Terjadi kesalahan saat memproses data dari server.\n";
    }
} else {
    echo "Terjadi kesalahan saat menghubungi server.\n";
}
?>
