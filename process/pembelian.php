<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {

    case 'post-pembelian':

        $id_pemasok = $_POST['id_pemasok'];
        $nomor_po = $_POST['nomor_po'];
        $tanggal_pesan = $_POST['tanggal_pesan'];
        $tanggal_ekspektasi = $_POST['tanggal_ekspektasi'];
        $status = 'dipesan';
        $subtotal = $_POST['subtotal'];
        $ongkos_kirim = $_POST['ongkir'];
        $persen_pajak = $_POST['pajak'];
        $jumlah_pajak = $subtotal * ($persen_pajak / 100);
        $total = $subtotal + $ongkos_kirim + $jumlah_pajak;
        $id_pengguna = $_POST['id_pengguna'];
        $sql = "INSERT INTO pesanan_pembelian (nomor_po, id_pemasok, tanggal_pesan, tanggal_ekspektasi, status, subtotal, ongkos_kirim, persen_pajak, jumlah_pajak, total, id_pengguna) 
        VALUES ('$nomor_po', '$id_pemasok', '$tanggal_pesan', '$tanggal_ekspektasi', '$status', '$subtotal', '$ongkos_kirim', '$persen_pajak', '$jumlah_pajak', '$total', '$id_pengguna')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }
        break;
    case 'tambah-pembelian-detail':

        $id_sku = $_POST['id_sku'];
        $nomor_po = $_POST['nomor_po'];
        $harga_beli = $_POST['harga_beli'];
        $jumlah_pesan = $_POST['jumlah_pesan'];
        $subtotal = $harga_beli * $jumlah_pesan;
        $sql = "INSERT INTO detail_pembelian (id_sku, jumlah_pesan, harga_beli, nomor_po, subtotal) 
        VALUES ('$id_sku', '$jumlah_pesan', '$harga_beli', '$nomor_po', '$subtotal')";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }
        break;
    case 'edit-pembelian':
        $id_akun_debit = $_POST['id_akun_debit'];
        $id_akun_kredit = $_POST['id_akun_kredit'];
        $id_barang = $_POST['id_barang'];
        $id_pemasok = $_POST['id_pemasok'];
        $kode_pembelian = $_POST['kode_pembelian'];
        $harga_beli = $_POST['harga_beli'];
        $qty = $_POST['qty'];
        $total = $harga_beli * $qty;
        $catatan = 'Pembelian' . $kode_pembelian;
        $id = $_POST['id'];
        $id_transaksi = $_POST['id_transaksi'];
        echo $id;
        $sql = "UPDATE pembelian SET id_pemasok = '$id_pemasok', id_barang = '$id_barang', qty = '$qty', harga_beli = '$harga_beli' WHERE id_pembelian = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }

        break;

    case 'hapus-pembelian':
        $kode_pembelian = $_POST['kode_pembelian'];
        $id_transaksi = $_POST['id_transaksi'];
        echo $id_transaksi;
        $sql = "DELETE FROM pembelian WHERE kode_pembelian = '$kode_pembelian'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }
        $sql = "DELETE FROM detail_pembelian WHERE kode_pembelian = '$kode_pembelian'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }

        break;
    case 'hapus-pembelian-detail':
        $id = $_POST['id'];
        $sql = "DELETE FROM detail_pembelian WHERE id = '$id'";
        $result = $link->query($sql);
        if ($result) {
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }

        break;
}