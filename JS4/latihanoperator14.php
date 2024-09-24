<?php
$totalSeats = 45;
$occupiedSeats = 28;
$emptySeats = $totalSeats - $occupiedSeats;
$percentageEmpty = ($emptySeats / $totalSeats) * 100;

echo "Total Seats: $totalSeats<br>";
echo "Occupied Seats: $occupiedSeats<br>";
echo "Empty Seats: $emptySeats<br>";
echo "Percentage of Empty Seats: " . round($percentageEmpty, 2) . "%<br>";
?>