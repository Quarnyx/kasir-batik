<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah-promo':
        $promo = $link->real_escape_string($_POST['promo']);
        $persen_diskon = $link->real_escape_string($_POST['persen_diskon']);
        $tanggal_mulai = $link->real_escape_string($_POST['tanggal_mulai']);
        $tanggal_selesai = $link->real_escape_string($_POST['tanggal_selesai']);
        $sql = "INSERT INTO promo (promo, persen_diskon, tanggal_mulai, tanggal_selesai) VALUES ('$promo', '$persen_diskon', '$tanggal_mulai', '$tanggal_selesai')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Promo Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit-promo':
        $promo = $link->real_escape_string($_POST['promo']);
        $persen_diskon = $link->real_escape_string($_POST['persen_diskon']);
        $tanggal_mulai = $link->real_escape_string($_POST['tanggal_mulai']);
        $tanggal_selesai = $link->real_escape_string($_POST['tanggal_selesai']);
        $id = $link->real_escape_string($_POST['id']);
        $sql = "UPDATE promo SET promo = '$promo', persen_diskon = '$persen_diskon', tanggal_mulai = '$tanggal_mulai', tanggal_selesai = '$tanggal_selesai' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Promo Berhasil Diubah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'hapus-promo':
        $id = isset($_POST['id']) ? (int) $_POST['id'] : 0;
        $sql = "DELETE FROM promo WHERE id = $id";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Promo Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    default:
        http_response_code(404);
        echo json_encode(['status' => 'error', 'message' => 'Aksi tidak ditemukan']);
        break;
}
