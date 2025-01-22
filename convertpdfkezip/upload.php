<?php
require 'koneksi.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Periksa apakah file diunggah
    if (!isset($_FILES['pdf_files']) || empty($_FILES['pdf_files']['name'][0])) {
        die("Tidak ada file yang diunggah.");
    }

    // Direktori untuk menyimpan file ZIP
    $uploadDir = 'uploads/';
    if (!is_dir($uploadDir)) {
        mkdir($uploadDir, 0777, true);  // Membuat folder jika belum ada
    }

    // Membuat nama file ZIP yang unik
    $zipFileName = 'pdf_upload_' . time() . '.zip';
    $zip = new ZipArchive();

    // Membuka file ZIP untuk ditulis
    if ($zip->open($uploadDir . $zipFileName, ZipArchive::CREATE) === TRUE) {
        
        // Buat folder di dalam ZIP untuk file PDF
        $folderName = 'pdf_files/';
        
        // Mengambil semua file PDF yang diunggah
        $fileNames = $_FILES['pdf_files']['name'];
        $fileTmpNames = $_FILES['pdf_files']['tmp_name'];

        // Proses setiap file PDF yang diunggah
        foreach ($fileTmpNames as $index => $tmpName) {
            if ($_FILES['pdf_files']['error'][$index] == UPLOAD_ERR_OK) {
                // Tambahkan file PDF ke dalam folder di ZIP
                $zip->addFile($tmpName, $folderName . $fileNames[$index]);
            }
        }

        // Menutup file ZIP setelah semua file dimasukkan
        $zip->close();

        // Simpan nama file ZIP ke dalam database
        $stmt = $conn->prepare("INSERT INTO pdf_crud (file_name) VALUES (?)");
        $stmt->bind_param("s", $zipFileName);

        if ($stmt->execute()) {
            echo "File berhasil diunggah dan dikompres ke dalam folder ZIP. <a href='index.php'>Kembali</a>";
        } else {
            echo "Gagal menyimpan file ZIP ke dalam database.";
        }

        $stmt->close();
    } else {
        echo "Terjadi kesalahan saat membuat file ZIP.";
    }
}

$conn->close();
?>
