<?php
require_once __DIR__ . '/../layouts/config.php';

switch ($_GET['aksi'] ?? '') {

    case 'post-pembelian':

        $id_pemasok = $_POST['id_pemasok'];
        $nomor_po = $_POST['nomor_po'];
        $tanggal_pesan = $_POST['tanggal_pesan'];
        $tanggal_ekspektasi = $_POST['tanggal_ekspektasi'];
        $status = 'dipesan';
        $subtotal = preg_replace('/[^0-9]/', '', $_POST['subtotal']);
        $ongkos_kirim = preg_replace('/[^0-9]/', '', $_POST['ongkir']);
        $diskon = preg_replace('/[^0-9]/', '', $_POST['diskon']);
        $persen_pajak = preg_replace('/[^0-9]/', '', $_POST['pajak']);
        $jumlah_pajak = $subtotal * ($persen_pajak / 100);
        $total = $subtotal - $diskon + $ongkos_kirim + $jumlah_pajak;
        $id_pengguna = $_POST['id_pengguna'];
        $sql = "INSERT INTO pesanan_pembelian (nomor_po, id_pemasok, tanggal_pesan, tanggal_ekspektasi, status, subtotal, ongkos_kirim, persen_pajak, jumlah_pajak, total, id_pengguna, diskon) 
        VALUES ('$nomor_po', '$id_pemasok', '$tanggal_pesan', '$tanggal_ekspektasi', '$status', '$subtotal', '$ongkos_kirim', '$persen_pajak', '$jumlah_pajak', '$total', '$id_pengguna', '$diskon')";
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
        $harga_beli = preg_replace('/[^0-9]/', '', $_POST['harga_beli']);
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
        $nomor_po = $_POST['id'];
        $sql = "DELETE FROM pesanan_pembelian WHERE nomor_po = '$nomor_po'";
        $result = $link->query($sql);
        if ($result) {
            echo "ok";
            http_response_code(200);
        } else {
            http_response_code(500);
            echo $link->error;
        }
        $sql = "DELETE FROM detail_pembelian WHERE nomor_po = '$nomor_po'";
        $result = $link->query($sql);
        if ($result) {
            echo "ok";
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
    case 'terima-barang':
        $nomor_po = $_POST['nomor_po'] ?? '';
        $tanggal_terima = $_POST['tanggal_terima'] ?? date('Y-m-d');
        $catatan = $_POST['catatan'] ?? '';
        $id_pengguna = $_POST['id_pengguna'] ?? ($_SESSION['id'] ?? 1);
        $jumlah_terima = $_POST['jumlah_terima'] ?? []; // array [id_detail => qty]

        if (!$nomor_po || empty($jumlah_terima)) {
            echo json_encode(['status' => 'error', 'message' => 'Data tidak lengkap']);
            echo $nomor_po . "<br>" . $tanggal_terima;

            print_r($jumlah_terima);
            exit;
        }

        $nomor_po_safe = mysqli_real_escape_string($link, $nomor_po);

        // Mulai transaksi DB
        mysqli_begin_transaction($link);

        try {
            $semua_lunas = true;

            foreach ($jumlah_terima as $id_detail => $qty) {
                $id_detail = (int) $id_detail;
                $qty = (int) $qty;

                if ($qty <= 0)
                    continue;

                // Ambil data detail pembelian
                $q_detail = mysqli_query(
                    $link,
                    "SELECT dp.*, ps.id AS sku_id 
                 FROM detail_pembelian dp
                 LEFT JOIN produk_sku ps ON dp.id_sku = ps.id
                 WHERE dp.id = $id_detail AND dp.nomor_po = '$nomor_po_safe'
                 LIMIT 1"
                );
                $detail = mysqli_fetch_assoc($q_detail);

                if (!$detail)
                    continue;

                $sisa = $detail['jumlah_pesan'] - $detail['jumlah_terima'];
                if ($qty > $sisa)
                    $qty = $sisa; // Tidak boleh melebihi sisa

                // Update jumlah_terima di detail_pembelian
                $new_jumlah_terima = $detail['jumlah_terima'] + $qty;
                mysqli_query(
                    $link,
                    "UPDATE detail_pembelian SET jumlah_terima = $new_jumlah_terima WHERE id = $id_detail"
                );

                // Cek apakah item ini sudah fully received
                if ($new_jumlah_terima < $detail['jumlah_pesan']) {
                    $semua_lunas = false;
                }
            }



            // Cek seluruh detail apakah sudah lunas semua
            $q_cek = mysqli_query(
                $link,
                "SELECT COUNT(*) AS belum 
             FROM detail_pembelian 
             WHERE nomor_po = '$nomor_po_safe' AND jumlah_terima < jumlah_pesan"
            );
            $cek = mysqli_fetch_assoc($q_cek);
            $status_baru = ($cek['belum'] == 0) ? 'diterima' : 'dipesan';

            // Update header pesanan_pembelian
            $tanggal_safe = mysqli_real_escape_string($link, $tanggal_terima);
            mysqli_query(
                $link,
                "UPDATE pesanan_pembelian 
             SET status = '$status_baru',
                 tanggal_terima = " . ($status_baru === 'diterima' ? "'$tanggal_safe'" : "tanggal_terima") . "
             WHERE nomor_po = '$nomor_po_safe'"
            );

            mysqli_commit($link);
            echo json_encode(['status' => 'success', 'message' => 'Penerimaan berhasil disimpan']);

        } catch (Exception $e) {
            mysqli_rollback($link);
            echo json_encode(['status' => 'error', 'message' => $e->getMessage()]);
        }

        break;
}