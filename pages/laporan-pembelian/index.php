<?php
$maintitle = "Batik Widji";
$title = 'Laporan Pembelian';
?>
<?php include 'layouts/breadcrumb.php'; ?>
<div class="row d-print-none">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">Filter Tanggal</h5>
            </div><!-- end card header -->
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
            $daritanggal = "";
            $sampaitanggal = "";

            if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal'])) {
                $daritanggal = $_GET['dari_tanggal'];
                $sampaitanggal = $_GET['sampai_tanggal'];
            }

            ?>
            <div class="card-body">
                <form action="" method="get" class="row g-3">
                    <input type="hidden" name="page" value="laporan-pembelian">
                    <div class="col-md-6">
                        <label for="validationDefault01" class="form-label">Dari Tanggal</label>
                        <input type="date" class="form-control" id="validationDefault01" required=""
                            name="dari_tanggal">
                    </div>
                    <div class="col-md-6">
                        <label for="validationDefault02" class="form-label">Sampai Tanggal</label>
                        <input type="date" class="form-control" id="validationDefault02" required=""
                            name="sampai_tanggal">
                    </div>
                    <div class="col-12">
                        <button class="btn btn-primary" type="submit">Pilih</button>
                    </div>
                </form>
            </div> <!-- end card-body -->
        </div> <!-- end card-->
    </div>
</div>
<!-- end row-->
<?php if (isset($_GET['dari_tanggal']) && isset($_GET['sampai_tanggal'])) { ?>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <?php include_once "layouts/letter-header.php"; ?>
                <h4 class="text-center mt-3 mb-3"><b>LAPORAN PEMBELIAN</b><br>Periode <?php
                if (!empty($_GET["dari_tanggal"]) && !empty($_GET["sampai_tanggal"])) {
                    echo tanggal($_GET['dari_tanggal']) . " s.d " . tanggal($_GET['sampai_tanggal']);
                } else {
                    echo "Semua";
                }
                ?></h4>
                <div class="card-body mt-5">
                    <table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Tanggal Pesan</th>
                                <th>Tanggal Terima</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            require_once __DIR__ . '/../../layouts/config.php';
                            $total = 0;
                            $harga_beli = 0;
                            $query = mysqli_query($link, "SELECT * FROM v_pembelian WHERE tanggal_pesan BETWEEN '$_GET[dari_tanggal]' AND '$_GET[sampai_tanggal]'");
                            while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?= $data['nomor_po'] ?></td>
                                    <td><?= $data['nama'] ?> - <?= $data['nama_variasi'] ?></td>
                                    <td><?= tanggal($data['tanggal_pesan']) ?></td>
                                    <td><?= tanggal($data['tanggal_terima']) ?></td>
                                    <td>Rp. <?= number_format($data['harga_beli'], 0, ',', '.') ?></td>
                                    <td><?= $data['jumlah_pesan'] ?></td>
                                    <td>Rp. <?= number_format($data['harga_beli'] * $data['jumlah_pesan'], 0, ',', '.') ?>
                                    </td>

                                </tr>
                                <?php
                                $total += ($data['harga_beli'] * $data['jumlah_pesan']);
                            }
                            ?>
                            <tr>
                                <td colspan="5"></td>
                                <td>Total</td>
                                <td>Rp. <?= number_format($total, 0, ',', '.') ?></td>
                            </tr>
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
    <!-- end row-->
<?php }
?>

<script>
</script>