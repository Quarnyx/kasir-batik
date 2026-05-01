/*
 Navicat Premium Data Transfer

 Source Server         : local
 Source Server Type    : MySQL
 Source Server Version : 80030 (8.0.30)
 Source Host           : 127.0.0.1:3306
 Source Schema         : kasir_batik

 Target Server Type    : MySQL
 Target Server Version : 80030 (8.0.30)
 File Encoding         : 65001

 Date: 01/05/2026 10:24:33
*/

SET NAMES utf8mb4;
SET FOREIGN_KEY_CHECKS = 0;

-- ----------------------------
-- Table structure for detail_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `detail_pembelian`;
CREATE TABLE `detail_pembelian`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID detail item',
  `nomor_po` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Pesanan pembelian induk',
  `id_sku` int NOT NULL COMMENT 'Produk SKU yang dipesan',
  `jumlah_pesan` int NOT NULL COMMENT 'Jumlah yang dipesan ke pemasok',
  `jumlah_terima` int NOT NULL DEFAULT 0 COMMENT 'Jumlah yang sudah diterima (bisa bertahap)',
  `harga_beli` decimal(15, 2) NOT NULL COMMENT 'Harga beli per unit dari pemasok',
  `subtotal` decimal(15, 2) NOT NULL COMMENT 'Subtotal item ini',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_dp_sku`(`id_sku` ASC) USING BTREE,
  CONSTRAINT `detail_pembelian_ibfk_2` FOREIGN KEY (`id_sku`) REFERENCES `produk_sku` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 17 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Detail item dalam pesanan pembelian' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detail_pembelian
-- ----------------------------
INSERT INTO `detail_pembelian` VALUES (16, 'PBL001', 21, 100, 100, 50000.00, 5000000.00);

-- ----------------------------
-- Table structure for detail_penjualan
-- ----------------------------
DROP TABLE IF EXISTS `detail_penjualan`;
CREATE TABLE `detail_penjualan`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID detail item',
  `nomor_penjualan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Transaksi penjualan induk',
  `id_sku` int NOT NULL COMMENT 'Produk SKU yang dijual',
  `jumlah` int NOT NULL COMMENT 'Jumlah unit yang dijual',
  `harga_jual` decimal(15, 2) NOT NULL COMMENT 'Harga jual per unit saat transaksi',
  `harga_beli` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Harga pokok saat transaksi (untuk hitung margin)',
  `subtotal` decimal(15, 2) NOT NULL COMMENT 'Subtotal item ini (jumlah x harga - diskon)',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `fk_dj_sku`(`id_sku` ASC) USING BTREE,
  CONSTRAINT `detail_penjualan_ibfk_2` FOREIGN KEY (`id_sku`) REFERENCES `produk_sku` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 19 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Detail produk yang dijual dalam satu transaksi' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of detail_penjualan
-- ----------------------------
INSERT INTO `detail_penjualan` VALUES (14, 'PNJ001', 21, 2, 125000.00, 50000.00, 250000.00);
INSERT INTO `detail_penjualan` VALUES (15, 'PNJ002', 21, 2, 125000.00, 50000.00, 250000.00);

-- ----------------------------
-- Table structure for kategori
-- ----------------------------
DROP TABLE IF EXISTS `kategori`;
CREATE TABLE `kategori`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID kategori',
  `nama_kategori` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nama kategori (Batik Tulis, Kemeja Batik, dll)',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 6 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Kategori produk batik' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of kategori
-- ----------------------------
INSERT INTO `kategori` VALUES (1, 'Pakaian Jadi');
INSERT INTO `kategori` VALUES (2, 'Kain Batik Cap');
INSERT INTO `kategori` VALUES (3, 'Kain Batik Tulis');

-- ----------------------------
-- Table structure for metode_pembayaran
-- ----------------------------
DROP TABLE IF EXISTS `metode_pembayaran`;
CREATE TABLE `metode_pembayaran`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID metode pembayaran',
  `nama` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nama tampil (Tunai, Transfer BCA, QRIS)',
  `jenis` enum('tunai','transfer','qris','kartu','lainnya') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Jenis metode pembayaran',
  `nomor_rekening` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nomor rekening / ID merchant',
  `nama_pemilik` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nama pemilik rekening',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Metode pembayaran yang tersedia di kasir' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of metode_pembayaran
