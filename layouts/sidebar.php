<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-batik.png" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-batik.png" alt="" height="22"> <span class="logo-txt">Batik Widji</span>
            </span>
        </a>

        <a href="index.php" class="logo logo-light">
            <span class="logo-lg">
                <img src="assets/images/logo-batik.png" alt="" height="22"> <span class="logo-txt">Batik Widji</span>
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo-batik.png" alt="" height="22">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <?php if ($_SESSION['level'] == 'admin') { ?>
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu"><?php echo $language["Menu"]; ?></li>

                    <li>
                        <a href="?page=dashboard">
                            <i class="bx bx-tachometer icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards"><?php echo $language["Dashboard"]; ?></span>
                        </a>
                    </li>

                    <li class="menu-title" data-key="t-applications">Master Data</li>

                    <li>
                        <a href="?page=produk">
                            <i class="bx bx-box icon nav-icon"></i>
                            <span class="menu-item" data-key="t-calendar">Produk</span>
                        </a>
                    </li>

                    <li>
                        <a href="?page=pemasok">
                            <i class="bx bx-box icon nav-icon"></i>
                            <span class="menu-item" data-key="t-calendar">Pemasok</span>
                        </a>
                    </li>

                    <li>
                        <a href="?page=pengguna">
                            <i class="bx bx-user icon nav-icon"></i>
                            <span class="menu-item" data-key="t-calendar">Pengguna</span>
                        </a>
                    </li>

                    <li>
                        <a href="?page=metode-pembayaran">
                            <i class="bx bx-dollar icon nav-icon"></i>
                            <span class="menu-item" data-key="t-calendar">Metode Pembayaran</span>
                        </a>
                    </li>

                    <li class="menu-title" data-key="t-pages">Transaksi</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bx bx-cart icon nav-icon"></i>
                            <span class="menu-item" data-key="t-email">Penjualan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="?page=penjualan" data-key="t-inbox">Penjualan</a></li>
                            <li><a href="?page=riwayat-penjualan" data-key="t-read-email">Riwayat Penjualan</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bx bx-cart icon nav-icon"></i>
                            <span class="menu-item" data-key="t-email">Pembelian</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="?page=pembelian" data-key="t-inbox">Pembelian</a></li>
                            <li><a href="?page=penerimaan-barang" data-key="t-read-email">Penerimaan Barang</a></li>
                            <li><a href="?page=riwayat-pembelian" data-key="t-read-email">Riwayat Pembelian</a></li>
                        </ul>
                    </li>

                    <li class="menu-title" data-key="t-components">Laporan</li>

                    <li>
                        <a href="?page=laporan-penjualan">
                            <i class="bx bx-layout icon nav-icon"></i>
                            <span class="menu-item" data-key="t-vertical">Penjualan</span>
                        </a>
                    </li>

                    <li>
                        <a href="?page=laporan-pembelian">
                            <i class="bx bx-layout icon nav-icon"></i>
                            <span class="menu-item" data-key="t-vertical">Pembelian</span>
                        </a>
                    </li>

                    <li>
                        <a href="?page=laporan-persediaan">
                            <i class="bx bx-layout icon nav-icon"></i>
                            <span class="menu-item" data-key="t-vertical">Persediaan</span>
                        </a>
                    </li>

                </ul>
            <?php } ?>
            <?php if ($_SESSION['level'] == 'kasir') { ?>
                <!-- Left Menu Start -->
                <ul class="metismenu list-unstyled" id="side-menu">
                    <li class="menu-title" data-key="t-menu"><?php echo $language["Menu"]; ?></li>

                    <li>
                        <a href="?page=dashboard">
                            <i class="bx bx-tachometer icon nav-icon"></i>
                            <span class="menu-item" data-key="t-dashboards"><?php echo $language["Dashboard"]; ?></span>
                        </a>
                    </li>

                    <li class="menu-title" data-key="t-pages">Transaksi</li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bx bx-cart icon nav-icon"></i>
                            <span class="menu-item" data-key="t-email">Penjualan</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="?page=penjualan" data-key="t-inbox">Penjualan</a></li>
                            <li><a href="?page=riwayat-penjualan" data-key="t-read-email">Riwayat Penjualan</a></li>
                        </ul>
                    </li>

                    <li>
                        <a href="javascript: void(0);" class="has-arrow">
                            <i class="bx bx-cart icon nav-icon"></i>
                            <span class="menu-item" data-key="t-email">Pembelian</span>
                        </a>
                        <ul class="sub-menu" aria-expanded="false">
                            <li><a href="?page=pembelian" data-key="t-inbox">Pembelian</a></li>
                            <li><a href="?page=penerimaan-barang" data-key="t-read-email">Penerimaan Barang</a></li>
                            <li><a href="?page=riwayat-pembelian" data-key="t-read-email">Riwayat Pembelian</a></li>
                        </ul>
                    </li>

                </ul>
            <?php } ?>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->