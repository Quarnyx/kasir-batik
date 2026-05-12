<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <h4 class="header-title">Keranjang</h4>
                <table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Kode</th>
                            <th>Nama Barang</th>
                            <th>Harga Jual</th>
                            <th>Qty</th>
                            <th>Satuan</th>
                            <th>Total</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        require_once __DIR__ . '/../../layouts/config.php';
                        session_start();
                        $subtotal = 0;
                        $harga_jual = 0;
                        $query = mysqli_query($link, "SELECT * FROM v_penjualan WHERE nomor_penjualan = '$_POST[nomor_penjualan]'");
                        while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td>
                                    <?= $data['nomor_penjualan'] ?>
                                </td>
                                <td>
                                    <?= $data['nama'] . ' - ' . $data['nama_variasi'] ?>
                                </td>
                                <td>Rp.
                                    <?= number_format($data['harga_jual'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?= $data['jumlah'] ?>
                                </td>
                                <td>
                                    <?= $data['satuan'] ?>
                                </td>
                                <td>Rp.
                                    <?= number_format($data['harga_jual'] * $data['jumlah'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <button data-id="<?= $data['id'] ?>" id="delete" type="button"
                                        class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <?php
                            $harga_jual += $data['harga_jual'] * $data['jumlah'];
                            $subtotal += ($data['harga_jual'] * $data['jumlah']);
                        }
                        ?>
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<form id="post-penjualan" enctype="multipart/form-data">
    <input type="hidden" name="nomor_penjualan" value="<?= $_POST['nomor_penjualan'] ?>" id="nomor_penjualan">
    <input type="hidden" name="id_kasir" value="<?= $_SESSION['id'] ?>" id="id_kasir">
    <div class="row">
        <div class=" col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Penjualan</label>
                                <input type="date" name="tanggal_penjualan" class="form-control"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Subtotal</label>
                                <input type="text" name="subtotal" class="form-control currency" placeholder="Subtotal"
                                    value="<?php echo number_format($subtotal, 0, ',', '.') ?>" id="subtotal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Promo</label>
                                <select name="promo" class="form-select" id="promo">
                                    <option value="0">Tidak Menggunakan Promo</option>
                                    <?php
                                    $tanggal_sekarang = date('Y-m-d');
                                    $query = mysqli_query($link, "SELECT * FROM promo WHERE tanggal_mulai <= '$tanggal_sekarang' AND tanggal_selesai >= '$tanggal_sekarang'");

                                    while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value="<?= $data['persen_diskon'] ?>">
                                            <?= $data['promo'] . ' - ' . $data['persen_diskon'] . '%' ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Jumlah Diskon (Rp)</label>
                                <input type="text" name="jumlah_diskon" class="form-control" placeholder="Jumlah Diskon"
                                    value="0" id="jumlah_diskon" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Total</label>
                                <input type="text" name="total" class="form-control" placeholder="Total"
                                    value="<?= number_format($subtotal, 0, ',', '.') ?>" id="total" readonly>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4" id="uang_bayar_div">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Uang Bayar (Rp)</label>
                                <input type="text" name="uang_bayar" class="form-control" placeholder="Uang Bayar"
                                    value="0" id="uang_bayar">
                            </div>
                        </div>
                        <div class="col-md-4" id="uang_kembalian_div">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Kembalian</label>
                                <input type="text" name="uang_kembalian" class="form-control" placeholder="Kembalian"
                                    value="0" id="uang_kembalian" readonly>
                            </div>
                        </div>
                        <div class="col-md-4" id="bukti_transfer_div">
                            <div class="mb-3">
                                <label for="bukti_transfer" class="form-label fw-bold"> Bukti Transfer
                                </label>
                                <input type="file" class="form-control" id="bukti_transfer" name="bukti_transfer"
                                    accept="image/*">
                                <div class="form-text">
                                    Format: JPG, PNG, JPEG
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Metode Pembayaran</label>
                                <select name="id_metode_bayar" class="form-select" id="metode_pembayaran">
                                    <option value="">Pilih Metode Pembayaran</option>
                                    <?php
                                    require_once __DIR__ . '/../../layouts/config.php';
                                    $query = mysqli_query($link, "SELECT * FROM metode_pembayaran");
                                    while ($data = mysqli_fetch_array($query)) {
                                        ?>
                                        <option value="<?= $data['id'] ?>" data-jenis="<?= $data['jenis'] ?>">
                                            <?= $data['nama'] . ' - ' . $data['nomor_rekening'] ?>
                                        </option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Simpan</button>
                </div>
            </div> <!-- end card body-->
        </div>

    </div>
</form>

<script>

    function formatDecimal(number) {
        var n = parseFloat(number) || 0;
        return n.toLocaleString('id-ID', { minimumFractionDigits: 0, maximumFractionDigits: 0 });
    }

    function parseDecimal(str) {
        if (typeof str === 'number') return str;
        return parseFloat(str.replace(/\./g, '').replace(',', '.')) || 0;
    }

    $(document).ready(function () {
        $('#tabel-data').DataTable();
        $('#promo').on('change', function () {
            var diskon = parseFloat($(this).val()) || 0;
            var subtotal = parseDecimal($('#subtotal').val());
            var jumlah_diskon = (diskon / 100) * subtotal;
            var total = subtotal - jumlah_diskon;
            var uang_bayar = parseDecimal($('#uang_bayar').val());
            var uang_kembalian = uang_bayar - total;
            $('#total').val(formatDecimal(total));
            $('#jumlah_diskon').val(formatDecimal(jumlah_diskon));
            $('#uang_kembalian').val(formatDecimal(uang_kembalian));
        });
        $('#uang_bayar').on('input', function () {
            var raw = $(this).val().replace(/[^0-9]/g, '');
            var uang_bayar = parseFloat(raw) || 0;
            $(this).val(formatDecimal(uang_bayar));
            var diskon = parseDecimal($('#jumlah_diskon').val());
            var subtotal = parseDecimal($('#subtotal').val());
            var total = subtotal - diskon;
            var uang_kembalian = uang_bayar - total;
            $('#uang_kembalian').val(formatDecimal(uang_kembalian));
        });
        $('#metode_pembayaran').on('change', function () {
            const jenis = $(this).find(':selected').data('jenis');
            if (jenis == 'tunai') {
                //hide bukti transfer
                $('#bukti_transfer_div').hide();
                $('#bukti_transfer').attr('required', false);
            } else {
                //show bukti transfer
                $('#bukti_transfer_div').show();
                $('#bukti_transfer').attr('required', true);
                $('#uang_kembalian_div').hide();
                $('#uang_bayar_div').hide();
            }
        });
        $('#tabel-data').on('click', '#delete', function () {
            const id = $(this).data('id');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus transaksi ini? ', function () {
                $.ajax({
                    type: 'POST',
                    url: 'process/penjualan.php?aksi=hapus-penjualan-detail',
                    data: {
                        id: id
                    },
                    dataType: 'json',
                    success: function (data) {
                        if (data.status === 'success') {
                            loadTable();
                            alertify.success(data.message);
                            window.location.reload();
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
                })
            }, function () {
                alertify.error('Hapus dibatalkan');
            })
        });

        $("#post-penjualan").submit(function (e) {
            e.preventDefault();

            // Strip formatting before sending to server
            $('#subtotal').val(parseDecimal($('#subtotal').val()));
            $('#total').val(parseDecimal($('#total').val()));
            $('#jumlah_diskon').val(parseDecimal($('#jumlah_diskon').val()));
            $('#uang_bayar').val(parseDecimal($('#uang_bayar').val()));
            $('#uang_kembalian').val(parseDecimal($('#uang_kembalian').val()));

            var formData = new FormData(this);
            var nomor_penjualan = $('#nomor_penjualan').val();

            $.ajax({
                type: 'POST',
                url: 'process/penjualan.php?aksi=post-penjualan',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                dataType: 'json',
                success: function (data) {
                    if (data.status === 'success') {
                        alertify.success(data.message);
                        window.open('pages/penjualan/cetak-struk.php?nomor_penjualan=' + nomor_penjualan, '_blank');
                        window.location.reload();
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