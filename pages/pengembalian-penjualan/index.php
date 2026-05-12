<?php
$maintitle = "Batik Widji";
$title = 'Data Kategori Produk';
require_once 'layouts/config.php';

?>
<?php include 'layouts/breadcrumb.php'; ?>

<div class="row mb-2">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Transaksi</h4>
                <p>Pilih transaksi yang akan dikembalikan</p>
                <select class="form-select options-search" id="id_sku" name="id_sku">
                    <option value="">Pilih Transaksi</option>
                    <?php

                    $sql = "SELECT * FROM v_penjualan";
                    $result = $link->query($sql);
                    while ($row = $result->fetch_assoc()) {
                        ?>

                        <option value="<?= $row['id'] ?>">
                            <?= $row['nomor_penjualan'] . ' Penjualan tanggal-' . $row['tanggal_jual'] ?>
                        </option>
                        <?php
                    }

                    ?>
                </select>

                <button id="tambah" class="btn btn-success rounded-pill waves-effect waves-light mb-3 mt-3"><i
                        class="mdi mdi-plus"></i> Tambah Pengembalian Penjualan</button>
            </div>
        </div>
    </div>
</div>

<!-- end row-->
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Pengembalian Penjualan</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('pages/pengembalian-penjualan/tabel-pengembalian-penjualan.php')
    }
    $(document).ready(function () {

        var choicesIdSku = new Choices('#id_sku', {
            searchEnabled: true,
            placeholderValue: 'Pilih Transaksi',
            searchPlaceholderValue: 'Cari Transaksi...',
            itemSelectText: 'Pilih',
            noResultsText: 'Tidak ditemukan',
        });
        loadTable();
        $('#tambah').on('click', function () {
            var idsku = $('#id_sku').val();
            console.log(idsku);
            if (!idsku) {
                alertify.error('Pilih transaksi terlebih dahulu');
                return;
            }
            $('.modal').modal('show');
            $('.modal-title').html('Tambah Pengembalian Penjualan');
            // load form
            $('.modal-body').load('pages/pengembalian-penjualan/tambah-pengembalian-penjualan.php?id_sku=' + idsku);
        });
    });
</script>