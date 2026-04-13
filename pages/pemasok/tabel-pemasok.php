<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Pemasok</th>
            <th>Alamat</th>
            <th>Telp</th>
            <th>Email</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../layouts/config.php';
        $no = 0;
        $query = mysqli_query($link, "SELECT * FROM pemasok");
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nama'] ?></td>
                <td><?= $data['alamat'] ?></td>
                <td><?= $data['telepon'] ?></td>
                <td>
                    <?= $data['email'] ?>
                </td>
                <td>
                    <button data-id="<?= $data['id'] ?>" data-name="<?= $data['nama'] ?>" id="edit" type="button"
                        class="btn btn-primary">Edit</button>
                    <button data-id="<?= $data['id'] ?>" data-name="<?= $data['nama'] ?>" id="delete" type="button"
                        class="btn btn-danger">Delete</button>
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
                url: 'pages/pemasok/tambah-pemasok.php',
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
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus pemasok ' + name + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'process/pemasok.php?aksi=hapus-pemasok',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            alertify.success('Pemasok Berhasil Dihapus');

                        } else {
                            alertify.error('Pemasok Gagal Dihapus');
                        }
                    },
                    error: function (data) {
                        alertify.error(data);
                    }
                })
            }, function () {
                alertify.error('Hapus dibatalkan');
            })
        });
    });
</script>