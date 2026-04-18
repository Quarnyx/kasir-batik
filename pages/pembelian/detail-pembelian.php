<?php
require_once __DIR__ . '/../../layouts/config.php';

$nomor_po = $_POST['id'] ?? '';
if (!$nomor_po) {
    echo '<div class="alert alert-warning">Nomor PO tidak valid.</div>';
    exit;
}

$nomor_po_safe = mysqli_real_escape_string($link, $nomor_po);

$query = mysqli_query($link, "
    SELECT 
        vp.*,
        ps.kode_sku
    FROM v_pembelian vp
    LEFT JOIN produk_sku ps ON vp.id_sku = ps.id
    WHERE vp.nomor_po = '$nomor_po_safe'
");

$rows = [];
$total_pesan = 0;
$total_nilai = 0;

while ($data = mysqli_fetch_assoc($query)) {
    $rows[] = $data;
    $total_pesan += $data['jumlah_pesan'];
    $total_nilai += $data['harga_beli'] * $data['jumlah_pesan'];
}
?>
<table id="tabel-detail-terima" class="table table-bordered table-hover dt-responsive nowrap w-100">
    <thead class="table-light">
        <tr>
            <th class="text-center" width="40">#</th>
            <th>Nama Barang</th>
            <th>Kode SKU</th>
            <th class="text-center">Satuan</th>
            <th class="text-end">Harga Beli</th>
            <th class="text-center">Jml Pesan</th>
            <th class="text-center" width="130">Diterima</th>
            <th class="text-end">Subtotal</th>
            <th class="text-center">Status</th>
        </tr>
    </thead>
    <tbody>
        <?php if (empty($rows)): ?>
            <tr>
                <td colspan="10" class="text-center text-muted py-4">
                    <i class="mdi mdi-inbox-outline mdi-36px d-block mb-1"></i>
                    Tidak ada item dalam PO ini
                </td>
            </tr>
        <?php else: ?>
            <?php foreach ($rows as $i => $data):
                $persen = $data['jumlah_pesan'] > 0
                    ? round(($data['jumlah_terima'] / $data['jumlah_pesan']) * 100)
                    : 0;
                $statusClass = 'secondary';
                $statusLabel = 'Belum';
                if ($data['jumlah_terima'] >= $data['jumlah_pesan']) {
                    $statusClass = 'success';
                    $statusLabel = 'Lunas';
                } elseif ($data['jumlah_terima'] > 0) {
                    $statusClass = 'warning';
                    $statusLabel = 'Sebagian';
                }
                ?>
                <tr>
                    <td class="text-center">
                        <?= $i + 1 ?>
                    </td>
                    <td>
                        <div class="fw-semibold">
                            <?= htmlspecialchars($data['nama']) ?>
                        </div>
                        <small class="text-muted">
                            <?= htmlspecialchars($data['nama_variasi']) ?>
                        </small>
                    </td>
                    <td>
                        <code class="text-primary"><?= htmlspecialchars($data['kode_sku']) ?></code>
                    </td>
                    <td class="text-center">
                        <?= htmlspecialchars($data['satuan']) ?>
                    </td>
                    <td class="text-end">Rp
                        <?= number_format($data['harga_beli'], 0, ',', '.') ?>
                    </td>
                    <td class="text-center fw-semibold">
                        <?= $data['jumlah_pesan'] ?>
                    </td>

                    <td class="text-center">
                        <?= $data['jumlah_terima'] ?>
                    </td>
                    <td class="text-end fw-semibold subtotal-cell" id="subtotal-<?= $data['id'] ?>">
                        Rp
                        <?= number_format($data['subtotal'], 0, ',', '.') ?>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-<?= $statusClass ?> rounded-pill">
                            <?= $statusLabel ?>
                        </span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <?php if (!empty($rows)): ?>
        <tfoot class="table-light fw-semibold">
            <tr>
                <td colspan="5" class="text-end">Total</td>
                <td class="text-center">
                    <?= $total_pesan ?>
                </td>
                <td></td>
                <td class="text-end" id="grand-total">
                    Rp
                    <?= number_format($total_nilai, 0, ',', '.') ?>
                </td>
                <td></td>
            </tr>
        </tfoot>
    <?php endif; ?>
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