<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu">

    <!-- LOGO -->
    <div class="navbar-brand-box">
        <a href="index.php" class="logo logo-dark">
            <span class="logo-sm">
                <img src="assets/images/logo-sm.svg" alt="" height="22">
            </span>
            <span class="logo-lg">
                <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">Batik Widji</span>
            </span>
        </a>

        <a href="index.php" class="logo logo-light">
            <span class="logo-lg">
                <img src="assets/images/logo-sm.svg" alt="" height="22"> <span class="logo-txt">Batik Widji</span>
            </span>
            <span class="logo-sm">
                <img src="assets/images/logo-sm.svg" alt="" height="22">
            </span>
        </a>
    </div>

    <button type="button" class="btn btn-sm px-3 font-size-16 header-item vertical-menu-btn">
        <i class="fa fa-fw fa-bars"></i>
    </button>

    <div data-simplebar class="sidebar-menu-scroll">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title" data-key="t-menu"><?php echo $language["Menu"]; ?></li>

                <li>
                    <a href="index.php">
                        <i class="bx bx-tachometer icon nav-icon"></i>
                        <span class="menu-item" data-key="t-dashboards"><?php echo $language["Dashboard"]; ?></span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-applications">Master Data</li>

                <li>
                    <a href="?page=produk">
                        <i class="bx bx-calendar icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar">Produk</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow">
                        <i class="bx bx-envelope icon nav-icon"></i>
                        <span class="menu-item" data-key="t-email">Variasi</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="email-inbox.php" data-key="t-inbox">Ukuran</a></li>
                        <li><a href="email-read.php" data-key="t-read-email">Warna</a></li>
                    </ul>
                </li>

                <li>
                    <a href="apps-calendar.php">
                        <i class="bx bx-calendar icon nav-icon"></i>
                        <span class="menu-item" data-key="t-calendar">Pengguna</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-pages">Transaksi</li>

                <li>
                    <a href="layouts-vertical.php">
                        <i class="bx bx-layout icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vertical">Penjualan</span>
                    </a>
                </li>

                <li>
                    <a href="layouts-vertical.php">
                        <i class="bx bx-layout icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vertical">Pembelian</span>
                    </a>
                </li>

                <li class="menu-title" data-key="t-components">Laporan</li>

                <li>
                    <a href="layouts-vertical.php">
                        <i class="bx bx-layout icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vertical">Penjualan</span>
                    </a>
                </li>

                <li>
                    <a href="layouts-vertical.php">
                        <i class="bx bx-layout icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vertical">Pembelian</span>
                    </a>
                </li>

                <li>
                    <a href="layouts-vertical.php">
                        <i class="bx bx-layout icon nav-icon"></i>
                        <span class="menu-item" data-key="t-vertical">Persediaan</span>
                    </a>
                </li>

            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->