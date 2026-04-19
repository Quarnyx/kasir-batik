<?php
require_once __DIR__ . '/../../layouts/config.php';

$id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
$edit = $id > 0;

$kategori = mysqli_query($link, "SELECT * FROM kategori");
$kategori = mysqli_fetch_all($kategori, MYSQLI_ASSOC);

//generator kode produk random
$kode = rand(100000, 999999);


$data = [
    'kode' => '',
    'nama' => '',
    'id_kategori' => '',
    'deskripsi' => '',
    'satuan' => '',
    'foto' => '',
];

if ($edit) {
    $query = mysqli_query($link, "SELECT * FROM produk WHERE id = $id");
    $produk = mysqli_fetch_assoc($query);
    if (!$produk) {
        die('Produk tidak ditemukan.');
    }
    $data = $produk;
}
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h2><?= $edit ? 'Edit Produk' : 'Tambah Produk' ?></h2>
            </div>
            <div class="card-body">
                <form id="tambah-produk" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="<?= $id ?>">

                    <div class="d-grid gap-3" style="grid-template-columns: 1fr 1fr;">
                        <div>
                            <label class="form-label">Kode Produk</label>
                            <input class="form-control" type="text" name="kode" value="<?php if ($edit) {
                                echo $data['kode'];
                            } else {
                                echo $kode;
                            } ?>">
                        </div>
                        <div>
                            <label class="form-label">Nama Produk</label>
                            <input class="form-control" type="text" name="nama" value="<?= $data['nama'] ?>">
                        </div>
                        <div>
                            <label class="form-label">Kategori</label>
                            <select class="form-select" name="id_kategori">
                                <option value="">- Pilih Kategori -</option>
                                <?php foreach ($kategori as $item): ?>
                                    <option value="<?= $item['id'] ?>" <?= (string) $data['id_kategori'] === (string) $item['id'] ? 'selected' : '' ?>>
                                        <?= $item['nama_kategori'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div>
                            <label class="form-label">Satuan</label>
                            <input class="form-control" type="text" name="satuan" value="<?= $data['satuan'] ?>">
                        </div>

                    </div>
                    <div class="mt-3">
                        <label class="form-label">Deskripsi</label>
                        <textarea class="form-control" name="deskripsi"><?= $data['deskripsi'] ?></textarea>
                    </div>

                    <div class="mt-3">
                        <div class="card border border-primary">
                            <div class="card-header bg-transparent border-primary">
                                <h5 class="my-0 text-primary text-center"><i class="mdi mdi-bullseye-arrow me-3"></i>Foto</h5>
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

                    <div class="mt-3">
                        <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script>
    $("#tambah-produk").submit(function (e) {
        var formData = new FormData(this);

        e.preventDefault();
        $.ajax({
            type: "POST",
            url: "process/produk.php?aksi=tambah-produk",
            data: formData,
            contentType: false,
            processData: false,
            success: function (data) {
                if (data == "ok") {
                    loadTable();
                    $('.modal').modal('hide');
                    alertify.success('Produk Berhasil Ditambah');

                } else {
                    alertify.error('Produk Gagal Ditambah');
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