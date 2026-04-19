<?php
$maintitle = "Batik Widji";
$title = 'Data Produk';
?>
<?php include 'layouts/breadcrumb.php'; ?>
<div class="row mb-4">
    <div class="col-lg-6">
        <button class="btn btn-primary" id="tambah">+ Tambah Produk</button>
    </div>
</div>


<div class="row" id="tabel">

</div>
<script>
    function loadTable() {
        $('#tabel').load('pages/produk/tabel.php');
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').click(function () {
            $('.modal').modal('show');
            $('.modal-title').text('Tambah Produk');
            $('.modal-body').load('pages/produk/form.php');
        });
    });
</script>