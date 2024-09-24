<?php
$originalPrice = 120000;
$discountPercentage = 20;

$discountAmount = ($discountPercentage / 100) * $originalPrice;
$finalPrice = $originalPrice - $discountAmount;

echo "Original Price: Rp " . number_format($originalPrice, 0, ',', '.') . "<br>";
echo "Discount: " . $discountPercentage . "%<br>";
echo "Discount Amount: Rp " . number_format($discountAmount, 0, ',', '.') . "<br>";
echo "Final Price to be Paid: Rp " . number_format($finalPrice, 0, ',', '.') . "<br>";
?>
