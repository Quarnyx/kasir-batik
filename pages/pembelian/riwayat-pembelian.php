<?php
$maintitle = "Batik Widji";
$title = 'Riwayat Pembelian';
include 'layouts/breadcrumb.php';
?>

<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Daftar Riwayat Pembelian</h4>
                <div id="load-table">

                </div>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<script>
    function loadTable() {
        $('#load-table').load('pages/pembelian/tabel-riwayat-pembelian.php')
    }
    $(document).ready(function () {
        loadTable();
    });
</script>