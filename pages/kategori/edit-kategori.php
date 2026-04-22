<?php
require_once '../../layouts/config.php';
$id_kategori = $link->real_escape_string($_POST['id']);
$sql = "SELECT * FROM kategori WHERE id = '$id_kategori'";
$result = $link->query($sql);

$row = $result->fetch_assoc();
?>

<form id="edit-kategori" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" id="nama_kategori" class="form-control" name="nama_kategori" value="<?= $row['nama_kategori'] ?>" required>
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
    $("#edit-kategori").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'process/kategori.php?aksi=edit-kategori',
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
