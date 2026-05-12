<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor Penjualan</th>
            <th>Tanggal Penjualan</th>
            <th>Subtotal</th>
            <th>Diskon</th>
            <th>Total</th>
            <th>Metode Pembayaran</th>
            <th>Bukti Transfer</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../layouts/config.php';
        $no = 0;
        $query = mysqli_query($link, "SELECT * FROM penjualan LEFT JOIN metode_pembayaran ON penjualan.id_metode_bayar = metode_pembayaran.id");
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nomor_penjualan'] ?></td>
                <td><?= $data['tanggal_jual'] ?></td>
                <td><?= number_format($data['subtotal'], 0, ',', '.') ?></td>
                <td><?= number_format($data['jumlah_diskon'], 0, ',', '.') ?></td>
                <td><?= number_format($data['total'], 0, ',', '.') ?></td>
                <td><?= $data['nama'] ?></td>
                <td>
                    <?php if ($data['upload'] === '') { ?>
                        Tunai
                    <?php } else { ?>
                        <img class="img-fluid" width="50" src="<?= $data['upload'] ?>">
                    <?php } ?>
                </td>
                <td>
                    <a href="pages/penjualan/cetak-struk.php?nomor_penjualan=<?= $data['nomor_penjualan'] ?>"
                        target="_blank" class="btn btn-primary">Cetak</a>
                    <button data-id="<?= $data['nomor_penjualan'] ?>" data-name="<?= $data['nomor_penjualan'] ?>" id="edit"
                        type="button" class="btn btn-primary">Detail</button>
                    <button data-id="<?= $data['nomor_penjualan'] ?>" data-name="<?= $data['nomor_penjualan'] ?>"
                        id="delete" type="button" class="btn btn-danger">Delete</button>
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
                url: 'pages/penjualan/detail-penjualan.php',
                data: 'id=' + id + '&name=' + name,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Detail Data ' + name);
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
                    url: 'process/penjualan.php?aksi=hapus-penjualan',
                    data: 'id=' + id,
                    success: function (data) {
                        alertify.success('Penjualan Berhasil Dihapus');
                        loadTable();
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