<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah-pemasok':
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $nama = mysqli_real_escape_string($link, $_POST['nama'] ?? '');
        $telepon = mysqli_real_escape_string($link, $_POST['telepon'] ?? '');
        $email = mysqli_real_escape_string($link, $_POST['email'] ?? '');
        $alamat = mysqli_real_escape_string($link, $_POST['alamat'] ?? '');

        if ($id > 0) {
            $sql = "UPDATE pemasok SET nama = '$nama', telepon = $telepon, email = '$email', alamat = '$alamat' WHERE id = $id";
        } else {
            $sql = "INSERT INTO pemasok (nama, telepon, email, alamat) VALUES ('$nama', '$telepon', '$email', '$alamat')";
        }

        if (mysqli_query($link, $sql)) {
            echo "ok";
        } else {
            echo 'Error: ' . mysqli_error($link);
        }
        break;
    case 'hapus-pemasok':
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $sql = "DELETE FROM pemasok WHERE id = $id";
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