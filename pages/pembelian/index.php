<?php
require_once __DIR__ . '/../../layouts/config.php';

$query = mysqli_query($link, "SELECT MAX(nomor_po) AS nomor_po FROM pesanan_pembelian");
$data = mysqli_fetch_array($query);
$max = $data['nomor_po'] ? substr($data['nomor_po'], 3, 3) : "000";
$no = $max + 1;
$char = "PBL";
$kode = $char . sprintf("%03s", $no);
if (isset($_GET['nomor_po'])) {
    $kode = $_GET['nomor_po'];
}
?>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="">Kode PO</h3>
                <input type="text" class="form-control" id="kode" value="<?= $kode ?>">
                <h3 class="mt-3">Tanggal :
                    <?= date('d-m-Y') ?>
                </h3>
            </div>
        </div>
    </div>
    <div class="col-lg-8 col-md-6">
        <div class="card">
            <div class="card-body">
                <form id="tambah-pembelian-detail" enctype="multipart/form-data">
                    <input type="hidden" name="nomor_po" value="<?= $kode ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Produk</label>
                                <select class="form-select options-search" id="id_sku" name="id_sku">
                                    <option value="">Pilih Produk</option>
                                    <?php
                                    $sql = "SELECT
                                                produk_sku.*, 
                                                produk.nama
                                            FROM
                                                produk_sku
                                                INNER JOIN
                                                produk
                                                ON 
                                                    produk_sku.id_produk = produk.id";
                                    $result = $link->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>

                                        <option value="<?= $row['id'] ?>" data-hargabeli="<?= $row['harga_beli'] ?>">
                                            <?= $row['nama'] . '-' . $row['nama_variasi'] ?>
                                        </option>
                                        <?php
                                    }

                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Harga Beli</label>
                                <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli">
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Pesan</label>
                                <input type="number" name="jumlah_pesan" class="form-control"
                                    placeholder="Jumlah Pesan">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4">
                            <button type="submit" class="btn btn-success rounded-pill waves-effect waves-light mt-3"><i
                                    class="mdi mdi-plus"></i> Tambah Barang</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="row" id="tabel">

</div>



<script>
    var hargaBeliMap = {
        <?php
        $result2 = $link->query("SELECT id, harga_beli FROM produk_sku");
        while ($row2 = $result2->fetch_assoc()) {
            echo '"' . $row2['id'] . '": ' . (int) $row2['harga_beli'] . ',';
        }
        ?>
    };

    function loadTable() {
        var nomor_po = "<?php echo $kode; ?>";
        $('#tabel').load('pages/pembelian/tabel-pembelian.php', { nomor_po: nomor_po })
    }
    $(document).ready(function () {
        loadTable();
        var choicesIdSku = new Choices('#id_sku', {
            searchEnabled: true,
            placeholderValue: 'Pilih Produk',
            searchPlaceholderValue: 'Cari produk...',
            itemSelectText: 'Pilih',
            noResultsText: 'Tidak ditemukan',
        });

        document.getElementById('id_sku').addEventListener('change', function () {
            var selectedValue = this.value;
            var hargabeli = hargaBeliMap[selectedValue] || '';
            $('input[name=harga_beli]').val(hargabeli);
        });

        $("#tambah-pembelian-detail").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'process/pembelian.php?aksi=tambah-pembelian-detail',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    loadTable();
                    alertify.success('Pembelian Berhasil Ditambah ke Keranjang');
                },
                error: function (data) {
                    alertify.error(data);
                }
            });
        });
    });
</script>