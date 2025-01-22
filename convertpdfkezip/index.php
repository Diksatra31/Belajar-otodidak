<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Multiple PDFs as Folder ZIP</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Upload Multiple PDFs and Convert to ZIP Folder</h1>
        <form action="upload.php" method="POST" enctype="multipart/form-data">
            <input type="file" name="pdf_files[]" accept=".pdf" multiple required>
            <input type="file" name="pdf_files[]" accept=".pdf" multiple required>
            <button type="submit">Upload PDFs</button>
        </form>

        <h2>Uploaded ZIP Files</h2>
        <table>
            <thead>
                <tr>
                    <th>File Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                require 'koneksi.php';
                $dir = 'uploads/';
                if (is_dir($dir)) {
                    $files = array_diff(scandir($dir), ['.', '..']);
                    foreach ($files as $file) {
                        echo "<tr>
                            <td>{$file}</td>
                            <td><a href='{$dir}{$file}' target='_blank'>Download ZIP</a>
                            <a href='delete.php?file={$file}' onclick='return confirm(\"Are you sure you want to delete this file?\")'>Delete</a></td>
                        </tr>";
                    }
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
