<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {

    case 'post-penjualan':
        $nomor_penjualan = $_POST['nomor_penjualan'];
        $tanggal_penjualan = $_POST['tanggal_penjualan'];
        $subtotal = $_POST['subtotal'];
        $jumlah_diskon = $_POST['jumlah_diskon'];
        $total = $_POST['total'];
        $uang_bayar = $_POST['uang_bayar'];
        $uang_kembalian = $_POST['uang_kembalian'];
        $id_kasir = $_POST['id_kasir'];
        $id_metode_bayar = $_POST['id_metode_bayar'];
        $sql = "INSERT INTO penjualan (nomor_penjualan, tanggal_jual, subtotal, jumlah_diskon, total, uang_bayar, uang_kembalian, id_kasir, id_metode_bayar) 
        VALUES ('$nomor_penjualan', '$tanggal_penjualan', '$subtotal', '$jumlah_diskon', '$total', '$uang_bayar', '$uang_kembalian', '$id_kasir', '$id_metode_bayar')";
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
        $harga_beli = $_POST['harga_beli'];
        $harga_jual = $_POST['harga_jual'];
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