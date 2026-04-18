<?php
require_once __DIR__ . '/../../layouts/config.php';

$query = mysqli_query($link, "SELECT MAX(nomor_penjualan) AS nomor_penjualan FROM penjualan");
$data = mysqli_fetch_array($query);
$max = $data['nomor_penjualan'] ? substr($data['nomor_penjualan'], 3, 3) : "000";
$no = $max + 1;
$char = "PNJ";
$kode = $char . sprintf("%03s", $no);
if (isset($_GET['nomor_penjualan'])) {
    $kode = $_GET['nomor_penjualan'];
}
?>
<div class="row">
    <div class="col-lg-4 col-md-6">
        <div class="card">
            <div class="card-body">
                <h3 class="">Kode Penjualan</h3>
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
                <form id="tambah-penjualan-detail" enctype="multipart/form-data">
                    <input type="hidden" name="nomor_penjualan" value="<?= $kode ?>">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Produk</label>
                                <select class="form-select options-search" id="id_sku" name="id_sku">
                                    <option value="">Pilih Produk</option>
                                    <?php
                                    $sql = "SELECT * FROM v_stok_persediaan where stok_akhir > 0";
                                    $result = $link->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>

                                        <option value="<?= $row['id_sku'] ?>">
                                            <?= $row['nama_produk'] . '-' . $row['nama_variasi'] ?>
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
                                <input type="number" name="harga_beli" class="form-control" placeholder="Harga Beli"
                                    readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Harga Jual</label>
                                <input type="number" name="harga_jual" class="form-control" placeholder="Harga Jual">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Stok</label>
                                <input type="number" name="stok" class="form-control" placeholder="Stok" readonly>
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="mb-3">
                                <label class="form-label">Jumlah Jual</label>
                                <input type="number" name="jumlah" class="form-control" placeholder="Jumlah Jual">
                            </div>
                        </div>
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
    var hargaJualMap = {
        <?php
        $result2 = $link->query("SELECT id, harga_jual FROM produk_sku");
        while ($row2 = $result2->fetch_assoc()) {
            echo '"' . $row2['id'] . '": ' . (int) $row2['harga_jual'] . ',';
        }
        ?>
    };
    var hargaBeliMap = {
        <?php
        $result2 = $link->query("SELECT id, harga_beli FROM produk_sku");
        while ($row2 = $result2->fetch_assoc()) {
            echo '"' . $row2['id'] . '": ' . (int) $row2['harga_beli'] . ',';
        }
        ?>
    };
    var stokMap = {
        <?php
        $result2 = $link->query("SELECT id_sku, stok_akhir FROM v_stok_persediaan");
        while ($row2 = $result2->fetch_assoc()) {
            echo '"' . $row2['id_sku'] . '": ' . (int) $row2['stok_akhir'] . ',';
        }
        ?>
    };

    function loadTable() {
        var nomor_penjualan = "<?php echo $kode; ?>";
        $('#tabel').load('pages/penjualan/tabel-penjualan.php', { nomor_penjualan: nomor_penjualan })
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
            var hargajual = hargaJualMap[selectedValue] || '';
            var hargabeli = hargaBeliMap[selectedValue] || '';
            var stok = stokMap[selectedValue] || '';
            $('input[name=harga_jual]').val(hargajual);
            $('input[name=harga_beli]').val(hargabeli);
            $('input[name=stok]').val(stok);
            console.log(stok);
        });

        $("#tambah-penjualan-detail").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                type: 'POST',
                url: 'process/penjualan.php?aksi=tambah-penjualan-detail',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'success') {
                        loadTable();
                        alertify.success(data.message);
                    } else {
                        alertify.error(data.message);
                    }
                },
                error: function (xhr) {
                    var errorMessage = 'Terjadi kesalahan sistem';
                    if (xhr.responseJSON && xhr.responseJSON.message) {
                        errorMessage = xhr.responseJSON.message;
                    } else if (xhr.responseText) {
                        try {
                            var response = JSON.parse(xhr.responseText);
                            if (response.message) errorMessage = response.message;
                        } catch (e) {
                            errorMessage = xhr.responseText;
                        }
                    }
                    alertify.error(errorMessage);
                }
            });
        });
    });
</script>