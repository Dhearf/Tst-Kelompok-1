<?php 

//by alvina
$connection = new mysqli("localhost", "root", "", "poi");
$conn_pencarian = new mysqli("localhost", "root", "", "pencarian");

// Periksa koneksi
if ($connection->connect_error) {
    die("Koneksi ke database poi gagal: " . $connection->connect_error);
}
if ($conn_pencarian->connect_error) {
    die("Koneksi ke database pencarian gagal: " . $conn_pencarian->connect_error);
}
