<div class="col-lg-12">
    <div class="card">
        <div class="card-header">
            <h4>Data Variasi Produk</h4>
        </div>
        <div class="card-body"></div>
        <div class="table-responsive">
            <table class="table table-hover" id="data-table">
                <thead>
                    <tr>
                        <th class="wd-30">
                            No
                        </th>
                        <th>Kode SKU</th>
                        <th>Nama Variasi</th>
                        <th>Harga Beli</th>
                        <th>Harga Jual</th>
                        <th>Gambar</th>
                        <th class="text-end">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    require_once __DIR__ . '/../../layouts/config.php';
                    $sql = mysqli_query($link, "SELECT * FROM produk_sku WHERE id_produk = '$_POST[id_produk]'");
                    $no = 0;

                    while ($row = mysqli_fetch_array($sql)) {
                        $no++;
                        ?>
                        <tr class="single-item">
                            <td>
                                <span class="fs-12 text-muted">#<?php echo $no ?></span>
                            </td>
                            <td><?php echo $row['kode_sku'] ?></td>
                            <td><?php echo $row['nama_variasi'] ?></td>
                            <td><?php echo $row['harga_beli'] ?></td>
                            <td><?php echo $row['harga_jual'] ?></td>
                            <td>
                                <?php if ($row['foto'] === '') { ?>

                                <?php } else { ?>
                                    <img class="img-fluid" width="50" src="../assets/produk/<?php echo $row['foto'] ?>">

                                <?php } ?>
                            </td>
                            <td>
                                <button class="btn btn-warning" id="edit" data-id="<?= $row['id'] ?>"
                                    data-nama="<?= $row['nama_variasi'] ?>">Edit</button>
                                <button class="btn btn-danger" id="delete" data-id="<?= $row['id'] ?>"
                                    data-nama="<?= $row['nama_variasi'] ?>">Hapus</button>
                            </td>
                        </tr>
                    <?php } ?>

                </tbody>
            </table>
        </div>
    </div>
</div>
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
                url: 'pages/produk/tambah-variasi.php',
                data: 'id=' + id,
                success: function (data) {
                    $('.modal').modal('show');
                    $('.modal-title').html('Edit Variasi ' + nama);
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
                    url: 'process/produk.php?aksi=hapus-variasi-produk',
                    data: 'id=' + id,
                    success: function (data) {
                        if (data == "ok") {
                            loadTable();
                            $('.modal').modal('hide');
                            alertify.success('Variasi Produk Berhasil Dihapus');

                        } else {
                            alertify.error('Variasi Produk Gagal Dihapus');

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