<?php
session_start();

if (!empty($_SESSION['username'])) {
    require '../config/koneksi.php';
    require '../fungsi/pesan_kilat.php';
    require '../fungsi/anti_injection.php';

    // Proses menghapus jabatan
    if (!empty($_GET['jabatan'])) {
        $id = antiinjection($koneksi, $_GET['id']);
        $query = "DELETE FROM jabatan WHERE id = '$id'";

        if (mysqli_query($koneksi, $query)) {
            pesan('success', "Jabatan Telah Terhapus.");
        } else {
            pesan('danger', "Jabatan Tidak Terhapus Karena: " . mysqli_error($koneksi));
        }

        header("Location: ../index.php?page=jabatan");
        exit();
    }

    // Proses menghapus anggota
    if (!empty($_GET['anggota'])) {
        // Mendapatkan ID anggota yang akan dihapus
        $id = antiinjection($koneksi, $_GET['id']);

        // Menghapus data anggota terlebih dahulu
        $query2 = "DELETE FROM anggota WHERE user_id = '$id'";
        if (mysqli_query($koneksi, $query2)) {
            // Jika data anggota berhasil dihapus, hapus data user
            $query = "DELETE FROM user WHERE id = '$id'";
            if (mysqli_query($koneksi, $query)) {
                pesan('success', "Anggota dan Data Login Telah Terhapus.");
                
            } else {
                pesan('danger', "Data Login Tidak Terhapus Karena: " . mysqli_error($koneksi));
            }
        } else {
            pesan('warning', "Data Anggota Tidak Terhapus Karena: " . mysqli_error($koneksi));
        }

        // Redirect setelah proses selesai
        header("Location: ../index.php?page=anggota");
        exit(); // Pastikan eksekusi skrip dihentikan setelah redirect
    }
}
?>