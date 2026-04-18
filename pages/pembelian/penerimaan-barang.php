<?php
require_once __DIR__ . '/../../layouts/config.php';

// Ambil daftar PO yang berstatus 'dipesan' untuk dropdown
$query_po = mysqli_query($link, "
    SELECT pp.nomor_po, pp.tanggal_pesan, pp.total, p.nama AS nama_pemasok
    FROM pesanan_pembelian pp
    LEFT JOIN pemasok p ON pp.id_pemasok = p.id
    WHERE pp.status = 'dipesan'
    ORDER BY pp.tanggal_pesan DESC
");
?>

<div class="row">
    <!-- Panel Kiri: Pilih PO -->
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="mdi mdi-package-variant-closed me-1 text-primary"></i>
                    Penerimaan Barang
                </h5>
                <div class="mb-3">
                    <label class="form-label fw-semibold">Pilih Nomor PO</label>
                    <select class="form-select" id="select_nomor_po">
                        <option value="">-- Pilih Nomor PO --</option>
                        <?php while ($po = mysqli_fetch_assoc($query_po)) { ?>
                            <option value="<?= htmlspecialchars($po['nomor_po']) ?>">
                                <?= htmlspecialchars($po['nomor_po']) ?> - <?= htmlspecialchars($po['nama_pemasok']) ?>
                            </option>
                        <?php } ?>
                    </select>
                </div>
            </div>
        </div>
    </div>


</div>
<div class="row">
    <div class="col-lg-12 col-md-12">
        <div class="card">
            <div class="card-body">
                <h5 class="card-title mb-3">
                    <i class="mdi mdi-clipboard-list-outline me-1 text-success"></i>
                    Detail Item Pesanan
                </h5>
                <div id="tabel-detail-po">
                    <div class="text-center py-5 text-muted" id="placeholder-po">
                        <i class="mdi mdi-package-variant mdi-48px d-block mb-2"></i>
                        Pilih Nomor PO terlebih dahulu untuk melihat detail item
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function () {

        // Inisialisasi Choices.js pada select PO
        var choicesPO = new Choices('#select_nomor_po', {
            searchEnabled: true,
            placeholderValue: '-- Pilih Nomor PO --',
            searchPlaceholderValue: 'Cari nomor PO...',
            itemSelectText: 'Pilih',
            noResultsText: 'Tidak ditemukan',
        });
        function loadTable(nomor_po) {
            $('#tabel-detail-po').load('pages/pembelian/tabel-detail-terima.php', { nomor_po: nomor_po })
        }
        // Ketika PO dipilih
        document.getElementById('select_nomor_po').addEventListener('change', function () {
            var nomor_po = this.value;
            if (!nomor_po) {
                $('#tabel-detail-po').html(`
                <div class="text-center py-5 text-muted" id="placeholder-po">
                    <i class="mdi mdi-package-variant mdi-48px d-block mb-2"></i>
                    Pilih Nomor PO terlebih dahulu untuk melihat detail item
                </div>
            `);
                $('#info-po').addClass('d-none');
                return;
            }

            // Tampilkan info PO
            $('#hidden_nomor_po').val(nomor_po);

            // Load tabel detail
            loadTable(nomor_po);
        });



    });
</script>