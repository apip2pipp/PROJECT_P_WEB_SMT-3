<?php
// Membuat fungsi
function hitungUmur($thn_lahir, $thn_sekarang) {
    $umur = $thn_sekarang - $thn_lahir;
    return $umur;
}

// Menampilkan umur
echo "Umur saya adalah " . hitungUmur(1988, 2023) . " tahun"; // Isi sesuai dengan tahun lahir kalian
?>
