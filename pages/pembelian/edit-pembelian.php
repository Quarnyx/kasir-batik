<?php
require_once '../../config.php';
$sql = "SELECT * FROM v_pembelian WHERE id_pembelian = '$_POST[id]'";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<form id="edit-pembelian" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id_pembelian']; ?>">
    <input type="hidden" name="id_transaksi" value="<?= $row['id_transaksi']; ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" name="tanggal_pembelian"
                    value="<?php echo $row['tanggal_pembelian'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Kode Pembelian</label>
                <input type="text" name="kode_pembelian" class="form-control" placeholder="Jumlah Transaksi"
                    value="<?= $row['kode_pembelian'] ?>" readonly>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Barang</label>
                <select class="form-select" name="id_barang">
                    <?php
                    $sql = "SELECT * FROM barang";
                    $result = $conn->query($sql);
                    while ($rowa = $result->fetch_assoc()) {
                        echo '<option value="' . $rowa['id_barang'] . '"' . ($rowa['id_barang'] == $row['id_barang'] ? 'selected' : '') . '>' . $rowa['nama_barang'] . '</option>';
                    }

                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Supplier</label>
                <select class="form-select" name="id_supplier">
                    <?php
                    $sql = "SELECT * FROM supplier";
                    $result = $conn->query($sql);
                    while ($rowb = $result->fetch_assoc()) {
                        echo '<option value="' . $rowb['id_supplier'] . '"' . ($rowb['id_supplier'] == $row['id_supplier'] ? 'selected' : '') . '>' . $rowb['nama_supplier'] . '</option>';
                    }

                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Harga Beli</label>
                <input type="number" class="form-control" name="harga_beli" value="<?= $row['harga_beli'] ?>">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Jumlah Beli</label>
                <input type="number" class="form-control" name="qty" value="<?= $row['qty'] ?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Akun Debit</label>
                <select class="form-select" name="id_akun_debit">
                    <?php
                    require_once '../../config.php';

                    $sql = "SELECT * FROM akun";
                    $result = $conn->query($sql);
                    while ($rowc = $result->fetch_assoc()) {
                        echo '<option value="' . $rowc['id_akun'] . '"' . ($rowc['id_akun'] == $row['id_akun_debit'] ? 'selected' : '') . '>' . $rowc['nama_akun'] . '</option>';
                    }

                    ?>
                </select>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Akun Kredit</label>
                <select class="form-select" name="id_akun_kredit">
                    <?php
                    require_once '../../config.php';

                    $sql = "SELECT * FROM akun";
                    $result = $conn->query($sql);
                    while ($rowd = $result->fetch_assoc()) {
                        echo '<option value="' . $rowd['id_akun'] . '"' . ($rowd['id_akun'] == $row['id_akun_kredit'] ? 'selected' : '') . '>' . $rowd['nama_akun'] . '</option>';
                    }

                    ?>
                </select>
            </div>
        </div>
    </div>


    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

<script>
    $("#edit-pembelian").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=edit-pembelian',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('Pembelian Berhasil Diedit');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>