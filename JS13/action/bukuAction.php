<?php
include('../lib/Session.php');

$session = new Session();

if ($session->get('is_login') !== true) {
    header('Location: login.php');
}

include_once('../model/BukuModel.php');
include_once('../lib/Secure.php');

$act = isset($_GET['act']) ? strtolower($_GET['act']) : '';

if ($act == 'load') {
    $buku = new BukuModel();
    $data = $buku->getData();
    $result = [];
    $i = 1;
    foreach ($data as $row) {
        // Konversi kode kategori ke nama kategori
        $kategori_nama = '';
        switch($row['kategori_id']) {
            case 'FKS': $kategori_nama = 'Fiksi'; break;
            case 'NVL': $kategori_nama = 'Novel'; break;
            case 'ILM': $kategori_nama = 'Ilmiah'; break;
            case 'MTR': $kategori_nama = 'Misteri'; break;
            case 'SSL': $kategori_nama = 'Sosial'; break;
            case 'LKK': $kategori_nama = 'LKK'; break;
        }

        $result['data'][] = [
            $i,
            $row['buku_kode'],
            $row['buku_nama'],
            $kategori_nama,
            $row['jumlah'],
            $row['deskripsi'],
            '<img src="'.$row['gambar'].'" alt="'.$row['buku_nama'].'" class="img-thumbnail" width="50">',
            '<button class="btn btn-sm btn-warning" onclick="editData('.$row['buku_id'].')">
                <i class="fa fa-edit"></i>
            </button>
            <button class="btn btn-sm btn-danger" onclick="deleteData('.$row['buku_id'].')">
                <i class="fa fa-trash"></i>
            </button>'
        ];
        $i++;
    }
    echo json_encode($result);
}

// Fungsi baru untuk generate kode buku
if ($act == 'generatekode') {
    $kategori = antiSqlInjection($_POST['kategori']);
    
    $buku = new BukuModel();
    $last_code = $buku->getLastCode($kategori);
    
    // Jika belum ada kode untuk kategori tersebut
    if (!$last_code) {
        $new_code = $kategori . '001';
    } else {
        // Ambil 3 digit terakhir dan tambahkan 1
        $last_number = intval(substr($last_code, -3));
        $new_number = $last_number + 1;
        $new_code = $kategori . sprintf('%03d', $new_number);
    }
    
    echo json_encode([
        'status' => true,
        'kode' => $new_code
    ]);
}

if ($act == 'get') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $buku = new BukuModel();
    $data = $buku->getDataById($id);
    echo json_encode($data);
}

if ($act == 'save') {
    // Validasi kode buku
    $buku = new BukuModel();
    $kode_exists = $buku->checkKodeBuku($_POST['buku_kode']);
    
    if ($kode_exists) {
        echo json_encode([
            'status' => false,
            'message' => 'Kode buku sudah digunakan!'
        ]);
        exit;
    }

    // Handle file upload if exists
    $gambar = '';
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir = "../uploads/";
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
        
        // Validasi tipe file
        if (!in_array($file_extension, $allowed_types)) {
            echo json_encode([
                'status' => false,
                'message' => 'Tipe file tidak diizinkan!'
            ]);
            exit;
        }

        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            $gambar = $target_file;
        }
    }

    $data = [
        'kategori_id' => antiSqlInjection($_POST['kategori_id']),
        'buku_kode' => antiSqlInjection($_POST['buku_kode']),
        'buku_nama' => antiSqlInjection($_POST['buku_nama']),
        'jumlah' => antiSqlInjection($_POST['jumlah']),
        'deskripsi' => antiSqlInjection($_POST['deskripsi']),
        'gambar' => $gambar
    ];

    $result = $buku->insertData($data);

    echo json_encode([
        'status' => $result,
        'message' => $result ? 'Data berhasil disimpan.' : 'Gagal menyimpan data.'
    ]);
}

if ($act == 'update') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;
    
    // Validasi kode buku (kecuali untuk data yang sedang diedit)
    $buku = new BukuModel();
    $kode_exists = $buku->checkKodeBuku($_POST['buku_kode'], $id);
    
    if ($kode_exists) {
        echo json_encode([
            'status' => false,
            'message' => 'Kode buku sudah digunakan!'
        ]);
        exit;
    }

    // Handle file upload if exists
    $gambar = antiSqlInjection($_POST['gambar_lama']);
    if (isset($_FILES['gambar']) && $_FILES['gambar']['error'] == 0) {
        $target_dir = "../uploads/";
        $allowed_types = ['jpg', 'jpeg', 'png', 'gif'];
        $file_extension = strtolower(pathinfo($_FILES["gambar"]["name"], PATHINFO_EXTENSION));
        
        // Validasi tipe file
        if (!in_array($file_extension, $allowed_types)) {
            echo json_encode([
                'status' => false,
                'message' => 'Tipe file tidak diizinkan!'
            ]);
            exit;
        }

        $new_filename = uniqid() . '.' . $file_extension;
        $target_file = $target_dir . $new_filename;
        
        if (move_uploaded_file($_FILES["gambar"]["tmp_name"], $target_file)) {
            // Delete old file if exists
            if (!empty($_POST['gambar_lama']) && file_exists($_POST['gambar_lama'])) {
                unlink($_POST['gambar_lama']);
            }
            $gambar = $target_file;
        }
    }

    $data = [
        'kategori_id' => antiSqlInjection($_POST['kategori_id']),
        'buku_kode' => antiSqlInjection($_POST['buku_kode']),
        'buku_nama' => antiSqlInjection($_POST['buku_nama']),
        'jumlah' => antiSqlInjection($_POST['jumlah']),
        'deskripsi' => antiSqlInjection($_POST['deskripsi']),
        'gambar' => $gambar
    ];

    $result = $buku->updateData($id, $data);

    echo json_encode([
        'status' => $result,
        'message' => $result ? 'Data berhasil diupdate.' : 'Gagal mengupdate data.'
    ]);
}

if ($act == 'delete') {
    $id = (isset($_GET['id']) && ctype_digit($_GET['id'])) ? $_GET['id'] : 0;

    $buku = new BukuModel();
    $existing_data = $buku->getDataById($id);
    
    if ($existing_data && !empty($existing_data['gambar'])) {
        if (file_exists($existing_data['gambar'])) {
            unlink($existing_data['gambar']);
        }
    }

    $result = $buku->deleteData($id);

    echo json_encode([
        'status' => $result,
        'message' => $result ? 'Data berhasil dihapus.' : 'Gagal menghapus data.'
    ]);
}
