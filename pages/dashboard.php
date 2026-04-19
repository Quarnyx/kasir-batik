<!-- start page title -->
<?php
$maintitle = "Batik Widji";
$title = 'Selamat Datang !';
require_once __DIR__ . '/../layouts/config.php';
?>
<?php include 'layouts/breadcrumb.php'; ?>
<!-- end page title -->

<div class="row">
    <div class="col-xl-4">
        <div class="card bg-primary">
            <div class="card-body">
                <div class="text-center py-3">
                    <ul class="bg-bubbles ps-0">
                        <li><i class="bx bx-grid-alt font-size-24"></i></li>
                        <li><i class="bx bx-tachometer font-size-24"></i></li>
                        <li><i class="bx bx-store font-size-24"></i></li>
                        <li><i class="bx bx-cube font-size-24"></i></li>
                        <li><i class="bx bx-cylinder font-size-24"></i></li>
                        <li><i class="bx bx-command font-size-24"></i></li>
                        <li><i class="bx bx-hourglass font-size-24"></i></li>
                        <li><i class="bx bx-pie-chart-alt font-size-24"></i></li>
                        <li><i class="bx bx-coffee font-size-24"></i></li>
                        <li><i class="bx bx-polygon font-size-24"></i></li>
                    </ul>
                    <div class="main-wid position-relative">
                        <h3 class="text-white">Batik Widji Kendal</h3>

                        <h3 class="text-white mb-0"> <?php echo $_SESSION['nama']; ?>!</h3>

                        <p class="text-white-50 px-4 mt-4">Selamat Datang di Kasir Batik Widji Kendal
                        </p>

                        <div class="mt-4 pt-2 mb-2">
                            <a href="" class="btn btn-success"><?php echo $_SESSION['level']; ?></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-xl-8">
        <div class="row">
            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="avatar">
                            <span class="avatar-title bg-primary-subtle rounded">
                                <i class="mdi mdi-shopping-outline text-primary font-size-24"></i>
                            </span>
                        </div>
                        <p class="text-muted mt-4 mb-0">Penjualan Hari Ini</p>
                        <?php
                        $today = date('Y-m-d');
                        $query = mysqli_query($link, "SELECT SUM(total) as total FROM v_penjualan WHERE tanggal_jual = '$today'");
                        $row = mysqli_fetch_assoc($query);
                        $total = $row['total'] ?? 0;
                        ?>
                        <h4 class="mt-1 mb-0">Rp <?= number_format($total, 0, ',', '.') ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="avatar">
                            <span class="avatar-title bg-success-subtle rounded">
                                <i class="mdi mdi-eye-outline text-success font-size-24"></i>
                            </span>
                        </div>
                        <p class="text-muted mt-4 mb-0">Total Produk</p>
                        <?php
                        $query = mysqli_query($link, "SELECT COUNT(*) as total FROM produk_sku");
                        $row = mysqli_fetch_assoc($query);
                        $total = $row['total'] ?? 0;
                        ?>
                        <h4 class="mt-1 mb-0"><?= $total ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="avatar">
                            <span class="avatar-title bg-primary-subtle rounded">
                                <i class="mdi mdi-rocket-outline text-primary font-size-24"></i>
                            </span>
                        </div>
                        <p class="text-muted mt-4 mb-0">Pembelian Hari Ini</p>
                        <?php
                        $today = date('Y-m-d');
                        $query = mysqli_query($link, "SELECT SUM(subtotal) as total FROM v_pembelian WHERE tanggal_pesan = '$today'");
                        $row = mysqli_fetch_assoc($query);
                        $total = $row['total'] ?? 0;
                        ?>
                        <h4 class="mt-1 mb-0">Rp <?= number_format($total, 0, ',', '.') ?></h4>
                    </div>
                </div>
            </div>

            <div class="col-lg-3 col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="avatar">
                            <span class="avatar-title bg-success-subtle rounded">
                                <i class="mdi mdi-account-multiple-outline text-success font-size-24"></i>
                            </span>
                        </div>
                        <p class="text-muted mt-4 mb-0">Jumlah Pengguna</p>
                        <?php
                        $query = mysqli_query($link, "SELECT COUNT(*) as total FROM pengguna");
                        $row = mysqli_fetch_assoc($query);
                        $total = $row['total'] ?? 0;
                        ?>
                        <h4 class="mt-1 mb-0"><?= $total ?></h4>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>

