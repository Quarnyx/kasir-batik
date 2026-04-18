<?php
require_once __DIR__ . '/../../layouts/config.php';

$nomor_po = $_POST['nomor_po'] ?? '';
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
<div class="mt-3">
    <small class="text-muted">
        <i class="mdi mdi-information-outline me-1"></i>
        Tanggal Terima: <strong>
            <?= date('d-m-Y') ?>
        </strong>
    </small>
</div>
<form id="form-penerimaan" enctype="multipart/form-data">
    <input type="hidden" name="nomor_po" id="hidden_nomor_po" value="<?= $nomor_po ?>">
    <input type="hidden" name="id_pengguna" value="<?= $_SESSION['id'] ?? 1 ?>">

    <div class="row">
        <div class="col-md-4">
            <div class="mb-3">
                <label class="form-label fw-semibold">Tanggal Terima</label>
                <input type="date" name="tanggal_terima" class="form-control" value="<?= date('Y-m-d') ?>" required>
            </div>

        </div>
        <div class="d-flex gap-2">
            <button type="submit" class="btn btn-success waves-effect waves-light">
                <i class="mdi mdi-check me-1"></i> Konfirmasi Diterima
            </button>
        </div>
    </div>
</form>
<table id="tabel-detail-terima" class="table table-bordered table-hover dt-responsive nowrap w-100">
    <thead class="table-light">
        <tr>
            <th class="text-center" width="40">#</th>
            <th>Nama Barang</th>
            <th>Kode SKU</th>
            <th class="text-center">Satuan</th>
            <th class="text-end">Harga Beli</th>
            <th class="text-center">Jml Pesan</th>
            <th class="text-center" width="130">Terima Sekarang</th>
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
                    <td class="text-center"><?= $i + 1 ?></td>
                    <td>
                        <div class="fw-semibold"><?= htmlspecialchars($data['nama']) ?></div>
                        <small class="text-muted"><?= htmlspecialchars($data['nama_variasi']) ?></small>
                    </td>
                    <td>
                        <code class="text-primary"><?= htmlspecialchars($data['kode_sku']) ?></code>
                    </td>
                    <td class="text-center"><?= htmlspecialchars($data['satuan']) ?></td>
                    <td class="text-end">Rp <?= number_format($data['harga_beli'], 0, ',', '.') ?></td>
                    <td class="text-center fw-semibold"><?= $data['jumlah_pesan'] ?></td>

                    <td class="text-center">
                        <input type="number" name="jumlah_terima[<?= $data['id'] ?>]"
                            class="form-control form-control-sm text-center jumlah-terima-input"
                            data-harga="<?= $data['harga_beli'] ?>" data-id="<?= $data['id'] ?>"
                            max="<?= $data['jumlah_pesan'] ?>" min="0">
                    </td>
                    <td class="text-end fw-semibold subtotal-cell" id="subtotal-<?= $data['id'] ?>">
                        Rp <?= number_format($data['harga_beli'] * $data['jumlah_pesan'], 0, ',', '.') ?>
                    </td>
                    <td class="text-center">
                        <span class="badge bg-<?= $statusClass ?> rounded-pill"><?= $statusLabel ?></span>
                    </td>
                </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </tbody>
    <?php if (!empty($rows)): ?>
        <tfoot class="table-light fw-semibold">
            <tr>
                <td colspan="5" class="text-end">Total</td>
                <td class="text-center"><?= $total_pesan ?></td>
                <td></td>
                <td class="text-end" id="grand-total">
                    Rp <?= number_format($total_nilai, 0, ',', '.') ?>
                </td>
                <td></td>
            </tr>
        </tfoot>
    <?php endif; ?>
</table>

<script>
    // Update subtotal saat jumlah terima diubah
    $(document).on('input', '.jumlah-terima-input', function () {
        var id = $(this).data('id');
        var harga = parseFloat($(this).data('harga')) || 0;
        var qty = parseInt($(this).val()) || 0;
        var subtotal = harga * qty;
        $('#subtotal-' + id).text('Rp ' + subtotal.toLocaleString('id-ID'));
    });
    $(document).ready(function () {
        // Submit form penerimaan
        $("#form-penerimaan").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);

            // Kumpulkan jumlah_terima tiap item
            $('input[name^="jumlah_terima"]').each(function () {
                formData.append($(this).attr('name'), $(this).val());
            });
            console.log(formData);

            $.ajax({
                type: 'POST',
                url: 'process/pembelian.php?aksi=terima-barang',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    window.location.reload();
                    alertify.success('Barang berhasil diterima');
                },
                error: function (data) {
                    alertify.error(data);
                }
            });
        });


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