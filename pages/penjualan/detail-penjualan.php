<?php
require_once __DIR__ . '/../../layouts/config.php';
$query = mysqli_query($link, "SELECT * FROM v_penjualan WHERE nomor_penjualan = '$_POST[id]'");
$data = mysqli_fetch_array($query);
?>
<table id="tabel-detail-terima" class="table table-bordered table-hover dt-responsive nowrap w-100">
    <thead class="table-light">
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
        $query = mysqli_query($link, "SELECT * FROM v_penjualan WHERE nomor_penjualan = '$_POST[id]'");
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

<script>
    $(document).ready(function () {

        // Helper format angka
        function numberFormat(number) {
            return parseFloat(number).toLocaleString('id-ID');
        }
        function formatTanggal(dateStr) {
            if (!dateStr) return '-';
            var d = new Date(dateStr);
            return d.toLocaleDateString('id-ID', { day: '2-digit', month: 'long', year: 'numeric' });
        }
    });
</script>