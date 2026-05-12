<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {

    case 'post-penjualan':
        $nomor_penjualan = $_POST['nomor_penjualan'];
        $tanggal_penjualan = $_POST['tanggal_penjualan'];
        $subtotal = preg_replace('/[^0-9]/', '', $_POST['subtotal']);
        $jumlah_diskon = preg_replace('/[^0-9]/', '', $_POST['jumlah_diskon']);
        $total = preg_replace('/[^0-9]/', '', $_POST['total']);
        $uang_bayar = isset($_POST['uang_bayar']) ? preg_replace('/[^0-9]/', '', $_POST['uang_bayar']) : 0;
        $uang_kembalian = isset($_POST['uang_kembalian']) ? preg_replace('/[^0-9]/', '', $_POST['uang_kembalian']) : 0;
        $id_kasir = $_POST['id_kasir'];
        $id_metode_bayar = $_POST['id_metode_bayar'];
        $bukti_path = null;
        if (isset($_FILES['bukti_transfer']) && $_FILES['bukti_transfer']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = '../uploads/';
            if (!is_dir($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }

            $allowed_types = ['image/jpeg', 'image/jpg', 'image/png'];
            $file_type = $_FILES['bukti_transfer']['type'];

            if (!in_array($file_type, $allowed_types)) {
                throw new Exception('Format file harus JPG, JPEG, atau PNG');
            }

            if ($_FILES['bukti_transfer']['size'] > 5 * 1024 * 1024) {
                throw new Exception('Ukuran file maksimal 5MB');
            }

            $file_ext = pathinfo($_FILES['bukti_transfer']['name'], PATHINFO_EXTENSION);
            $file_name = 'transfer_' . $nomor_penjualan . '_' . time() . '.' . $file_ext;
            $foto_path_full = $upload_dir . $file_name;

            if (move_uploaded_file($_FILES['bukti_transfer']['tmp_name'], $foto_path_full)) {
                $bukti_path = 'uploads/' . $file_name;
            }
        }
        $sql = "INSERT INTO penjualan (nomor_penjualan, tanggal_jual, subtotal, jumlah_diskon, total, uang_bayar, uang_kembalian, id_kasir, id_metode_bayar, upload) 
        VALUES ('$nomor_penjualan', '$tanggal_penjualan', '$subtotal', '$jumlah_diskon', '$total', '$uang_bayar', '$uang_kembalian', '$id_kasir', '$id_metode_bayar', '$bukti_path')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Penjualan Berhasil']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'tambah-penjualan-detail':

        $id_sku = $_POST['id_sku'];
        $nomor_penjualan = $_POST['nomor_penjualan'];
        $harga_beli = preg_replace('/[^0-9]/', '', $_POST['harga_beli']);
        $harga_jual = preg_replace('/[^0-9]/', '', $_POST['harga_jual']);
        $jumlah = $_POST['jumlah'];
        $subtotal = $harga_jual * $jumlah;
        $sql = "INSERT INTO detail_penjualan (id_sku, jumlah, harga_jual, nomor_penjualan, subtotal, harga_beli) 
        VALUES ('$id_sku', '$jumlah', '$harga_jual', '$nomor_penjualan', '$subtotal', '$harga_beli')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Penjualan Berhasil Ditambah ke Keranjang']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus-penjualan-detail':
        $id = $_POST['id'];
        $sql = "DELETE FROM detail_penjualan WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Penjualan Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus-penjualan':
        $nomor_po = $_POST['id'];
        $sql = "DELETE FROM penjualan WHERE nomor_penjualan = '$nomor_po'";
        $result = $link->query($sql);
        if ($result) {
            echo "ok";
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }
        $sql = "DELETE FROM detail_penjualan WHERE nomor_penjualan = '$nomor_po'";
        $result = $link->query($sql);
        if ($result) {
            echo "ok";
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }

        break;

}