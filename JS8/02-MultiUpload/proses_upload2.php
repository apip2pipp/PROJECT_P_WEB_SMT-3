<?php
// Lokasi penyimpanan file gambar yang diunggah
$targetDirectory = "images/";

// Periksa apakah direktori penyimpanan ada, jika tidak maka buat
if (!file_exists($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
}

if (isset($_FILES['images']) && !empty($_FILES['images']['name'][0])) {
    $totalFiles = count($_FILES['images']['name']);
    $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];
    $maxFileSize = 5 * 1024 * 1024; // 5 MB

    // Loop melalui semua file gambar yang diunggah
    for ($i = 0; $i < $totalFiles; $i++) {
        $fileName = $_FILES['images']['name'][$i];
        $fileSize = $_FILES['images']['size'][$i];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $targetFile = $targetDirectory . uniqid() . '.' . $fileExt;

        // Validasi file
        if (!in_array($fileExt, $allowedExtensions)) {
            echo "File $fileName tidak diizinkan. Hanya file JPG, JPEG, PNG, dan GIF yang diperbolehkan.<br>";
            continue;
        }
        if ($fileSize > $maxFileSize) {
            echo "File $fileName terlalu besar. Ukuran maksimum adalah 5 MB.<br>";
            continue;
        }

        // Pindahkan file gambar yang diunggah ke direktori penyimpanan
        if (move_uploaded_file($_FILES['images']['tmp_name'][$i], $targetFile)) {
            echo "Gambar $fileName berhasil diunggah.<br>";
        } else {
            echo "Gagal mengunggah gambar $fileName.<br>";
        }
    }
} else {
    echo "Tidak ada gambar yang diunggah.";
}
