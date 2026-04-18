<?php
session_start();
include "../../layouts/config.php";
$query = mysqli_query($link, "SELECT * FROM v_penjualan WHERE nomor_penjualan = '$_GET[nomor_penjualan]'");
$data = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html>

<head>
    <!-- Custom styles for this template -->
    <link href="../../assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />


</head>

<body>
    <div class="container-fluid">

        <div class="card-header py-3">
            <div class="row">
                <div class="col-12 text-center">
                    <h3>Batik Widji</h3>
                    <h3><b>Struk Belanja</b></h3>
                    <h4><?= $data['nomor_penjualan'] ?></h4>
                    <h4><?= tanggal($data['tanggal_jual']) ?></h4>
                </div>
            </div>
        </div>
        <hr>
        <div class="">
            <!--rows -->
            <div class="row">
                <div class="col-sm-12">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Kode</th>
                                <th>Nama Barang</th>
                                <th>Harga</th>
                                <th>Qty</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $query = mysqli_query($link, "SELECT * FROM v_penjualan WHERE nomor_penjualan = '$_GET[nomor_penjualan]'");
                            while ($row = mysqli_fetch_array($query)) {
                                ?>
                                <tr>
                                    <td><?= $row['nomor_penjualan'] ?></td>
                                    <td><?= $row['nama'] . ' - ' . $row['nama_variasi'] ?></td>
                                    <td>Rp. <?= number_format($row['harga_jual'], 0, ',', '.') ?></td>
                                    <td><?= $row['jumlah'] ?></td>
                                    <td>Rp. <?= number_format($row['subtotal'], 0, ',', '.') ?></td>

                                </tr>
                                <?php
                            }
                            ?>
                            <tr>
                                <td colspan="3"></td>
                                <td>Subtotal</td>
                                <td>Rp. <?= number_format($data['subtotal_induk'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Diskon</td>
                                <td>Rp. <?= number_format($data['jumlah_diskon'], 0, ',', '.') ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"></td>
                                <td>Total</td>
                                <td>Rp. <?= number_format($data['total'], 0, ',', '.') ?></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

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
    ?>

</body>
<script>

    window.print();
    window.onafterprint = window.close;
</script>

</html>