<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah-produk':
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $kode = mysqli_real_escape_string($link, $_POST['kode'] ?? '');
        $nama = mysqli_real_escape_string($link, $_POST['nama'] ?? '');
        $id_kategori = !empty($_POST['id_kategori']) ? (int) $_POST['id_kategori'] : null;
        $deskripsi = mysqli_real_escape_string($link, $_POST['deskripsi'] ?? '');
        $satuan = mysqli_real_escape_string($link, $_POST['satuan'] ?? '');

        $id_kategori_sql = $id_kategori !== null ? $id_kategori : 'NULL';

        if ($id > 0) {
            $sql = "UPDATE produk SET kode = '$kode', nama = '$nama', id_kategori = $id_kategori_sql, deskripsi = '$deskripsi', satuan = '$satuan' WHERE id = $id";
        } else {
            $sql = "INSERT INTO produk (kode, nama, id_kategori, deskripsi, satuan) VALUES ('$kode', '$nama', $id_kategori_sql, '$deskripsi', '$satuan')";
        }

        if (mysqli_query($link, $sql)) {
            echo "ok";
        } else {
            echo 'Error: ' . mysqli_error($link);
        }
        break;
    default:
        echo "Aksi tidak ditemukan";
        break;
}
