<?php 


$connection = new mysqli("localhost", "root", "", "poi");
//by alvina
$conn_pencarian = new mysqli("localhost", "root", "", "pencarian");

// Periksa koneksi
if ($connection->connect_error) {
    die("Koneksi ke database poi gagal: " . $connection->connect_error);
}
//by alvina
if ($conn_pencarian->connect_error) {
    die("Koneksi ke database pencarian gagal: " . $conn_pencarian->connect_error);
}
