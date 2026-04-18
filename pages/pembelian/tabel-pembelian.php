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
                            <th>Harga Beli</th>
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
                        $harga_beli = 0;
                        $harga_jual = 0;
                        $query = mysqli_query($link, "SELECT * FROM v_pembelian WHERE nomor_po = '$_POST[nomor_po]'");
                        while ($data = mysqli_fetch_array($query)) {
                            ?>
                            <tr>
                                <td>
                                    <?= $data['nomor_po'] ?>
                                </td>
                                <td>
                                    <?= $data['nama'] . ' - ' . $data['nama_variasi'] ?>
                                </td>
                                <td>Rp.
                                    <?= number_format($data['harga_beli'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <?= $data['jumlah_pesan'] ?>
                                </td>
                                <td>
                                    <?= $data['satuan'] ?>
                                </td>
                                <td>Rp.
                                    <?= number_format($data['harga_beli'] * $data['jumlah_pesan'], 0, ',', '.') ?>
                                </td>
                                <td>
                                    <button data-id="<?= $data['id'] ?>" id="delete" type="button"
                                        class="btn btn-danger">Delete</button>
                                </td>
                            </tr>
                            <?php
                            $harga_beli += $data['harga_beli'] * $data['jumlah_pesan'];
                            $subtotal += ($data['harga_beli'] * $data['jumlah_pesan']);
                        }
                        ?>
                    </tbody>
                </table>

            </div> <!-- end card body-->
        </div> <!-- end card -->
    </div><!-- end col-->
</div>
<!-- end row-->

<form id="post-pembelian" enctype="multipart/form-data">
    <input type="hidden" name="nomor_po" value="<?= $_POST['nomor_po'] ?>" id="nomor_po">
    <input type="hidden" name="id_pengguna" value="<?= $_SESSION['id'] ?>" id="id_pengguna">
    <div class="row">
        <div class=" col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label class="form-label">Tanggal Pesan</label>
                                <input type="date" name="tanggal_pesan" class="form-control"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Tanggal Ekspektasi Datang</label>
                                <input type="date" name="tanggal_ekspektasi" class="form-control"
                                    value="<?= date('Y-m-d') ?>">
                            </div>
                        </div>
                        <div class="col-md-4">
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
                                <label for="simpleinput" class="form-label">Pemasok</label>
                                <select class="form-select" name="id_pemasok" id="id_pemasok" required>
                                    <option value="">Pilih Pemasok</option>
                                    <?php
                                    $sql = "SELECT * FROM pemasok";
                                    $result = $link->query($sql);
                                    while ($row = $result->fetch_assoc()) {
                                        ?>
                                        <option value="<?= $row['id'] ?>"><?= $row['nama'] ?></option>
                                        <?php
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Ongkos Kirim</label>
                                <input type="number" name="ongkir" class="form-control" placeholder="Ongkos Kirim"
                                    value="0" id="ongkir">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Pajak (%)</label>
                                <input type="text" name="pajak" class="form-control" placeholder="Pajak" value="0"
                                    id="pajak">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Diskon (Rp)</label>
                                <input type="number" name="diskon" class="form-control" placeholder="Diskon" value="0"
                                    id="diskon">
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="simpleinput" class="form-label">Total</label>
                                <input type="number" name="total" class="form-control" placeholder="Total"
                                    value="<?= $subtotal ?>" id="total">
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
        var choicesIdPemasok = new Choices('#id_pemasok', {
            searchEnabled: true,
            placeholderValue: 'Pilih Pemasok',
            searchPlaceholderValue: 'Cari pemasok...',
            itemSelectText: 'Pilih',
            noResultsText: 'Tidak ditemukan',
        });
        $('#pajak').on('input', function () {
            var pajak = parseFloat($(this).val()) || 0;
            var diskon = parseFloat($('#diskon').val()) || 0;
            var subtotal = parseFloat($('#subtotal').val()) || 0;
            var ongkir = parseFloat($('#ongkir').val()) || 0;
            var total = subtotal - diskon + (subtotal * pajak / 100) + ongkir;
            $('#total').val(total);
        });
        $('#diskon').on('input', function () {
            var diskon = parseFloat($(this).val()) || 0;
            var pajak = parseFloat($('#pajak').val()) || 0;
            var subtotal = parseFloat($('#subtotal').val()) || 0;
            var ongkir = parseFloat($('#ongkir').val()) || 0;
            var total = subtotal - diskon + (subtotal * pajak / 100) + ongkir;
            $('#total').val(total);
        });
        $('#ongkir').on('input', function () {
            var ongkir = parseFloat($(this).val()) || 0;
            var diskon = parseFloat($('#diskon').val()) || 0;
            var subtotal = parseFloat($('#subtotal').val()) || 0;
            var pajak = parseFloat($('#pajak').val()) || 0;
            var total = subtotal - diskon + (subtotal * pajak / 100) + ongkir;
            $('#total').val(total);
        });
        $('#tabel-data').on('click', '#delete', function () {
            const id = $(this).data('id');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus transaksi ini? ', function () {
                $.ajax({
                    type: 'POST',
                    url: 'process/pembelian.php?aksi=hapus-pembelian-detail',
                    data: {
                        id: id
                    },
                    success: function (data) {
                        loadTable();
                        alertify.success('Transaksi Berhasil Dihapus');
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Hapus dibatalkan');
            })
        });

        $("#post-pembelian").submit(function (e) {
            e.preventDefault();
            var formData = new FormData(this);
            var nomor_po = $('#nomor_po').val();

            $.ajax({
                type: 'POST',
                url: 'process/pembelian.php?aksi=post-pembelian',
                data: formData,
                cache: false,
                contentType: false,
                processData: false,
                success: function (data) {
                    window.location.reload();
                },
                error: function (data) {
                    alertify.error(data);
                }
            });

        });


    });
</script>