<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah-kategori':
        $nama_kategori = $link->real_escape_string($_POST['nama_kategori']);
        $sql = "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Kategori Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit-kategori':
        $nama_kategori = $link->real_escape_string($_POST['nama_kategori']);
        $id = $link->real_escape_string($_POST['id']);
        $sql = "UPDATE kategori SET nama_kategori = '$nama_kategori' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Kategori Berhasil Diubah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus-kategori':
        $id = $link->real_escape_string($_POST['id']);
        // Cek dulu apakah kategori ini sedang dipakai di produk
        $cek = $link->query("SELECT COUNT(*) as count FROM produk WHERE id_kategori = '$id'")->fetch_assoc();
        if ($cek['count'] > 0) {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => 'Kategori tidak dapat dihapus karena masih digunakan di Data Produk']);
        } else {
            $sql = "DELETE FROM kategori WHERE id = '$id'";
            $result = $link->query($sql);
            if ($result) {
                http_response_code(200);
                echo json_encode(['status' => 'success', 'message' => 'Kategori Berhasil Dihapus']);
            } else {
                http_response_code(500);
                echo json_encode(['status' => 'error', 'message' => $link->error]);
            }
        }
        break;
}
