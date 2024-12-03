<?php
include('Model.php');
class BukuModel extends Model
{
    protected $db;
    protected $table = 'm_buku';
    protected $driver;

    public function __construct()
    {
        include_once('../lib/Connection.php');
        $this->db = $db;
        $this->driver = $use_driver;
    }

    public function insertData($data)
    {
        if ($this->driver == 'mysql') {
            // prepare statement untuk query insert
            $query = $this->db->prepare("INSERT INTO {$this->table} 
                (kategori_id, buku_kode, buku_nama, jumlah, deskripsi, gambar) 
                VALUES (?, ?, ?, ?, ?, ?)");
            // binding parameter ke query, "i" untuk integer, "s" untuk string
            $query->bind_param('issis', 
                $data['kategori_id'],
                $data['buku_kode'],
                $data['buku_nama'],
                $data['jumlah'],
                $data['deskripsi'],
                $data['gambar']
            );
            // eksekusi query untuk menyimpan ke database
            $query->execute();
        } else {
            // eksekusi query untuk menyimpan ke database
            sqlsrv_query($this->db, 
                "INSERT INTO {$this->table} 
                (kategori_id, buku_kode, buku_nama, jumlah, deskripsi, gambar) 
                VALUES (?, ?, ?, ?, ?, ?)", 
                array(
                    $data['kategori_id'],
                    $data['buku_kode'],
                    $data['buku_nama'],
                    $data['jumlah'],
                    $data['deskripsi'],
                    $data['gambar']
                )
            );
        }
    }

    public function getData()
    {
        if ($this->driver == 'mysql') {
            // query untuk mengambil data dari tabel
            return $this->db->query("SELECT * FROM {$this->table}")->fetch_all(MYSQLI_ASSOC);
        } else {
            // query untuk mengambil data dari tabel
            $query = sqlsrv_query($this->db, "SELECT * FROM {$this->table}");
            $data = [];
            while ($row = sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC)) {
                $data[] = $row;
            }
            return $data;
        }
    }

    public function getDataById($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk mengambil data berdasarkan id
            $query = $this->db->prepare("SELECT * FROM {$this->table} WHERE buku_id = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
            // ambil hasil query
            return $query->get_result()->fetch_assoc();
        } else {
            // query untuk mengambil data berdasarkan id
            $query = sqlsrv_query($this->db, 
                "SELECT * FROM {$this->table} WHERE buku_id = ?", 
                [$id]
            );
            // ambil hasil query
            return sqlsrv_fetch_array($query, SQLSRV_FETCH_ASSOC);
        }
    }

    public function updateData($id, $data)
    {
        if ($this->driver == 'mysql') {
            // query untuk update data
            $query = $this->db->prepare("UPDATE {$this->table} 
                SET kategori_id = ?, 
                    buku_kode = ?, 
                    buku_nama = ?, 
                    jumlah = ?, 
                    deskripsi = ?, 
                    gambar = ? 
                WHERE buku_id = ?");
            // binding parameter ke query
            $query->bind_param('ississi',
                $data['kategori_id'],
                $data['buku_kode'],
                $data['buku_nama'],
                $data['jumlah'],
                $data['deskripsi'],
                $data['gambar'],
                $id
            );
            // eksekusi query
            $query->execute();
        } else {
            // query untuk update data
            sqlsrv_query($this->db, 
                "UPDATE {$this->table} 
                SET kategori_id = ?, 
                    buku_kode = ?, 
                    buku_nama = ?, 
                    jumlah = ?, 
                    deskripsi = ?, 
                    gambar = ? 
                WHERE buku_id = ?",
                [
                    $data['kategori_id'],
                    $data['buku_kode'],
                    $data['buku_nama'],
                    $data['jumlah'],
                    $data['deskripsi'],
                    $data['gambar'],
                    $id
                ]
            );
        }
    }

    public function deleteData($id)
    {
        if ($this->driver == 'mysql') {
            // query untuk delete data
            $query = $this->db->prepare("DELETE FROM {$this->table} WHERE buku_id = ?");
            // binding parameter ke query
            $query->bind_param('i', $id);
            // eksekusi query
            $query->execute();
        } else {
            // query untuk delete data
            sqlsrv_query(
                $this->db,
                "DELETE FROM {$this->table} WHERE buku_id = ?",
                [$id]
            );
        }
    }

    public function getLastCode($kategori) {
        $query = "SELECT buku_kode FROM buku 
                  WHERE kategori_id = '$kategori' 
                  ORDER BY buku_kode DESC LIMIT 1";
        $result = $this->db->query($query);
        
        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            return $row['buku_kode'];
        }
        return false;
    }
    
    public function checkKodeBuku($kode, $exclude_id = null) {
        $query = "SELECT buku_id FROM buku WHERE buku_kode = '$kode'";
        if ($exclude_id) {
            $query .= " AND buku_id != $exclude_id";
        }
        $result = $this->db->query($query);
        return ($result && $result->num_rows > 0);
    }
    
}
