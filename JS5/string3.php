<?php
// $pesan = "Saya arek suroboyooo";
// echo strrev($pesan) . "<br>";


$pesan = "saya arek malang"; 
// ubah variabel $pesan menjadi array dengan perintah explode
$pesanPerKata = explode(' ', $pesan); 
// ubah setiap kata dalam array menjadi kebalikannya
$pesanPerKata = array_map(fn($kata) => strrev($kata), $pesanPerKata); 
// gabungkan kembali array menjadi string
$pesan = implode(' ', $pesanPerKata); 

echo $pesan . "<br>"; 


?>
