<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nama Promo</th>
            <th>Persen Diskon</th>
            <th>Tanggal Mulai</th>
            <th>Tanggal Berakhir</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../layouts/config.php';
        $no = 0;
        session_start();
        $query = mysqli_query($link, "SELECT * FROM promo");

        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['promo'] ?></td>
                <td><?= $data['persen_diskon'] ?>%</td>
                <td><?= date('d-m-Y', strtotime($data['tanggal_mulai'])) ?></td>
                <td><?= date('d-m-Y', strtotime($data['tanggal_selesai'])) ?></td>
                <td>
                    <?php if ($_SESSION['level'] === "admin") { ?>
                        <button data-id="<?= $data['id'] ?>" data-name="<?= $data['promo'] ?>" id="edit" type="button"
                            class="btn btn-primary">Edit</button>
                        <button data-id="<?= $data['id'] ?>" data-name="<?= $data['promo'] ?>" id="delete" type="button"
                            class="btn btn-danger">Delete</button>
                    <?php } else {
                        echo "-";
                    } ?>
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
                url: 'pages/promo/edit-promo.php',
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
                    url: 'process/promo.php?aksi=hapus-promo',
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