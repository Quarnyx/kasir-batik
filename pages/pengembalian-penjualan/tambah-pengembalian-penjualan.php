<form id="tambah-pengembalian" enctype="multipart/form-data">
    <?php
    require_once __DIR__ . '/../../layouts/config.php';
    $id_sku = $_GET['id_sku'];
    $query = mysqli_query($link, "SELECT * FROM v_penjualan WHERE id = '$id_sku'");
    $data = mysqli_fetch_array($query);
    if ($data) {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="mb-3">
                    <input type="hidden" name="id_sku" value="<?= $data['id_sku'] ?>">
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">Detail Penjualan
                    <?= $data['nomor_penjualan'] ?>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="nomor_penjualan" class="form-label">Nomor Penjualan</label>
                                <input type="text" id="nomor_penjualan" class="form-control" name="nomor_penjualan"
                                    value="<?= $data['nomor_penjualan'] ?>" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama" class="form-label">Nama Produk</label>
                                <input type="text" id="nama" class="form-control" name="nama" value="<?= $data['nama'] ?>"
                                    readonly>
                            </div>
                            <div class="mb-3">
                                <label for="variasi_produk" class="form-label">Variasi Produk</label>
                                <input type="text" id="variasi_produk" class="form-control" name="variasi_produk"
                                    value="<?= $data['nama_variasi'] ?>" readonly>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="nomor_penjualan" class="form-label">Tanggal Penjualan</label>
                                <input type="date" id="tanggal_penjualan" class="form-control" name="tanggal_penjualan"
                                    value="<?= $data['tanggal_jual'] ?>" readonly>
                            </div>

                            <div class="mb-3">
                                <label for="jumlah" class="form-label">Jumlah Dijual</label>
                                <input type="text" id="jumlah" class="form-control" name="jumlah" readonly
                                    value="<?= $data['jumlah'] ?>">
                            </div>
                            <div class="mb-3">
                                <label for="harga" class="form-label">Harga Jual</label>
                                <input type="text" id="harga" class="form-control currency" name="harga" readonly
                                    value="<?= $data['harga_jual'] ?>">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-header">Detail Pengembalian
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="mb-3">
                                <label for="jumlah_pengembalian" class="form-label">Jumlah Pengembalian</label>
                                <input type="number" id="jumlah_pengembalian" class="form-control"
                                    name="jumlah_pengembalian" min="1" max="<?= $data['jumlah'] ?>" required>
                            </div>
                            <div class="mb-3">
                                <label for="alasan_pengembalian" class="form-label">Alasan Pengembalian</label>
                                <textarea id="alasan_pengembalian" class="form-control" name="alasan_pengembalian" rows="3"
                                    required></textarea>
                            </div>
                        </div>
                        <div class="col">
                            <div class="mb-3">
                                <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                                <input type="date" id="tanggal_pengembalian" class="form-control"
                                    name="tanggal_pengembalian">
                            </div>

                            <div class="mb-3">
                                <label for="nominal_pengembalian" class="form-label">Nominal Pengembalian</label>
                                <input type="text" id="nominal_pengembalian" class="form-control"
                                    name="nominal_pengembalian">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
    } else {
        ?>
        <div class="row">
            <div class="col-lg-12">
                <div class="alert alert-danger">Data tidak ditemukan</div>
            </div>
        </div>
        <?php
    }
    ?>

    <div class="row">

    </div>

    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </div>
</form>

<script>
    $('document').ready(function () {
        $('.currency').each(function () {
            var harga = $(this).val();
            $(this).val(harga.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
        });

        $('#nominal_pengembalian').on('input', function () {
            var angka = $(this).val()
                .replace(/\./g, '')
                .replace(/[^0-9]/g, '');

            if (angka === '') {
                $(this).val('');
                return;
            }

            $(this).val(angka.replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.'));
        });
    });

    $("#tambah-pengembalian").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'process/pengembalian.php?aksi=tambah-pengembalian',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.status === 'success') {
                    loadTable();
                    alertify.success(data.message);
                    $('.modal').modal('hide');
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
</script>