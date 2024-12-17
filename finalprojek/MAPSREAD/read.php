<?php
include 'koneksi.php';



// Get the search parameter from the URL
$searchQuery = isset($_GET['search']) ? $_GET['search'] : null;

$data = array(); // Array untuk menyimpan hasil query

// Jika parameter search adalah 'wisata', ambil data dari tabel 'wisata'
if ($searchQuery && strtolower($searchQuery) === 'wisata') {
    $sql_wisata = "SELECT * FROM wisata";
    $result_wisata = $conn_pencarian->query($sql_wisata);

    if ($result_wisata && $result_wisata->num_rows > 0) {
        while ($row_wisata = $result_wisata->fetch_assoc()) {
            $data[] = $row_wisata;
        }
    } else {
        error_log('Data wisata tidak ditemukan atau query gagal: ' . $conn_pencarian->error);
    }
    
} else {
    $sql_informasi = "SELECT * FROM informasi";
    $result_informasi = $connection->query($sql_informasi);

    if ($result_informasi && $result_informasi->num_rows > 0) {
        while ($row_informasi = $result_informasi->fetch_assoc()) {
            $data[] = $row_informasi;
        }
    } else {
        error_log('Data informasi tidak ditemukan atau query gagal: ' . $connection->error);
    }
}

// Mengembalikan data sebagai JSON
header('Content-Type: application/json');
echo json_encode($data);

// Tutup koneksi database
$connection->close();
$conn_pencarian->close();
?>