-- ----------------------------
INSERT INTO `metode_pembayaran` VALUES (2, 'BRI', 'kartu', '21313131231', 'Batik Widji');
INSERT INTO `metode_pembayaran` VALUES (3, 'Tunai', 'tunai', '0', 'Batik');

-- ----------------------------
-- Table structure for pemasok
-- ----------------------------
DROP TABLE IF EXISTS `pemasok`;
CREATE TABLE `pemasok`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID pemasok',
  `nama` varchar(150) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nama pemasok / toko',
  `telepon` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nomor telepon',
  `email` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Alamat email',
  `alamat` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT 'Alamat lengkap',
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Data pemasok / supplier batik' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pemasok
-- ----------------------------
INSERT INTO `pemasok` VALUES (2, 'PT ABC D', '22', 'aa@gmail.com', 'asdad');

-- ----------------------------
-- Table structure for pengguna
-- ----------------------------
DROP TABLE IF EXISTS `pengguna`;
CREATE TABLE `pengguna`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID pengguna',
  `nama` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nama lengkap pengguna',
  `username` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Username untuk login',
  `password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Password terenkripsi (bcrypt)',
  `level` enum('admin','kasir') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'kasir' COMMENT 'Hak akses: admin=semua, kasir=jual, gudang=stok, pemilik=laporan',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_nama_pengguna`(`username` ASC) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Data pengguna aplikasi & hak akses' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pengguna
-- ----------------------------
INSERT INTO `pengguna` VALUES (1, 'Admin', 'admin', '0192023a7bbd73250516f069df18b500', 'admin');
INSERT INTO `pengguna` VALUES (4, 'Kasir', 'kasir', '0192023a7bbd73250516f069df18b500', 'kasir');

-- ----------------------------
-- Table structure for penjualan
-- ----------------------------
DROP TABLE IF EXISTS `penjualan`;
CREATE TABLE `penjualan`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID penjualan',
  `nomor_penjualan` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nomor faktur otomatis (INV-20260411-0001)',
  `tanggal_jual` date NOT NULL COMMENT 'Tanggal & jam transaksi',
  `id_kasir` int NOT NULL COMMENT 'Kasir yang melayani',
  `subtotal` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Jumlah sebelum diskon & pajak',
  `jumlah_diskon` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Nominal potongan harga',
  `total` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Total yang harus dibayar pelanggan',
  `uang_bayar` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Uang yang diberikan pelanggan',
  `uang_kembalian` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Kembalian untuk pelanggan',
  `id_metode_bayar` int NULL DEFAULT NULL COMMENT 'Metode pembayaran yang digunakan',
  PRIMARY KEY (`id`) USING BTREE,
  INDEX `idx_penjualan_tanggal`(`tanggal_jual` ASC) USING BTREE,
  INDEX `fk_jual_kasir`(`id_kasir` ASC) USING BTREE,
  INDEX `fk_jual_bayar`(`id_metode_bayar` ASC) USING BTREE,
  CONSTRAINT `penjualan_ibfk_2` FOREIGN KEY (`id_kasir`) REFERENCES `pengguna` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  CONSTRAINT `penjualan_ibfk_3` FOREIGN KEY (`id_metode_bayar`) REFERENCES `metode_pembayaran` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 8 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Header transaksi penjualan di kasir POS' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of penjualan
-- ----------------------------
INSERT INTO `penjualan` VALUES (6, 'PNJ001', '2026-04-20', 1, 250000.00, 50000.00, 200000.00, 200000.00, 0.00, 3);
INSERT INTO `penjualan` VALUES (7, 'PNJ002', '2026-05-01', 1, 250000.00, 25000.00, 225000.00, 250000.00, 25000.00, 3);

