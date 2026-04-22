<?php
$maintitle = "Batik Widji";
$title = 'Data Kategori Produk';
?>
<?php include 'layouts/breadcrumb.php'; ?>
<?php
if ($_SESSION['level'] == "admin") {
    ?>
    <div class="row mb-2">
        <div class="col-sm-4">
            <button id="tambah" class="btn btn-success rounded-pill waves-effect waves-light mb-3"><i
                    class="mdi mdi-plus"></i> Tambah Kategori</button>

        </div>
    </div>
    <?php
}
?>
<!-- end row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Kategori Produk</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('pages/kategori/tabel-kategori.php')
    }
    $(document).ready(function () {
        loadTable();
        $('#tambah').on('click', function () {
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Kategori Produk');
            // load form
            $('.modal-body').load('pages/kategori/tambah-kategori.php');
        });
    });
</script>
