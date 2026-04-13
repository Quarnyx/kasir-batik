<?php
require_once __DIR__ . '/../../layouts/config.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$edit = $id > 0;


$data = [
    'nama' => '',
    'alamat' => '',
    'telepon' => '',
    'email' => '',
];

if ($edit) {
    $query = mysqli_query($link, "SELECT * FROM pemasok WHERE id = $id");
    $pemasok = mysqli_fetch_assoc($query);
    if (!$pemasok) {
        die('Pemasok tidak ditemukan.');
    }
    $data = $pemasok;
}
?>

<form id="tambah-pemasok" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $id ?>">
    <div class="row">
        <div class="col-lg-4">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama Pemasok</label>
                <input type="text" id="simpleinput" class="form-control" name="nama" placeholder="Nama Pemasok"
                    value="<?= $data['nama'] ?>">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Telp</label>
                <input type="text" name="telepon" class="form-control" placeholder="Telp"
                    value="<?= $data['telepon'] ?>">
            </div>
        </div>

        <div class="col-lg-4">
            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="text" name="email" class="form-control" placeholder="Email" value="<?= $data['email'] ?>">
            </div>
        </div>
    </div>
    <div class=" row">
        <div class="col-lg-12">

            <div class="mb-3">
                <label for="" class="form-label">Alamat</label>
                <textarea class="form-control" name="alamat" id="" cols="10" rows="5"><?= $data['alamat'] ?></textarea>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

<script>
    $("#tambah-pemasok").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'process/pemasok.php?aksi=tambah-pemasok',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "ok") {
                    loadTable();
                    $('.modal').modal('hide');
                    alertify.success('Pemasok Berhasil Disimpan');

                } else {
                    alertify.error('Pemasok Gagal Disimpan');
                }
            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>