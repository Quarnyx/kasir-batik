<?php
require_once '../../layouts/config.php';
$id_pengembalian = $link->real_escape_string($_POST['id']);
$sql = "SELECT * FROM pengembalian_penjualan WHERE id = '$id_pengembalian'";
$result = $link->query($sql);

$row = $result->fetch_assoc();
?>

<form id="edit-pengembalian" enctype="multipart/form-data">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <div class="row">
        <div class="row">
            <div class="col">
                <div class="mb-3">
                    <label for="jumlah_pengembalian" class="form-label">Jumlah Pengembalian</label>
                    <input type="number" id="jumlah_pengembalian" class="form-control" name="jumlah_pengembalian"
                        min="1" value="<?= $row['jumlah_pengembalian'] ?>" required>
                </div>
                <div class="mb-3">
                    <label for="alasan_pengembalian" class="form-label">Alasan Pengembalian</label>
                    <textarea id="alasan_pengembalian" class="form-control" name="alasan_pengembalian" rows="3"
                        required><?= $row['alasan_pengembalian'] ?></textarea>
                </div>
            </div>
            <div class="col">
                <div class="mb-3">
                    <label for="tanggal_pengembalian" class="form-label">Tanggal Pengembalian</label>
                    <input type="date" id="tanggal_pengembalian" class="form-control" name="tanggal_pengembalian"
                        value="<?= $row['tanggal_pengembalian'] ?>">
                </div>

                <div class="mb-3">
                    <label for="nominal_pengembalian" class="form-label">Nominal Pengembalian</label>
                    <input type="text" id="nominal_pengembalian" class="form-control" name="nominal_pengembalian"
                        value="<?= number_format($row['nominal_pengembalian'], 0, ',', '.') ?>">
                </div>
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
    $('document').ready(function () {

        $('#nominal_pengembalian').on('input', function () {
            var angka = $(this).val()
                .replace(/[^\d]/g, '');

            $(this).val(angka.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, "$1."));
        });
    });
    $("#edit-pengembalian").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'process/pengembalian.php?aksi=edit-pengembalian',
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