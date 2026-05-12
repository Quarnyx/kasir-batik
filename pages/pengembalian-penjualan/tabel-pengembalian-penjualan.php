<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Penjualan</th>
            <th>Produk</th>
            <th>Jumlah</th>
            <th>Alasan</th>
            <th>Tanggal Pengembalian</th>
            <th>Nominal Pengembalian</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../layouts/config.php';
        $no = 0;
        session_start();
        $query = mysqli_query($link, "SELECT * FROM v_pengembalian_penjualan");

        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nomor_penjualan'] ?></td>
                <td><?= $data['nama'] . $data['kode_sku'] ?></td>
                <td><?= $data['jumlah_pengembalian'] ?></td>
                <td><?= $data['alasan_pengembalian'] ?>
                </td>
                <td><?= $data['tanggal_pengembalian'] ?></td>
                <td>Rp. <?= number_format($data['nominal_pengembalian'], 0, ',', '.') ?></td>
                <td>
                    <button data-id="<?= $data['id'] ?>" data-name="<?= $data['nomor_penjualan'] ?>" id="edit" type="button"
                        class="btn btn-primary">Edit</button>
                    <button data-id="<?= $data['id'] ?>" data-name="<?= $data['nomor_penjualan'] ?>" id="delete"
                        type="button" class="btn btn-danger">Delete</button>
                </td>
            </tr>
            <?php
        }
        ?>
    </tbody>
</table>
<script>
    $(document).ready(function () {
        $('#tabel-data').DataTable();
        $('#tabel-data').on('click', '#edit', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            $.ajax({
                type: 'POST',
                url: 'pages/pengembalian-penjualan/edit-pengembalian-penjualan.php',
                data: 'id=' + id + '&name=' + name,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Data ' + name);
                    $('.modal .modal-body').html(data);
                }
            })
        });
        $('#tabel-data').on('click', '#delete', function () {
            const id = $(this).data('id');
            const name = $(this).data('name');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data ' + name + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'process/pengembalian.php?aksi=hapus-pengembalian',
                    data: 'id=' + id,
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
    });
</script>