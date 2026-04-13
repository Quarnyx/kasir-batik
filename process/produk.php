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
    case 'hapus-produk':
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $sql = "DELETE FROM produk WHERE id = $id";
        if (mysqli_query($link, $sql)) {
            echo "ok";
        } else {
            echo 'Error: ' . mysqli_error($link);
        }
        break;
    case 'tambah-variasi':
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $id_produk = mysqli_real_escape_string($link, $_POST['id_produk'] ?? '');
        $kode_sku = mysqli_real_escape_string($link, $_POST['kode_sku'] ?? '');
        $nama_variasi = mysqli_real_escape_string($link, $_POST['nama_variasi'] ?? '');
        $harga_beli = mysqli_real_escape_string($link, $_POST['harga_beli'] ?? '');
        $harga_jual = mysqli_real_escape_string($link, $_POST['harga_jual'] ?? '');

        // Handle photo upload
        $foto_sql = '';
        if (isset($_FILES['foto']) && $_FILES['foto']['error'] === UPLOAD_ERR_OK) {
            $foto = $_FILES['foto']['name'];
            $ekstensi_diperbolehkan = array('png', 'jpg', 'jpeg', 'gif');
            $x = explode('.', $foto);
            $ekstensi = strtolower(end($x));
            $file_tmp = $_FILES['foto']['tmp_name'];
            $foto = $kode_sku . "." . $ekstensi;
            $file_loc = __DIR__ . '/../assets/produk/' . $foto;

            // Delete old photo if editing
            if ($id > 0) {
                $old = mysqli_query($link, "SELECT foto FROM produk_sku WHERE id = $id");
                $old_row = mysqli_fetch_assoc($old);
                if ($old_row && $old_row['foto'] != '') {
                    $old_file = __DIR__ . '/../assets/produk/' . $old_row['foto'];
                    if (file_exists($old_file)) {
                        unlink($old_file);
                    }
                }
            }

            move_uploaded_file($file_tmp, $file_loc);
            $foto_sql = ", foto = '$foto'";
        }

        if ($id > 0) {
            // Update existing variation
            $sql = "UPDATE produk_sku SET kode_sku = '$kode_sku', nama_variasi = '$nama_variasi', harga_beli = '$harga_beli', harga_jual = '$harga_jual' $foto_sql WHERE id = $id";
        } else {
            // Insert new variation
            $foto_value = isset($foto) ? $foto : '';
            $sql = "INSERT INTO `produk_sku` (`id_produk`, `kode_sku`, `nama_variasi`, `harga_beli`, `harga_jual`, `foto`) VALUES ('$id_produk', '$kode_sku', '$nama_variasi', '$harga_beli', '$harga_jual', '$foto_value')";
        }

        if (mysqli_query($link, $sql)) {
            echo "ok";
        } else {
            echo 'Error: ' . mysqli_error($link);
        }
        break;
    case 'hapus-variasi-produk':
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $sql = "DELETE FROM produk_sku WHERE id = $id";
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
