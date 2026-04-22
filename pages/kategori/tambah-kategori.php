<form id="tambah-kategori" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-12">
            <div class="mb-3">
                <label for="nama_kategori" class="form-label">Nama Kategori</label>
                <input type="text" id="nama_kategori" class="form-control" name="nama_kategori" placeholder="Nama Kategori" required>
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
    $("#tambah-kategori").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'process/kategori.php?aksi=tambah-kategori',
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
