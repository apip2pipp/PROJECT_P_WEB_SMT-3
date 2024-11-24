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
                        <th>gambar</th> 
                        <th>Aksi</th> 
                    </tr> 
                </thead> 
                <tbody> 
                </tbody> 
            </table> 
        </div> 
    </div> 
</section> 

<!-- Modal Form for Add/Edit Book -->
<div class="modal fade" id="form-data" style="display: none;" aria-hidden="true"> 
    <form action="action/bukuAction.php?act=save" method="post" id="form-tambah"> 
        <div class="modal-dialog modal-md"> 
            <div class="modal-content"> 
                <div class="modal-header"> 
                    <h4 class="modal-title">Tambah Buku</h4> 
                </div> 
                <div class="modal-body"> 
                    <div class="form-group"> 
                        <label>Kode Buku</label> 
                        <input type="text" class="form-control" name="buku_kode" id="buku_kode"> 
                    </div> 
                    <div class="form-group"> 
                        <label>Nama Buku</label> 
                        <input type="text" class="form-control" name="buku_nama" id="buku_nama"> 
                    </div> 
                    <div class="form-group">
    <label for="kategori_id">Kategori Buku</label>
    <select class="form-control" name="kategori_id" id="kategori_id">
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
                        <input type="number" class="form-control" name="jumlah" id="jumlah"> 
                    </div> 
                    <div class="form-group"> 
                        <label>Deskripsi</label> 
                        <textarea class="form-control" name="deskripsi" id="deskripsi"></textarea> 
                    </div> 
                    <div class="form-group"> 
                        <label>Gambar</label> 
                        <input type="text" class="form-control" name="gambar" id="gambar"> 
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

<script>
    function tambahData() {
        $('#form-data').modal('show');
        $('#form-tambah').attr('action', 'action/bukuAction.php?act=save');
    }

    function editData(id) {
        $.get('action/bukuAction.php?act=get&id=' + id, function(data) {
            $('#buku_kode').val(data.buku_kode);
            $('#buku_nama').val(data.buku_nama);
            $('#jumlah').val(data.jumlah);
            $('#deskripsi').val(data.deskripsi);
            $('#gambar').val(data.gambar);
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

    $(document).ready(function() {
        table = $('#table-data').DataTable({
            "processing": true,
            "serverSide": true,
            "ajax": {
                "url": "action/bukuAction.php?act=load",
                "type": "GET"
            }
        });
    });
</script>