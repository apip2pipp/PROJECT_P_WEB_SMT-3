<?php
$umur;

if (isset($umur) && $umur >= 18) {
    echo "Anda sudah dewasa."; // "You are an adult."
} else {
    echo "Anda belum dewasa atau variabel 'umur' tidak ditemukan."; // "You are not an adult or the variable 'umur' was not found."
}



?>
<br><br><br>
<?php
$data = array("nama" => "Jane", "usia" => 25);

if (isset($data["nama"])) {
    echo "Nama: " . $data["nama"];
} else {
    echo "Variabel 'nama' tidak ditemukan dalam array.";
}

?>