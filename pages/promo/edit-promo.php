<?php
require_once '../../layouts/config.php';
$id_promo = $link->real_escape_string($_POST['id']);
$sql = "SELECT * FROM promo WHERE id = '$id_promo'";
$result = $link->query($sql);

$row = $result->fetch_assoc();
?>

<form id="edit-promo" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="promo" class="form-label">Nama Promo</label>
                <input type="text" id="promo" class="form-control" name="promo" value="<?= $row['promo'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="persen_diskon" class="form-label">Persen Diskon (%)</label>
                <input type="number" id="persen_diskon" class="form-control" name="persen_diskon"
                    value="<?= $row['persen_diskon'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
                <input type="date" id="tanggal_mulai" class="form-control" name="tanggal_mulai"
                    value="<?= $row['tanggal_mulai'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal_selesai" class="form-label">Tanggal Berakhir</label>
                <input type="date" id="tanggal_selesai" class="form-control" name="tanggal_selesai"
                    value="<?= $row['tanggal_selesai'] ?>" required>
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
    $("#edit-promo").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'process/promo.php?aksi=edit-promo',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            dataType: 'json',
            success: function (data) {
                if (data.status === 'success') {
                    $(".modal").modal('hide');
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
</script>