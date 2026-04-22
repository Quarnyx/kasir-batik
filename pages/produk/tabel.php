<?php
require_once __DIR__ . '/../../layouts/config.php';
$sql = "SELECT
	produk.id,
	produk.kode,
	produk.nama,
	produk.id_kategori,
	produk.deskripsi,
	produk.satuan,
	kategori.nama_kategori
FROM
	produk
	INNER JOIN
	kategori
	ON 
		produk.id_kategori = kategori.id";
$result = mysqli_query($link, $sql);
$data = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Data Produk</h4>
        </div>
        <div class="card-body">
            <table class="table table-bordered" id="data-table">
                <thead>
                    <tr>
                        <th>Kode</th>
                        <th>Nama Produk</th>
                        <th>Kategori</th>
                        <th>Satuan</th>
                        <th>Foto</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (!$data): ?>
                        <tr>
                            <td colspan="8">Belum ada data produk.</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($data as $row): ?>
                            <tr>
                                <td><?= $row['kode'] ?></td>
                                <td><?= $row['nama'] ?></td>
                                <td><?= $row['nama_kategori'] ?? '-' ?></td>
                                <td><?= $row['satuan'] ?? '-' ?></td>
                                <td><img src="assets/images/produk/<?= $row['foto'] ?>" alt="Foto Produk" width="100"
                                        height="100"></td>
                                <td>
                                    <button class="btn btn-info" id="edit" data-id="<?= $row['id'] ?>"
                                        data-nama="<?= $row['nama'] ?>">Edit</button>
                                    <a href="?page=produk-variasi&id=<?= $row['id'] ?>" class="btn btn-warning"
                                        data-nama="<?= $row['nama'] ?>">Variasi</a>
                                    <button class="btn btn-danger" id="delete" data-id="<?= $row['id'] ?>"
                                        data-nama="<?= $row['nama'] ?>">Hapus</button>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <!-- end card body -->
    </div>
    <!-- end card -->
</div>
<!-- end col -->
<script>
    $(document).ready(function () {
        new DataTable('#data-table',
            {
                responsive: true
            }
        );
        $('#data-table').on('click', '#edit', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            $.ajax({
                type: 'POST',
                url: 'pages/produk/form.php',
                data: 'id=' + id + '&nama=' + nama,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Data ' + nama);
                    $('.modal .modal-body').html(data);
                }
            })
        });
        $('#data-table').on('click', '#delete', function () {
            const id = $(this).data('id');
            const nama = $(this).data('nama');
            alertify.confirm('Hapus', 'Apakah anda yakin ingin menghapus data ' + nama + '?', function () {
                $.ajax({
                    type: 'POST',
                    url: 'process/produk.php?aksi=hapus-produk',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            $('.modal').modal('hide');
                            alertify.success('Barang Berhasil Dihapus');

                        } else {
                            alertify.error('Barang Gagal Dihapus');

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