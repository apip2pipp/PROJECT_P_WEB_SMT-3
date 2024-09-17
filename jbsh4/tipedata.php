<?php
$a = 10; 
$b = 5;  
$c = $a + 5; 
$d = $b + (10 * 5); 
$e = $d - $c; 

echo "Variabel a: {$a} <br>"; 
echo "Variabel b: {$b} <br>"; 
echo "Variabel c: {$c} <br>"; 
echo "Variabel d: {$d} <br>"; 
echo "Variabel e: {$e} <br>"; 

var_dump($e); 
?>
<br><br>
<?php
$nilaiMatematika = 5.1; 
$nilaiIPA = 6.7;      
$nilaiBahasaIndonesia = 9.3; 


$rataRata = ($nilaiMatematika + $nilaiIPA + $nilaiBahasaIndonesia) / 3;


echo "Matematika: {$nilaiMatematika} <br>";
echo "IPA: {$nilaiIPA} <br>";
echo "Bahasa Indonesia: {$nilaiBahasaIndonesia} <br>";
echo "Rata-rata: {$rataRata} <br>";


var_dump($rataRata);
echo "<br>";
$apakahSiswaLulus = true; 
$apakahSiswaSudahUjian = false; 
var_dump($apakahSiswaLulus); 
echo "<br>"; 
var_dump($apakahSiswaSudahUjian); 
?>
<br><br>
<?php
$namaDepan = "Ibnu"; // Assigns the first name "Ibnu" to the variable $namaDepan
$namaBelakang = 'Jakaria'; // Assigns the last name "Jakaria" to the variable $namaBelakang

$namaLengkap = "{$namaDepan} {$namaBelakang}"; // Combines first and last names using double quotes
$namaLengkap2 = $namaDepan . ' ' . $namaBelakang; // Combines first and last names using concatenation

echo "Nama Depan: {$namaDepan} <br>"; // Outputs the first name with a line break
echo 'Nama Belakang: ' . $namaBelakang . '<br>'; // Outputs the last name with a line break
echo $namaLengkap; // Outputs the full name
?>
<br><br>
<?php
$listMahasiswa = ["Wahid Abdullah", "Elmo Bachtiar", "Lendis Fabri"]; // Creates an array of student names
echo $listMahasiswa[0]; // Outputs the first element of the array, which is "Wahid Abdullah"
?>



