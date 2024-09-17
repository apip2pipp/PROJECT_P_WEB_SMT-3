<?php
$a = 10; 
$b = 5;  

$hasilTambah = $a + $b;  
$hasilKurang = $a - $b;  
$hasilKali = $a * $b;    
$hasilBagi = $a / $b;    
$sisaBagi = $a % $b;     
$pangkat = $a ** $b;     

// Output the results
echo "Hasil Tambah: " . $hasilTambah . "<br>";  
echo "Hasil Kurang: " . $hasilKurang . "<br>";  
echo "Hasil Kali: " . $hasilKali . "<br>";      
echo "Hasil Bagi: " . $hasilBagi . "<br>";      
echo "Sisa Bagi: " . $sisaBagi . "<br>";        
echo "Pangkat: " . $pangkat . "<br>";           
?>
<br><br>
<?php
$a = 10; 
$b = 5;  

$hasilSama = $a == $b;              
$hasilTidakSama = $a != $b;          
$hasilLebihKecil = $a < $b;         
$hasilLebihBesar = $a > $b;          
$hasilLebihKecilSama = $a <= $b;     
$hasilLebihBesarSama = $a >= $b;     

// Output the results
echo "Hasil Sama: " . ($hasilSama ? 'True' : 'False') . "<br>";                
echo "Hasil Tidak Sama: " . ($hasilTidakSama ? 'True' : 'False') . "<br>";     
echo "Hasil Lebih Kecil: " . ($hasilLebihKecil ? 'True' : 'False') . "<br>";     
echo "Hasil Lebih Besar: " . ($hasilLebihBesar ? 'True' : 'False') . "<br>";     
echo "Hasil Lebih Kecil Sama: " . ($hasilLebihKecilSama ? 'True' : 'False') . "<br>"; 
echo "Hasil Lebih Besar Sama: " . ($hasilLebihBesarSama ? 'True' : 'False') . "<br>"; 
?>
<br><br>
<?php
$a = true; 
$b = false; 

// Logical operations
$hasilAnd = $a && $b;      
$hasilOr = $a || $b;       
$hasilNotA = !$a;          
$hasilNotB = !$b;          

// Output the results
echo "Hasil AND: " . ($hasilAnd ? 'True' : 'False') . "<br>";         
echo "Hasil OR: " . ($hasilOr ? 'True' : 'False') . "<br>";           
echo "Hasil NOT A: " . ($hasilNotA ? 'True' : 'False') . "<br>";      
echo "Hasil NOT B: " . ($hasilNotB ? 'True' : 'False') . "<br>";      
?>
<br><br>
<?php
$a = 10; 
$b = 5;  


$a += $b;  
echo "Hasil Penjumlahan (a += b): $a<br>"; 
$a -= $b; 
echo "Hasil Pengurangan (a -= b): $a<br>"; 
$a *= $b;  
echo "Hasil Perkalian (a *= b): $a<br>"; 
$a /= $b;  
echo "Hasil Pembagian (a /= b): $a<br>"; 
$a %= $b;  
echo "Hasil Modulus (a %= b): $a<br>"; 
?>
<br><br>
<?php
$a = 10; 
$b = '10'; 


$hasilIdentik = $a === $b; 
echo "Hasil Identik (a === b): " . ($hasilIdentik ? 'True' : 'False') . "<br>"; 
$hasilTidakIdentik = $a !== $b; 
echo "Hasil Tidak Identik (a !== b): " . ($hasilTidakIdentik ? 'True' : 'False') . "<br>";
?>