-- ----------------------------
-- Table structure for pesanan_pembelian
-- ----------------------------
DROP TABLE IF EXISTS `pesanan_pembelian`;
CREATE TABLE `pesanan_pembelian`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID pesanan pembelian',
  `nomor_po` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Nomor PO otomatis (PO-20260411-0001)',
  `id_pemasok` int NULL DEFAULT NULL COMMENT 'Pemasok yang dituju',
  `id_pengguna` int NOT NULL COMMENT 'Staff yang membuat pesanan',
  `tanggal_pesan` date NOT NULL COMMENT 'Tanggal pemesanan',
  `tanggal_ekspektasi` date NULL DEFAULT NULL COMMENT 'Perkiraan tanggal barang tiba',
  `tanggal_terima` date NULL DEFAULT NULL COMMENT 'Tanggal barang benar-benar diterima',
  `status` enum('dipesan','diterima','dibatalkan') CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'dipesan' COMMENT 'Draf=belum kirim, Dipesan=sudah konfirmasi, Sebagian=terima sebagian, Diterima=lengkap',
  `subtotal` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Jumlah sebelum diskon & pajak',
  `diskon` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Potongan harga',
  `persen_pajak` decimal(5, 2) NOT NULL DEFAULT 0.00 COMMENT 'Persentase PPN (%)',
  `jumlah_pajak` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Nominal pajak',
  `ongkos_kirim` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Biaya pengiriman',
  `total` decimal(15, 2) NOT NULL DEFAULT 0.00 COMMENT 'Total yang harus dibayar ke pemasok',
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_nomor_po`(`nomor_po` ASC) USING BTREE,
  INDEX `fk_pp_pemasok`(`id_pemasok` ASC) USING BTREE,
  INDEX `fk_pp_pengguna`(`id_pengguna` ASC) USING BTREE,
  CONSTRAINT `pesanan_pembelian_ibfk_1` FOREIGN KEY (`id_pemasok`) REFERENCES `pemasok` (`id`) ON DELETE SET NULL ON UPDATE RESTRICT,
  CONSTRAINT `pesanan_pembelian_ibfk_2` FOREIGN KEY (`id_pengguna`) REFERENCES `pengguna` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 9 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Header transaksi pembelian / stok masuk dari pemasok' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of pesanan_pembelian
-- ----------------------------
INSERT INTO `pesanan_pembelian` VALUES (8, 'PBL001', 2, 1, '2026-04-20', '2026-04-20', '2026-04-20', 'diterima', 5000000.00, 0.00, 0.00, 0.00, 0.00, 5000000.00);

-- ----------------------------
-- Table structure for produk
-- ----------------------------
DROP TABLE IF EXISTS `produk`;
CREATE TABLE `produk`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID produk',
  `kode` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Kode produk unik (PRD-001)',
  `nama` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Nama produk',
  `id_kategori` int NULL DEFAULT NULL COMMENT 'Kategori produk',
  `deskripsi` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL COMMENT 'Deskripsi / keterangan produk',
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Path foto produk',
  `satuan` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_kode_produk`(`kode` ASC) USING BTREE,
  INDEX `fk_produk_kategori`(`id_kategori` ASC) USING BTREE,
  CONSTRAINT `produk_ibfk_1` FOREIGN KEY (`id_kategori`) REFERENCES `kategori` (`id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE = InnoDB AUTO_INCREMENT = 40 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'Produk master batik' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produk
-- ----------------------------
INSERT INTO `produk` VALUES (23, 'PRD-001', 'Vest Batik Printing 1', 1, 'Vest batik printing produksi Batik Widji Kendal', 'PRD-001.png', 'pcs');
INSERT INTO `produk` VALUES (24, 'PRD-002', 'Vest Batik Printing 2', 1, 'Vest batik printing produksi Batik Widji Kendal', 'PRD-002.png', 'pcs');
INSERT INTO `produk` VALUES (25, 'PRD-003', 'Blouse Batik Cap 1', 1, 'Blouse batik cap produksi Batik Widji Kendal', 'PRD-003.png', 'pcs');
INSERT INTO `produk` VALUES (26, 'PRD-004', 'Blouse Batik Cap 2', 1, 'Blouse batik cap produksi Batik Widji Kendal', 'PRD-004.png', 'pcs');
INSERT INTO `produk` VALUES (27, 'PRD-005', 'Blouse Batik Tulis 1', 1, 'Blouse batik tulis produksi Batik Widji Kendal', 'PRD-005.png', 'pcs');
INSERT INTO `produk` VALUES (28, 'PRD-006', 'Blouse Batik Tulis 2', 1, 'Blouse batik tulis produksi Batik Widji Kendal', 'PRD-006.png', 'pcs');
INSERT INTO `produk` VALUES (29, 'PRD-007', 'Daun Dumugi Abstrak', 2, 'Kain batik cap motif daun dumugi abstrak', 'PRD-007.png', 'lembar');
INSERT INTO `produk` VALUES (30, 'PRD-008', 'Daun Kendi Abstrak', 2, 'Kain batik cap motif daun kendi abstrak', 'PRD-008.png', 'lembar');
INSERT INTO `produk` VALUES (31, 'PRD-009', 'Aksara Kendal Berdikari', 2, 'Kain batik cap motif aksara Kendal berdikari', 'PRD-009.png', 'lembar');
INSERT INTO `produk` VALUES (32, 'PRD-010', 'Lurik Kendal Berdikari', 2, 'Kain batik cap motif lurik Kendal berdikari', 'PRD-010.png', 'lembar');
INSERT INTO `produk` VALUES (33, 'PRD-011', 'Aliring Bungah', 2, 'Kain batik cap motif aliring bungah', 'PRD-011.png', 'lembar');
INSERT INTO `produk` VALUES (34, 'PRD-012', 'Kendi Kapindo', 2, 'Kain batik cap motif kendi kapindo', 'PRD-012.png', 'lembar');
INSERT INTO `produk` VALUES (35, 'PRD-013', 'Batik Widji 1', 3, 'Kain batik tulis Batik Widji seri 1', 'PRD-013.png', 'lembar');
INSERT INTO `produk` VALUES (36, 'PRD-014', 'Batik Widji 2', 3, 'Kain batik tulis Batik Widji seri 2', 'PRD-014.png', 'lembar');
INSERT INTO `produk` VALUES (37, 'PRD-015', 'Batik Widji 3', 3, 'Kain batik tulis Batik Widji seri 3', 'PRD-015.png', 'lembar');
INSERT INTO `produk` VALUES (38, 'PRD-016', 'Batik Widji 4', 3, 'Kain batik tulis Batik Widji seri 4', 'PRD-016.png', 'lembar');

-- ----------------------------
-- Table structure for produk_sku
-- ----------------------------
DROP TABLE IF EXISTS `produk_sku`;
CREATE TABLE `produk_sku`  (
  `id` int NOT NULL AUTO_INCREMENT COMMENT 'ID SKU',
  `id_produk` int NULL DEFAULT NULL COMMENT 'Produk induk',
  `kode_sku` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Kode SKU unik (PRD-001-L-HTM)',
  `harga_beli` decimal(15, 2) NULL DEFAULT 0.00 COMMENT 'Harga beli / HPP dari pemasok',
  `harga_jual` decimal(15, 2) NULL DEFAULT 0.00 COMMENT 'Harga jual ke pelanggan',
  `foto` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL COMMENT 'Foto khusus varian ini',
  `nama_variasi` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE,
  UNIQUE INDEX `uq_kode_sku`(`kode_sku` ASC) USING BTREE,
  INDEX `fk_sku_produk`(`id_produk` ASC) USING BTREE,
  CONSTRAINT `produk_sku_ibfk_1` FOREIGN KEY (`id_produk`) REFERENCES `produk` (`id`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE = InnoDB AUTO_INCREMENT = 49 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_general_ci COMMENT = 'SKU: kombinasi variasi produk dengan stok & harga masing-masing' ROW_FORMAT = DYNAMIC;

-- ----------------------------
-- Records of produk_sku
-- ----------------------------
INSERT INTO `produk_sku` VALUES (20, 23, 'PRD-001-M', 50000.00, 120000.00, NULL, 'M');
INSERT INTO `produk_sku` VALUES (21, 23, 'PRD-001-L', 50000.00, 125000.00, NULL, 'L');
INSERT INTO `produk_sku` VALUES (22, 23, 'PRD-001-XL', 50000.00, 130000.00, NULL, 'XL');
INSERT INTO `produk_sku` VALUES (23, 24, 'PRD-002-M', 0.00, 122000.00, NULL, 'M');
INSERT INTO `produk_sku` VALUES (24, 24, 'PRD-002-L', 0.00, 127000.00, NULL, 'L');
INSERT INTO `produk_sku` VALUES (25, 24, 'PRD-002-XL', 0.00, 133000.00, NULL, 'XL');
INSERT INTO `produk_sku` VALUES (26, 25, 'PRD-003-M', 0.00, 130000.00, NULL, 'M');
INSERT INTO `produk_sku` VALUES (27, 25, 'PRD-003-L', 0.00, 135000.00, NULL, 'L');
INSERT INTO `produk_sku` VALUES (28, 25, 'PRD-003-XL', 0.00, 140000.00, NULL, 'XL');
INSERT INTO `produk_sku` VALUES (29, 26, 'PRD-004-M', 0.00, 130000.00, NULL, 'M');
INSERT INTO `produk_sku` VALUES (30, 26, 'PRD-004-L', 0.00, 135000.00, NULL, 'L');
INSERT INTO `produk_sku` VALUES (31, 26, 'PRD-004-XL', 0.00, 140000.00, NULL, 'XL');
INSERT INTO `produk_sku` VALUES (32, 27, 'PRD-005-M', 0.00, 135000.00, NULL, 'M');
INSERT INTO `produk_sku` VALUES (33, 27, 'PRD-005-L', 0.00, 140000.00, NULL, 'L');
INSERT INTO `produk_sku` VALUES (34, 27, 'PRD-005-XL', 0.00, 145000.00, NULL, 'XL');
INSERT INTO `produk_sku` VALUES (35, 28, 'PRD-006-M', 0.00, 135000.00, NULL, 'M');
INSERT INTO `produk_sku` VALUES (36, 28, 'PRD-006-L', 0.00, 140000.00, NULL, 'L');
INSERT INTO `produk_sku` VALUES (37, 28, 'PRD-006-XL', 0.00, 145000.00, NULL, 'XL');
INSERT INTO `produk_sku` VALUES (38, 29, 'PRD-007-200x150', 0.00, 110000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (39, 30, 'PRD-008-200x150', 0.00, 110000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (40, 31, 'PRD-009-200x150', 0.00, 110000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (41, 32, 'PRD-010-200x150', 0.00, 110000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (42, 33, 'PRD-011-200x150', 0.00, 110000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (43, 34, 'PRD-012-200x150', 0.00, 110000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (44, 35, 'PRD-013-200x150', 0.00, 150000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (45, 36, 'PRD-014-200x150', 0.00, 150000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (46, 37, 'PRD-015-200x150', 0.00, 150000.00, NULL, '200x150 cm');
INSERT INTO `produk_sku` VALUES (47, 38, 'PRD-016-200x150', 0.00, 150000.00, NULL, '200x150 cm');

-- ----------------------------
-- Table structure for promo
-- ----------------------------
DROP TABLE IF EXISTS `promo`;
CREATE TABLE `promo`  (
  `id` int NOT NULL AUTO_INCREMENT,
  `promo` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `persen_diskon` int NULL DEFAULT NULL,
  `tanggal_mulai` date NULL DEFAULT NULL,
  `tanggal_selesai` date NULL DEFAULT NULL,
  PRIMARY KEY (`id`) USING BTREE
) ENGINE = InnoDB AUTO_INCREMENT = 4 CHARACTER SET = utf8mb4 COLLATE = utf8mb4_0900_ai_ci ROW_FORMAT = Dynamic;

-- ----------------------------
-- Records of promo
-- ----------------------------
INSERT INTO `promo` VALUES (1, 'Hari Batik Nasional', 10, '2026-04-30', '2026-05-09');
INSERT INTO `promo` VALUES (3, 'Lebaran', 20, '2026-03-19', '2026-03-28');

-- ----------------------------
-- View structure for v_helper_stok_keluar
-- ----------------------------
DROP VIEW IF EXISTS `v_helper_stok_keluar`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_helper_stok_keluar` AS select `detail_penjualan`.`id_sku` AS `id_sku`,sum(`detail_penjualan`.`jumlah`) AS `total_keluar` from `detail_penjualan` group by `detail_penjualan`.`id_sku`;

-- ----------------------------
-- View structure for v_helper_stok_masuk
-- ----------------------------
DROP VIEW IF EXISTS `v_helper_stok_masuk`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_helper_stok_masuk` AS select `detail_pembelian`.`id_sku` AS `id_sku`,sum(`detail_pembelian`.`jumlah_terima`) AS `total_masuk` from `detail_pembelian` where (`detail_pembelian`.`jumlah_terima` > 0) group by `detail_pembelian`.`id_sku`;

-- ----------------------------
-- View structure for v_pembelian
-- ----------------------------
DROP VIEW IF EXISTS `v_pembelian`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_pembelian` AS select `produk_sku`.`kode_sku` AS `kode_sku`,`produk_sku`.`nama_variasi` AS `nama_variasi`,`produk`.`satuan` AS `satuan`,`detail_pembelian`.`id` AS `id`,`detail_pembelian`.`id_sku` AS `id_sku`,`detail_pembelian`.`jumlah_pesan` AS `jumlah_pesan`,`detail_pembelian`.`jumlah_terima` AS `jumlah_terima`,`detail_pembelian`.`harga_beli` AS `harga_beli`,`detail_pembelian`.`subtotal` AS `subtotal`,`produk`.`nama` AS `nama`,`detail_pembelian`.`nomor_po` AS `nomor_po`,`pesanan_pembelian`.`tanggal_pesan` AS `tanggal_pesan`,`pesanan_pembelian`.`tanggal_terima` AS `tanggal_terima` from (((`detail_pembelian` join `produk_sku` on((`detail_pembelian`.`id_sku` = `produk_sku`.`id`))) join `produk` on((`produk_sku`.`id_produk` = `produk`.`id`))) left join `pesanan_pembelian` on((`detail_pembelian`.`nomor_po` = `pesanan_pembelian`.`nomor_po`)));

-- ----------------------------
-- View structure for v_penjualan
-- ----------------------------
DROP VIEW IF EXISTS `v_penjualan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_penjualan` AS select `produk_sku`.`harga_jual` AS `harga_jual_sku`,`produk`.`nama` AS `nama`,`produk_sku`.`nama_variasi` AS `nama_variasi`,`detail_penjualan`.`id` AS `id`,`detail_penjualan`.`nomor_penjualan` AS `nomor_penjualan`,`detail_penjualan`.`id_sku` AS `id_sku`,`detail_penjualan`.`jumlah` AS `jumlah`,`detail_penjualan`.`harga_jual` AS `harga_jual`,`detail_penjualan`.`harga_beli` AS `harga_beli`,`detail_penjualan`.`subtotal` AS `subtotal`,`produk_sku`.`kode_sku` AS `kode_sku`,`produk`.`satuan` AS `satuan`,`penjualan`.`jumlah_diskon` AS `jumlah_diskon`,`penjualan`.`uang_bayar` AS `uang_bayar`,`penjualan`.`uang_kembalian` AS `uang_kembalian`,`penjualan`.`total` AS `total`,`penjualan`.`tanggal_jual` AS `tanggal_jual`,`penjualan`.`subtotal` AS `subtotal_induk` from (((`detail_penjualan` join `produk_sku` on((`detail_penjualan`.`id_sku` = `produk_sku`.`id`))) join `produk` on((`produk_sku`.`id_produk` = `produk`.`id`))) left join `penjualan` on((`detail_penjualan`.`nomor_penjualan` = `penjualan`.`nomor_penjualan`)));

-- ----------------------------
-- View structure for v_stok_persediaan
-- ----------------------------
DROP VIEW IF EXISTS `v_stok_persediaan`;
CREATE ALGORITHM = UNDEFINED SQL SECURITY DEFINER VIEW `v_stok_persediaan` AS select `ps`.`id` AS `id_sku`,`ps`.`kode_sku` AS `kode_sku`,`ps`.`nama_variasi` AS `nama_variasi`,`p`.`id` AS `id_produk`,`p`.`kode` AS `kode_produk`,`p`.`nama` AS `nama_produk`,`k`.`nama_kategori` AS `nama_kategori`,`p`.`satuan` AS `satuan`,`ps`.`harga_beli` AS `harga_beli`,`ps`.`harga_jual` AS `harga_jual`,coalesce(`m`.`total_masuk`,0) AS `total_masuk`,coalesce(`kl`.`total_keluar`,0) AS `total_keluar`,(coalesce(`m`.`total_masuk`,0) - coalesce(`kl`.`total_keluar`,0)) AS `stok_akhir`,((coalesce(`m`.`total_masuk`,0) - coalesce(`kl`.`total_keluar`,0)) * `ps`.`harga_beli`) AS `nilai_persediaan` from ((((`produk_sku` `ps` join `produk` `p` on((`ps`.`id_produk` = `p`.`id`))) left join `kategori` `k` on((`p`.`id_kategori` = `k`.`id`))) left join `v_helper_stok_masuk` `m` on((`ps`.`id` = `m`.`id_sku`))) left join `v_helper_stok_keluar` `kl` on((`ps`.`id` = `kl`.`id_sku`))) order by `p`.`nama`,`ps`.`nama_variasi`;

SET FOREIGN_KEY_CHECKS = 1;
