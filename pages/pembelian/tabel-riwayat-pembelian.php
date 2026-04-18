<table id="tabel-data" class="table table-bordered table-bordered dt-responsive nowrap">
    <thead>
        <tr>
            <th>#</th>
            <th>Nomor PO</th>
            <th>Tanggal Pesan</th>
            <th>Tanggal Ekspektasi</th>
            <th>Tanggal Terima</th>
            <th>Subtotal</th>
            <th>Ongkir</th>
            <th>Pajak</th>
            <th>Total</th>
            <th>Status</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        <?php
        require_once __DIR__ . '/../../layouts/config.php';
        $no = 0;
        $query = mysqli_query($link, "SELECT * FROM pesanan_pembelian");
        while ($data = mysqli_fetch_array($query)) {
            $no++;
            ?>
            <tr>
                <td><?= $no ?></td>
                <td><?= $data['nomor_po'] ?></td>
                <td><?= $data['tanggal_pesan'] ?></td>
                <td><?= $data['tanggal_ekspektasi'] ?></td>
                <td>
                    <?= $data['tanggal_terima'] ?>
                </td>
                <td><?= number_format($data['subtotal'], 0, ',', '.') ?></td>
                <td><?= number_format($data['ongkos_kirim'], 0, ',', '.') ?></td>
                <td><?= number_format($data['jumlah_pajak'], 0, ',', '.') ?></td>
                <td><?= number_format($data['total'], 0, ',', '.') ?></td>
                <td><?= $data['status'] ?></td>
                <td>
                    <button data-id="<?= $data['nomor_po'] ?>" data-name="<?= $data['nomor_po'] ?>" id="edit" type="button"
                        class="btn btn-primary">Detail</button>
                    <button data-id="<?= $data['nomor_po'] ?>" data-name="<?= $data['nomor_po'] ?>" id="delete"
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
                url: 'pages/pembelian/detail-pembelian.php',
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
                    url: 'process/pembelian.php?aksi=hapus-pembelian',
                    data: 'id=' + id,
                    success: function (data) {
                        alertify.success('Pembelian Berhasil Dihapus');
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