<?php
require 'koneksi.php';

if (isset($_GET['file'])) {
    // Ambil nama file yang akan dihapus dari URL
    $fileName = $_GET['file'];
    $filePath = 'uploads/' . $fileName;

    // Cek apakah file ada di server
    if (file_exists($filePath)) {
        // Hapus file dari server
        if (unlink($filePath)) {
            // Hapus file dari database
            $stmt = $conn->prepare("DELETE FROM pdf_crud WHERE file_name = ?");
            $stmt->bind_param("s", $fileName);

            if ($stmt->execute()) {
                echo "File berhasil dihapus. <a href='index.php'>Kembali</a>";
            } else {
                echo "Gagal menghapus file dari database. <a href='index.php'>Kembali</a>";
            }

            $stmt->close();
        } else {
            echo "Gagal menghapus file dari server. <a href='index.php'>Kembali</a>";
        }
    } else {
        echo "File tidak ditemukan. <a href='index.php'>Kembali</a>";
    }
}

$conn->close();
?>
