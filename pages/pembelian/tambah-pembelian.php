<form id="tambah-pembelian" enctype="multipart/form-data">

    <div class="row">
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Tanggal Pembelian</label>
                <input type="date" class="form-control" name="tanggal_pembelian">
            </div>
        </div>
        <?php
        require_once '../../config.php';
        $query = mysqli_query($conn, "SELECT MAX(kode_pembelian) AS kode_pembelian FROM pembelian");
        $data = mysqli_fetch_array($query);
        $max = $data['kode_pembelian'] ? substr($data['kode_pembelian'], 3, 3) : "000";
        $no = $max + 1;
        $char = "PMB";
        $kode = $char . sprintf("%03s", $no);
        ?>
        <div class="col-lg-6">
            <div class="mb-3">
                <label class="form-label">Kode Pembelian</label>
                <input type="text" name="kode_pembelian" class="form-control" placeholder="Jumlah Transaksi"
                    value="<?= $kode; ?>" readonly>
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
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_barang'] . '">' . $row['nama_barang'] . '</option>';
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
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_supplier'] . '">' . $row['nama_supplier'] . '</option>';
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
                <input type="number" class="form-control" name="harga_beli">
            </div>
        </div>
        <div class="col-lg-6">
            <div class="mb-3">
                <label for="simpleinput" class="form-label">Jumlah Beli</label>
                <input type="number" class="form-control" name="qty">
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
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_akun'] . '">' . $row['nama_akun'] . '</option>';
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
                    while ($row = $result->fetch_assoc()) {
                        echo '<option value="' . $row['id_akun'] . '">' . $row['nama_akun'] . '</option>';
                    }

                    ?>
                </select>
            </div>
        </div>
    </div>
    <div class="row mb-3">
        <div class="col-lg-12">
            <label class="form-label">Upload Nota</label>
            <input type="file" class="form-control" name="gambar">
        </div>
    </div>

    <div class="row">
        <div class="col-md-4">
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>
</form>

<script>
    $("#tambah-pembelian").submit(function (e) {
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
            type: 'POST',
            url: 'proses.php?act=tambah-pembelian',
            data: formData,
            cache: false,
            contentType: false,
            processData: false,
            success: function (data) {
                $(".modal").modal('hide');
                loadTable();

                // alertify pesan sukses
                alertify.success('Pembelian Berhasil Ditambah');

            },
            error: function (data) {
                alertify.error(data);
            }
        });
    });
</script>