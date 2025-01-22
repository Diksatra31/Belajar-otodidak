<?php
$host = 'localhost'; // Ganti sesuai konfigurasi server
$user = 'root'; // Username database
$password = 'root'; // Password database
$dbname = 'crud_pdf'; // Nama database

$conn = new mysqli($host, $user, $password, $dbname);

// Periksa koneksi
if ($conn->connect_error) {
    die('Koneksi gagal: ' . $conn->connect_error);
} 
?>
