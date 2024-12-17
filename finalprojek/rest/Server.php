<?php 
require_once 'Koneksi.php'; 

header('Content-Type: application/json');

// Query untuk mengambil semua data dari tabel 'wisata'
$sql = "SELECT * FROM wisata";
$result = $connection->query($sql);

if ($result->num_rows > 0) {
    $data = array(); // Inisialisasi array untuk menampung data
    
    while($row = $result->fetch_assoc()) {
        $data[] = array( // Tambahkan data ke array
            'type' => 'wisata',
            'Nama_Lokasi' => $row["Nama_Lokasi"],
            'Deskripsi_Lokasi' => $row["Deskripsi_Lokasi"],
            'Kategori' => $row["Kategori"],
            'Rating' => $row["Rating"],
            'Waktu_Buka' => $row["Waktu_Buka"],
            'Kontak_Lokasi' => $row["Kontak_Lokasi"]
        );
    }

    // Kirim seluruh array data sebagai JSON
    echo json_encode($data);
} else {
    echo json_encode(['message' => 'Tidak ada data wisata.']);
}

$connection->close();
?>
