<?php
require_once '../../layouts/config.php';
$sql = "SELECT * FROM metode_pembayaran WHERE id = '$_POST[id]'";
$result = $link->query($sql);

$row = $result->fetch_assoc();
?>

<form id="edit-metode-pembayaran" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama</label>
                <input type="text" id="simpleinput" class="form-control" name="nama" value="<?= $row['nama'] ?>">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nomor Rekening</label>
                <input type="text" name="nomor_rekening" class="form-control" placeholder="Nomor Rekening"
                    value="<?= $row['nomor_rekening'] ?>">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select class="form-select" name="jenis">
                    <option value="tunai" <?php if ($row['jenis'] == 'tunai')
                        echo 'selected' ?>>Tunai</option>
                        <option value="transfer" <?php if ($row['jenis'] == 'transfer')
                        echo 'selected' ?>>Transfer</option>
                        <option value="qris" <?php if ($row['jenis'] == 'qris')
                        echo 'selected' ?>>QRIS</option>
                        <option value="kartu" <?php if ($row['jenis'] == 'kartu')
                        echo 'selected' ?>>Kartu</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Pemilik</label>
                    <input type="text" name="nama_pemilik" class="form-control" placeholder="Nama Pemilik"
                        value="<?= $row['nama_pemilik'] ?>">
            </div>
        </div>
        <div class="row">
            <div class="col-md-4">
                <button type="submit" class="btn btn-primary">Simpan</button>
            </div>
        </div>
    </div>
</form>

<script>
    $("#edit-metode-pembayaran").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'process/metode-pembayaran.php?aksi=edit-metode-pembayaran',
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