<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center mb-3">
                    <h5 class="card-title mb-0">Statistik Penjualan</h5>
                </div>

                <div class="row align-items-center">
                    <div class="col-xl-12">
                        <div>
                            <div id="sales-statistics"
                                data-colors='["#eff1f3","#eff1f3","#eff1f3","#eff1f3","#33a186","#3980c0","#eff1f3","#eff1f3","#eff1f3", "#eff1f3"]'
                                class="apex-chart"></div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <div class="col-xl-12">
        <div class="card">
            <div class="card-body">
                <div class="d-flex flex-wrap align-items-center">
                    <h5 class="card-title mb-0">Stok Persediaan</h5>
                </div>
                <div class="table-responsive mt-3">
                    <table id="tabel-data" class="table table-bordered dt-responsive nowrap">
                        <thead>
                            <tr>
                                <th class="text-center" style="vertical-align: middle; width: 50px;">No</th>
                                <th class="text-center" style="vertical-align: middle; width: 100px;">Kode</th>
                                <th class="text-center" style="vertical-align: middle;">Nama Produk</th>
                                <th class="text-center" style="vertical-align: middle; width: 100px;">Satuan</th>
                                <th class="text-center" style="vertical-align: middle; width: 100px;">Stok Akhir</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 0;
                            $query = mysqli_query($link, "SELECT * FROM v_stok_persediaan");
                            while ($data = mysqli_fetch_array($query)) {
                                ?>
                                <tr <?php if ($data['stok_akhir'] <= 5)
                                    echo 'class="table-danger"'; ?>>
                                    <td><?= ++$no ?></td>
                                    <td><?= $data['kode_produk'] ?></td>
                                    <td><?= $data['nama_produk'] ?> - <?= $data['nama_variasi'] ?></td>
                                    <td><?= $data['satuan'] ?></td>
                                    <td><?= $data['stok_akhir'] ?></td>
                                </tr>
                                <?php
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- apexcharts -->
<script src="assets/libs/apexcharts/apexcharts.min.js"></script>
<?php
$sqljual = "SELECT
                YEAR(tanggal_jual) AS year,
                MONTH(tanggal_jual) AS month,
                COUNT(*) AS sales_count
            FROM
	            v_penjualan
                WHERE YEAR(tanggal_jual) = YEAR(CURDATE())
            GROUP BY year, month";
$sales_result = $link->query($sqljual);
$sales_data = [];

if ($sales_result->num_rows > 0) {
    while ($row = $sales_result->fetch_assoc()) {
        $sales_data[] = $row;
    }
}
// Preparing data for ApexCharts
$months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
$sales_counts = array_fill(0, 12, 0);  // Initialize an array with 12 zeros
foreach ($sales_data as $data) {
    $sales_counts[$data['month'] - 1] = $data['sales_count'];
}
?>
<script>
    $(document).ready(function () {
        $('#tabel-data').DataTable({
            "ordering": false,
            "info": false
        });
    });

    function getChartColorsArray(sales_statistics) {
        if (document.getElementById(sales_statistics) !== null) {
            var colors = document.getElementById(sales_statistics).getAttribute("data-colors");
            colors = JSON.parse(colors);
            return colors.map(function (value) {
                var newValue = value.replace(" ", "");
                if (newValue.indexOf("--") != -1) {
                    var color = getComputedStyle(document.documentElement).getPropertyValue(
                        newValue
                    );
                    if (color) return color;
                } else {
                    return newValue;
                }
            });
        }
    }
    //  Sales Statistics
    const salesCounts = <?php echo json_encode($sales_counts); ?>;
    const months = <?php echo json_encode($months); ?>;

    var barchartColors = getChartColorsArray("sales-statistics");
    var options = {
        series: [{
            name: 'Penjualan',
            data: salesCounts
        }],
        chart: {
            toolbar: {
                show: false,
            },
            height: 350,
            type: 'bar',
            events: {
                click: function (chart, w, e) {
                }
            }
        },
        plotOptions: {
            bar: {
                columnWidth: '70%',
                distributed: true,
            }
        },
        dataLabels: {
            enabled: false
        },
        legend: {
            show: false
        },
        colors: barchartColors,
        xaxis: {
            categories: months,
            labels: {
                style: {
                    colors: barchartColors,
                    fontSize: '12px'
                }
            }
        }
    };

    var chart = new ApexCharts(document.querySelector("#sales-statistics"), options);
    chart.render();
</script>