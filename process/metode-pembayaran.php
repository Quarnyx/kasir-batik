<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {
    case 'tambah-metode-pembayaran':
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $nomor_rekening = $_POST['nomor_rekening'];
        $nama_pemilik = $_POST['nama_pemilik'];
        $sql = "INSERT INTO metode_pembayaran (nama, jenis, nomor_rekening, nama_pemilik) VALUES ('$nama', '$jenis', '$nomor_rekening', '$nama_pemilik')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Metode Pembayaran Berhasil Ditambah']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
    case 'edit-metode-pembayaran':
        $nama = $_POST['nama'];
        $jenis = $_POST['jenis'];
        $nomor_rekening = $_POST['nomor_rekening'];
        $nama_pemilik = $_POST['nama_pemilik'];
        $id = $_POST['id'];
        $sql = "UPDATE metode_pembayaran SET nama = '$nama', jenis = '$jenis', nomor_rekening = '$nomor_rekening', nama_pemilik = '$nama_pemilik' WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Metode Pembayaran Berhasil Diupdate']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }

        break;
    case 'hapus-metode-pembayaran':
        $id = $_POST['id'];
        $sql = "DELETE FROM metode_pembayaran WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
            echo json_encode(['status' => 'success', 'message' => 'Metode Pembayaran Berhasil Dihapus']);
        } else {
            http_response_code(500);
            echo json_encode(['status' => 'error', 'message' => $link->error]);
        }
        break;
}