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
                                <input type="number" name="subtotal" class="form-control" placeholder="Subtotal"
                                    value="<?php echo $subtotal; ?>" id="subtotal">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Diskon (Rp)</label>
                                <input type="number" name="diskon" class="form-control" placeholder="Diskon" value="0"
                                    id="diskon">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Total</label>
                                <input type="number" name="total" class="form-control" placeholder="Total"
                                    value="<?= $subtotal ?>" id="total">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Uang Bayar (Rp)</label>
                                <input type="number" name="uang_bayar" class="form-control" placeholder="Uang Bayar"
                                    value="0" id="uang_bayar">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Kembalian</label>
                                <input type="number" name="uang_kembalian" class="form-control" placeholder="Kembalian"
                                    value="0" id="uang_kembalian">
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
    $(document).ready(function () {
        $('#tabel-data').DataTable();
        $('#diskon').on('input', function () {
            var diskon = parseFloat($(this).val()) || 0;
            var subtotal = parseFloat($('#subtotal').val()) || 0;
            var total = subtotal - diskon;
            var uang_bayar = parseFloat($('#uang_bayar').val()) || 0;
            var uang_kembalian = uang_bayar - total;
            $('#total').val(total);
            $('#uang_kembalian').val(uang_kembalian);
        });
        $('#uang_bayar').on('input', function () {
            var uang_bayar = parseFloat($(this).val()) || 0;
            var diskon = parseFloat($('#diskon').val()) || 0;
            var subtotal = parseFloat($('#subtotal').val()) || 0;
            var total = subtotal - diskon;
            var uang_kembalian = uang_bayar - total;
            $('#uang_kembalian').val(uang_kembalian);
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