<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ARRAY 2</title>
    <style>
        table {
            width: 50%;
            border-collapse: collapse;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <th>Informasi</th>
            <th>Detail</th>
        </tr>
        <?php
        $Dosen = [
            'nama'=> 'Elok Nur Hamdana',
            'domisili'=> 'Malang',
            'jenis_kelamin'=> 'Perempuan'
        ];

        echo "<tr><td>Nama</td><td>{$Dosen['nama']}</td></tr>";
        echo "<tr><td>Domisili</td><td>{$Dosen['domisili']}</td></tr>";
        echo "<tr><td>Jenis Kelamin</td><td>{$Dosen['jenis_kelamin']}</td></tr>";
        ?>
    </table>
</body>
</html>
