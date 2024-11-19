<?php
session_start();

if (!empty($_SESSION['username'])) {
    // Session check passed, proceed with script
}

require '../config/koneksi.php';
require '../fungsi/pesan_kilat.php';
require '../fungsi/anti_injection.php';


if (!empty($_GET['jabatan'])) {
    // Process the 'jabatan' if needed
}

$id = antiinjection($koneksi, $_POST['id']);
$jabatan = antiinjection($koneksi, $_POST['jabatan']);
$keterangan = antiinjection($koneksi, $_POST['keterangan']);

$query = "UPDATE jabatan SET jabatan = '$jabatan', keterangan = '$keterangan' WHERE id = '$id'";

if (mysqli_query($koneksi, $query)) {
    pesan('success', "Jabatan Telah Diubah.");
} else {
    pesan('danger', "Mengubah Jabatan Karena: " . mysqli_error($koneksi));
}

header("Location: ../index.php?page=jabatan");
?>
<?php
if (!empty($_GET['anggota'])) {
    // Mengamankan input yang diterima dari form
    $user_id = antiinjection($koneksi, $_POST['id']);
    $nama = antiinjection($koneksi, $_POST['nama']);
    $jabatan = antiinjection($koneksi, $_POST['jabatan']);
    $jenis_kelamin = antiinjection($koneksi, $_POST['jenis_kelamin']);
    $alamat = antiinjection($koneksi, $_POST['alamat']);
    $no_telp = antiinjection($koneksi, $_POST['no_telp']);
    $username = antiinjection($koneksi, $_POST['username']);

    // Query untuk mengupdate data anggota
    $query_anggota = "UPDATE anggota SET 
                        nama = '$nama', 
                        jenis_kelamin = '$jenis_kelamin', 
                        alamat = '$alamat', 
                        no_telp = '$no_telp', 
                        jabatan_id = '$jabatan' 
                      WHERE user_id = '$user_id'";

    if (mysqli_query($koneksi, $query_anggota)) {
        // Mengecek apakah password baru disertakan
        if (!empty($_POST['password'])) {
            $password = $_POST['password'];

            // Generate random salt
            $salt = bin2hex(random_bytes(16));

            // Gabungkan salt dengan password
            $combined_password = $salt . $password;

            // Hash password dengan salt
            $hashed_password = password_hash($combined_password, PASSWORD_BCRYPT);

            // Query untuk update data user, termasuk password
            $query_user = "UPDATE user SET 
                             username = '$username', 
                             password = '$hashed_password', 
                             salt = '$salt' 
                           WHERE id = '$user_id'";

            if (mysqli_query($koneksi, $query_user)) {
                pesan('success', "Anggota Telah Diubah.");
            } else {
                pesan('warning', "Data Anggota Berhasil Diubah, Tetapi Password Gagal Diubah Karena: " . mysqli_error($koneksi));
            }
        } else {
            // Jika tidak ada perubahan password
            $query_user = "UPDATE user SET username = '$username' WHERE id = '$user_id'";

            if (mysqli_query($koneksi, $query_user)) {
                pesan('success', "Anggota Telah Diubah.");
            } else {
                pesan('warning', "Data Anggota Berhasil Diubah, Tetapi Username Gagal Diubah Karena: " . mysqli_error($koneksi));
            }
        }
    } else {
        pesan('danger', "Mengubah Anggota Karena: " . mysqli_error($koneksi));
    }

    // Redirect ke halaman anggota setelah selesai
    header("Location: ../index.php?page=anggota");
    exit();
}
?>