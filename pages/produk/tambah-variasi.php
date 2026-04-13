<?php
require_once '../../layouts/config.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$id_produk = isset($_POST['id_produk']) ? (int) $_POST['id_produk'] : 0;
$edit = $id > 0;

$kode_sku = rand(100000, 999999);

$data = [
    'id' => 0,
    'id_produk' => $id_produk,
    'kode_sku' => $kode_sku,
    'nama_variasi' => '',
    'harga_beli' => '',
    'harga_jual' => '',
    'foto' => '',
];

if ($edit) {
    $query = mysqli_query($link, "SELECT * FROM produk_sku WHERE id = $id");
    $variasi = mysqli_fetch_assoc($query);
    if (!$variasi) {
        die('Variasi tidak ditemukan.');
    }
    $data = $variasi;
    $id_produk = $data['id_produk'];
}
?>
<div class="row">
    <form class="" id="form-variasi" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $data['id'] ?>">
        <input type="hidden" name="id_produk" id="id_produk" value="<?= $id_produk ?>">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Kode SKU</label>
                    <input type="text" class="form-control" name="kode_sku" id="kode_sku"
                        value="<?= $data['kode_sku'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Nama Variasi</label>
                    <input type="text" class="form-control" id="nama_variasi" name="nama_variasi"
                        placeholder="Nama Variasi" required="" value="<?= $data['nama_variasi'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga Beli</label>
                    <input type="text" class="form-control" id="harga_beli" name="harga_beli" placeholder="Harga Beli"
                        required="" value="<?= $data['harga_beli'] ?>">
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label for="" class="form-label">Harga Jual</label>
                    <input type="text" class="form-control" id="harga_jual" name="harga_jual" placeholder="Harga Jual"
                        required="" value="<?= $data['harga_jual'] ?>">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="card border border-primary">
                <div class="card-header bg-transparent border-primary">
                    <h5 class="my-0 text-primary text-center"><i class="mdi mdi-bullseye-arrow me-3"></i>Foto
                    </h5>
                </div>
                <div class="card-body">
                    <div class="text-center mb-5">

                        <img id="preview" src="<?= $edit && $data['foto'] ? '../assets/produk/' . $data['foto'] : '' ?>" alt="FotoProduk" class="card-img-top img-fluid" width="100">

                    </div>
                    <h5 class="card-title">Pilih Foto</h5>
                    <div class="input-group">
                        <input type="file" class="form-control" id="foto" name="foto">
                    </div>
                </div>
            </div>
        </div>

        <div>
            <button class="btn btn-primary" type="submit" id="submit"><?= $edit ? 'Update' : 'Tambah' ?></button>
        </div>
    </form>
</div>
<script>
    $("#form-variasi").submit(function (e) {
        var formData = new FormData(this);
        e.preventDefault(); //prevent the form from submitting normally
        $.ajax({
            type: "POST",
            url: "process/produk.php?aksi=tambah-variasi",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "ok") {
                    loadTable();
                    $('.modal').modal('hide');
                    alertify.success('Variasi Berhasil Disimpan');

                } else {
                    alertify.error('Variasi Gagal Disimpan');
                    console.log(data);

                }
            }
        });
    });
    $("#foto").change(function (e) {
        var fileName = e.target.files[0].name;
        $("#foto").val();

        var reader = new FileReader();
        reader.onload = function (e) {
            // get loaded data and render thumbnail.
            document.getElementById("preview").src = e.target.result;
        };
        // read the image file as a data URL.
        reader.readAsDataURL(this.files[0]);
    });
</script>