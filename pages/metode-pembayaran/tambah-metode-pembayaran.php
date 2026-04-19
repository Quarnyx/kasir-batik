<form id="tambah-metode-pembayaran" enctype="multipart/form-data">
    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Nama</label>
                <input type="text" id="simpleinput" class="form-control" name="nama">
            </div>
            <div class="mb-3">
                <label for="" class="form-label">Nomor Rekening</label>
                <input type="text" name="nomor_rekening" class="form-control" placeholder="Nomor Rekening">
            </div>
        </div>

        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Jenis</label>
                <select class="form-select" name="jenis">
                    <option value="tunai">Tunai</option>
                    <option value="transfer">Transfer</option>
                    <option value="qris">QRIS</option>
                    <option value="kartu">Kartu</option>
                </select>
            </div>
            <div class="mb-3">
                <label class="form-label">Nama Pemilik</label>
                <input type="text" name="nama_pemilik" class="form-control" placeholder="Nama Pemilik">
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
    $("#tambah-metode-pembayaran").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'process/metode-pembayaran.php?aksi=tambah-metode-pembayaran',
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