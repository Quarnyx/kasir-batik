<?php
require_once __DIR__ . '/../../layouts/config.php';

$id = isset($_GET['id']) ? (int) $_GET['id'] : 0;
$query = mysqli_query($link, "SELECT * FROM produk WHERE id = $id");
$produk = mysqli_fetch_assoc($query);
if (!$produk) {
    die('Produk tidak ditemukan.');
}
$data = $produk;
?>
<div class="row mb-4">
    <div class="col-lg-6">
        <h1>Data Produk</h1>
        <hr />
        <h2>
            <?= $data['nama'] ?>
        </h2>
        <hr />

        <button class="btn btn-primary" id="tambah">+ Tambah Variasi</button>

    </div>
</div>


<div class="row" id="tabel">

</div>


<script>

    function loadTable() {
        $('#tabel').load('pages/produk/tabel-variasi.php', {
            id_produk: <?php echo $id; ?>
        });
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').click(function () {
            const id = <?php echo $id; ?>;
            const nama = "<?= $data['nama'] ?>";
            $.ajax({
                type: 'POST',
                url: 'pages/produk/tambah-variasi.php',
                data: 'id_produk=' + id + '&nama=' + nama,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Tambah Variasi ' + nama);
                    $('.modal .modal-body').html(data);
                }
            })
        });
    });
</script>