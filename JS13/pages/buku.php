<!DOCTYPE html>
<html>
<head>
    <title>Data Buku</title>
    <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="../assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="../assets/css/dataTables.bootstrap4.min.css">
    <link rel="stylesheet" href="../assets/css/adminlte.min.css">
</head>
<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Content Header -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Data Buku</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">Buku</li>
                        </ol>
                    </div>
                </div>
            </div>
        </section>

        <!-- Main Content -->
        <section class="content">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Daftar Buku</h3>
                    <div class="card-tools">
                        <button type="button" class="btn btn-md btn-primary" onclick="tambahData()">
                            Tambah Buku
                        </button>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-sm table-bordered table-striped" id="table-data">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Kode Buku</th>
                                <th>Nama Buku</th>
                                <th>Kategori</th>
                                <th>Jumlah</th>
                                <th>Deskripsi</th>
                                <th>Gambar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
            </div>
        </section>

        <!-- Modal Form -->
        <div class="modal fade" id="form-data" aria-hidden="true">
            <form action="action/bukuAction.php?act=save" method="post" id="form-tambah" enctype="multipart/form-data">
                <div class="modal-dialog modal-md">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title">Tambah Buku</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Kode Buku</label>
                                <input type="text" class="form-control" name="buku_kode" id="buku_kode" required>
                            </div>
                            <div class="form-group">
                                <label>Nama Buku</label>
                                <input type="text" class="form-control" name="buku_nama" id="buku_nama" required>
                            </div>
                            <div class="form-group">
                                <label for="kategori_id">Kategori Buku</label>
                                <select class="form-control" name="kategori_id" id="kategori_id" required>
                                    <option value="" disabled selected>Pilih Kategori Buku</option>
                                    <option value="FKS">Fiksi</option>
                                    <option value="NVL">Novel</option>
                                    <option value="ILM">Ilmiah</option>
                                    <option value="MTR">Misteri</option>
                                    <option value="SSL">Sosial</option>
                                    <option value="LKK">LKK</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>Jumlah</label>
                                <input type="number" class="form-control" name="jumlah" id="jumlah" required>
                            </div>
                            <div class="form-group">
                                <label>Deskripsi</label>
                                <textarea class="form-control" name="deskripsi" id="deskripsi" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label>Gambar</label>
                                <input type="file" class="form-control" name="gambar" id="gambar" accept="image/*">
                                <img id="preview" class="img-thumbnail mt-2" style="max-width: 200px; display: none;">
                                <input type="hidden" name="gambar_lama" id="gambar_lama">
                            </div>
                            <input type="hidden" name="id" id="buku_id">
                        </div>
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <script src="../assets/js/jquery.min.js"></script>
    <script src="../assets/js/bootstrap.min.js"></script>
    <script src="../assets/js/jquery.dataTables.min.js"></script>
    <script src="../assets/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/js/adminlte.min.js"></script>
    
    <script>
        let table;

        function tambahData() {
            $('#form-data').modal('show');
            $('#form-tambah')[0].reset();
            $('#preview').hide();
            $('.modal-title').text('Tambah Buku');
            $('#form-tambah').attr('action', 'action/bukuAction.php?act=save');
        }

        function editData(id) {
            $('.modal-title').text('Edit Buku');
            $.get('action/bukuAction.php?act=get&id=' + id, function(data) {
                $('#buku_kode').val(data.buku_kode);
                $('#buku_nama').val(data.buku_nama);
                $('#kategori_id').val(data.kategori_id);
                $('#jumlah').val(data.jumlah);
                $('#deskripsi').val(data.deskripsi);
                $('#gambar_lama').val(data.gambar);
                if(data.gambar) {
                    $('#preview').attr('src', data.gambar).show();
                }
                $('#buku_id').val(data.buku_id);
                $('#form-data').modal('show');
                $('#form-tambah').attr('action', 'action/bukuAction.php?act=update&id=' + id);
            });
        }

        function deleteData(id) {
            if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
                $.get('action/bukuAction.php?act=delete&id=' + id, function(data) {
                    alert(data.message);
                    table.ajax.reload();
                });
            }
        }

        // Preview gambar saat dipilih
        $('#gambar').change(function() {
            const file = this.files[0];
            if (file) {
                let reader = new FileReader();
                reader.onload = function(event) {
                    $('#preview').attr('src', event.target.result).show();
                }
                reader.readAsDataURL(file);
            }
        });

        $(document).ready(function() {
            table = $('#table-data').DataTable({
                "processing": true,
                "serverSide": true,
                "ajax": {
                    "url": "action/bukuAction.php?act=load",
                    "type": "GET"
                },
                "columns": [
                    {"data": 0},
                    {"data": 1},
                    {"data": 2},
                    {"data": 3},
                    {"data": 4},
                    {"data": 5},
                    {"data": 6},
                    {"data": 7}
                ]
            });

            // Form submit handler
            $('#form-tambah').submit(function(e) {
                e.preventDefault();
                $.ajax({
                    url: $(this).attr('action'),
                    type: 'POST',
                    data: new FormData(this),
                    processData: false,
                    contentType: false,
                    success: function(response) {
                        let result = JSON.parse(response);
                        if(result.status) {
                            alert(result.message);
                            $('#form-data').modal('hide');
                            table.ajax.reload();
                        } else {
                            alert('Gagal menyimpan data');
                        }
                    },
                    error: function() {
                        alert('Terjadi kesalahan sistem');
                    }
                });
            });
        });
    </script>
</body>
</html>
