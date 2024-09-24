<?php
$students = [
    ['name' => 'Apip', 'grade' => 85],
    ['name' => 'budi', 'grade' => 92],
    ['name' => 'aleg', 'grade' => 78],
    ['name' => 'riki', 'grade' => 64],
    ['name' => 'reji', 'grade' => 90],
];

$totalGrades = 0;
$numStudents = count($students);

foreach ($students as $student) {
    $totalGrades += $student['grade'];
}

$classAverage = $totalGrades / $numStudents;


echo "Class Average: " . number_format($classAverage, 2) . "\n";
echo "Students with grades above the class average:\n";
foreach ($students as $student) {
    if ($student['grade'] > $classAverage) {
        echo $student['name'] . ": " . $student['grade'] . "\n";
    }
}
?>
