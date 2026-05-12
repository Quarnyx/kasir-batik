<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah-pengembalian':
        $jumlah_pengembalian = $link->real_escape_string($_POST['jumlah_pengembalian']);
        $nominal_pengembalian = preg_replace('/[^0-9]/', '', $_POST['nominal_pengembalian']);
        $tanggal_pengembalian = $link->real_escape_string($_POST['tanggal_pengembalian']);
        $nomor_penjualan = $link->real_escape_string($_POST['nomor_penjualan']);
        $alasan_pengembalian = $link->real_escape_string($_POST['alasan_pengembalian']);
        $id_sku = $link->real_escape_string($_POST['id_sku']);
        $sql = "INSERT INTO pengembalian_penjualan (id_sku, jumlah_pengembalian, nominal_pengembalian, tanggal_pengembalian, nomor_penjualan, alasan_pengembalian) VALUES ('$id_sku', '$jumlah_pengembalian', '$nominal_pengembalian', '$tanggal_pengembalian', '$nomor_penjualan', '$alasan_pengembalian')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Pengembalian Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit-pengembalian':
        $jumlah_pengembalian = $link->real_escape_string($_POST['jumlah_pengembalian']);
        $nominal_pengembalian = preg_replace('/[^0-9]/', '', $_POST['nominal_pengembalian']);
        $tanggal_pengembalian = $link->real_escape_string($_POST['tanggal_pengembalian']);
        $alasan_pengembalian = $link->real_escape_string($_POST['alasan_pengembalian']);
        $id = $link->real_escape_string($_POST['id']);
        $sql = "UPDATE pengembalian_penjualan SET jumlah_pengembalian = '$jumlah_pengembalian', nominal_pengembalian = '$nominal_pengembalian', tanggal_pengembalian = '$tanggal_pengembalian', alasan_pengembalian = '$alasan_pengembalian' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Pengembalian Berhasil Diubah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus-pengembalian':
        $id = $link->real_escape_string($_POST['id']);
        // Cek dulu apakah kategori ini sedang dipakai di produk
        $cek = $link->query("SELECT COUNT(*) as count FROM pengembalian_penjualan WHERE id = '$id'")->fetch_assoc();

        $sql = "DELETE FROM pengembalian_penjualan WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Pengembalian Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }

        break;
}
