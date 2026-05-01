<?php
$maintitle = "Batik Widji";
$title = 'Laporan Stok Produk';
?>
<?php include 'layouts/breadcrumb.php'; ?>
<div class="row">
    <div class="col-12">
        <div class="card">
            <?php include_once "layouts/letter-header.php"; ?>

            <h4 class="text-center mt-3 mb-3"><b>LAPORAN STOK PRODUK</b></h4>
            <div class="card-body">


                <table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th class="text-center" style="vertical-align: middle;">No</th>
                            <th class="text-center" style="vertical-align: middle;">Kode</th>
                            <th class="text-center" style="vertical-align: middle;">Nama Produk</th>
                            <th class="text-center" style="vertical-align: middle;">Satuan</th>
                            <th class="text-center" style="vertical-align: middle;">Stok Akhir</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        function tanggal($tanggal)
                        {
                            $bulan = array(
                                1 => 'Januari',
                                'Februari',
                                'Maret',
                                'April',
                                'Mei',
                                'Juni',
                                'Juli',
                                'Agustus',
                                'September',
                                'Oktober',
                                'November',
                                'Desember'
                            );
                            $split = explode('-', $tanggal);
                            return $split[2] . ' ' . $bulan[(int) $split[1]] . ' ' . $split[0];
                        }
                        $no = 0;
                        require_once __DIR__ . '/../../layouts/config.php';
                        $query = mysqli_query($link, "SELECT * FROM v_stok_persediaan");
                        while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td><?= ++$no ?></td>
                                <td><?= $data['kode_produk'] ?></td>
                                <td><?= $data['nama_produk'] ?> - <?= $data['nama_variasi'] ?></td>
                                <td><?= $data['satuan'] ?></td>
                                <td><?= $data['stok_akhir'] ?></td>
                            </tr>
                            <?php
                        }
                        ?>
                    </tbody>
                </table>
                <?php include_once "layouts/letter-footer.php"; ?>

                <div class="mt-4 mb-1">
                    <div class="text-end d-print-none">
                        <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                class="mdi mdi-printer me-1"></i> Print</a>
                    </div>
                </div>
            </div> <!-- end card body-->

        </div> <!-- end card -->

    </div><!-- end col-->
</div>