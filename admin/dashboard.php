<?php
$page = 'Dashboard';
include('header.php');
include('sidebar.php');
?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include('navbar.php') ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Dashboard</h1>


            <!-- Content Row -->
            <div class="row">
                <?php
                // Get total count of id_transaksi
                $sqlTotalTransaksi = "SELECT COUNT(id_transaksi) AS total_trans FROM transaksi";
                $resultTotalTransaksi = mysqli_query($konek, $sqlTotalTransaksi);
                $rowTotalTransaksi = mysqli_fetch_assoc($resultTotalTransaksi);
                $totalTransaksi = $rowTotalTransaksi['total_trans'];

                // Get total count of status 'Pending'
                $sqlTotalPending = "SELECT COUNT(id_transaksi) AS total_pending FROM transaksi WHERE status = 'Pending'";
                $resultTotalPending = mysqli_query($konek, $sqlTotalPending);
                $rowTotalPending = mysqli_fetch_assoc($resultTotalPending);
                $totalPending = $rowTotalPending['total_pending'];

                // Get total count of status 'paid'
                $sqlTotalPaid = "SELECT COUNT(id_transaksi) AS total_paid FROM transaksi WHERE status = 'paid'";
                $resultTotalPaid = mysqli_query($konek, $sqlTotalPaid);
                $rowTotalPaid = mysqli_fetch_assoc($resultTotalPaid);
                $totalPaid = $rowTotalPaid['total_paid'];

                // Get total count of status 'cancel'
                $sqlTotalCancel = "SELECT COUNT(id_transaksi) AS total_cancel FROM transaksi WHERE status = 'cancel'";
                $resultTotalCancel = mysqli_query($konek, $sqlTotalCancel);
                $rowTotalCancel = mysqli_fetch_assoc($resultTotalCancel);
                $totalCancel = $rowTotalCancel['total_cancel'];
                ?>

                <!-- Total id_transaksi Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-primary shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                        Total Transaksi</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $totalTransaksi; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Pending Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-warning shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                        Total Pending</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $totalPending; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Paid Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-success shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                        Total Paid</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $totalPaid; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Total Cancel Card -->
                <div class="col-xl-3 col-md-6 mb-4">
                    <div class="card border-left-danger shadow h-100 py-2">
                        <div class="card-body">
                            <div class="row no-gutters align-items-center">
                                <div class="col mr-2">
                                    <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">
                                        Total Cancel</div>
                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                        <?php echo $totalCancel; ?>
                                    </div>
                                </div>
                                <div class="col-auto">
                                    <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>


            </div>


            <div class="row">

                <!-- Area Chart -->
                <div class="col-xl-12 col-lg-7">
                    <div class="card shadow mb-4">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                            <h6 class="m-0 font-weight-bold text-primary">Graphic Transaction</h6>

                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="chart-area">
                                <canvas id="myAreaChart"></canvas>
                            </div>
                        </div>
                    </div>
                </div>

                <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
                <script>
                    // Retrieve the monthly transaction counts from the database
                    <?php
                    $monthlyCounts = array();
                    $sql = "SELECT MONTH(tanggal_ambil) AS month, COUNT(id_transaksi) AS count, status
            FROM transaksi
            GROUP BY MONTH(tanggal_ambil), status";
                    $result = mysqli_query($konek, $sql);
                    while ($row = mysqli_fetch_assoc($result)) {
                        $month = $row['month'];
                        $status = $row['status'];
                        $count = $row['count'];
                        $monthlyCounts[$month][$status] = $count;
                    }

                    // Prepare the data for the chart
                    $labels = array();
                    $pendingData = array();
                    $paidData = array();
                    $cancelData = array();
                    $totalCount = array(); // New array for total count
                    for ($month = 1; $month <= 12; $month++) {
                        $labels[] = date("F", mktime(0, 0, 0, $month, 1));
                        $pendingData[] = isset($monthlyCounts[$month]['Pending']) ? $monthlyCounts[$month]['Pending'] : 0;
                        $paidData[] = isset($monthlyCounts[$month]['paid']) ? $monthlyCounts[$month]['paid'] : 0;
                        $cancelData[] = isset($monthlyCounts[$month]['cancel']) ? $monthlyCounts[$month]['cancel'] : 0;

                        // Calculate the total count for each month
                        $totalCount[] = array_sum(array($pendingData[$month - 1], $paidData[$month - 1], $cancelData[$month - 1]));
                    }
                    ?>

                    // Create the chart
                    var ctx = document.getElementById('myAreaChart').getContext('2d');
                    var myChart = new Chart(ctx, {
                        type: 'line',
                        data: {
                            labels: <?php echo json_encode($labels); ?>,
                            datasets: [{
                                label: 'Pending',
                                data: <?php echo json_encode($pendingData); ?>,
                                backgroundColor: 'rgba(255, 206, 86, 0.2)',
                                borderColor: 'rgba(255, 206, 86, 1)',
                                borderWidth: 2,
                                pointRadius: 3,
                                pointBackgroundColor: 'rgba(255, 206, 86, 1)',
                                pointBorderColor: 'rgba(255, 255, 255, 1)',
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: 'rgba(255, 206, 86, 1)',
                                pointHoverBorderColor: 'rgba(255, 255, 255, 1)',
                                lineTension: 0.3
                            }, {
                                label: 'Paid',
                                data: <?php echo json_encode($paidData); ?>,
                                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                                borderColor: 'rgba(75, 192, 192, 1)',
                                borderWidth: 2,
                                pointRadius: 3,
                                pointBackgroundColor: 'rgba(75, 192, 192, 1)',
                                pointBorderColor: 'rgba(255, 255, 255, 1)',
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: 'rgba(75, 192, 192, 1)',
                                pointHoverBorderColor: 'rgba(255, 255, 255, 1)',
                                lineTension: 0.3
                            }, {
                                label: 'Cancel',
                                data: <?php echo json_encode($cancelData); ?>,
                                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                                borderColor: 'rgba(255, 99, 132, 1)',
                                borderWidth: 2,
                                pointRadius: 3,
                                pointBackgroundColor: 'rgba(255, 99, 132, 1)',
                                pointBorderColor: 'rgba(255, 255, 255, 1)',
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: 'rgba(255, 99, 132, 1)',
                                pointHoverBorderColor: 'rgba(255, 255, 255, 1)',
                                lineTension: 0.3
                            }, {
                                label: 'Total',
                                data: <?php echo json_encode($totalCount); ?>,
                                backgroundColor: 'rgba(54, 162, 235, 0.2)',
                                borderColor: 'rgba(54, 162, 235, 1)',
                                borderWidth: 2,
                                pointRadius: 3,
                                pointBackgroundColor: 'rgba(54, 162, 235, 1)',
                                pointBorderColor: 'rgba(255, 255, 255, 1)',
                                pointHoverRadius: 3,
                                pointHoverBackgroundColor: 'rgba(54, 162, 235, 1)',
                                pointHoverBorderColor: 'rgba(255, 255, 255, 1)',
                                lineTension: 0.3
                            }]
                        },
                        options: {
                            responsive: true,
                            maintainAspectRatio: false,
                            scales: {
                                x: {
                                    grid: {
                                        display: true
                                    }
                                },
                                y: {
                                    grid: {
                                        display: true,
                                        drawBorder: false
                                    },
                                    ticks: {
                                        beginAtZero: true,
                                        stepSize: 1
                                    }
                                }
                            },
                            legend: {
                                display: true
                            },
                            tooltips: {
                                callbacks: {
                                    label: function (context) {
                                        return context.dataset.label + ': ' + context.formattedValue;
                                    }
                                }
                            }
                        }
                    });
                </script>





            </div>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">

                <div class="card-body">
                    <div class="row">
                        <?php

                        // Get total count of status 'paid'
                        $sqlTotalProduk = "SELECT COUNT(id_produk) AS total_Produk FROM produk";
                        $resultTotalProduk = mysqli_query($konek, $sqlTotalProduk);
                        $rowTotalProduk = mysqli_fetch_assoc($resultTotalProduk);
                        $totalProduk = $rowTotalProduk['total_Produk'];

                        // Get total count of status 'cancel'
                        $sqlTotalkategori = "SELECT COUNT(id_kategori) AS total_kategori FROM kategori";
                        $resultTotalkategori = mysqli_query($konek, $sqlTotalkategori);
                        $rowTotalkategori = mysqli_fetch_assoc($resultTotalkategori);
                        $totalkategori = $rowTotalkategori['total_kategori'];

                        // Get total count of id_user 
                        $sqlTotalUser = "SELECT COUNT(id_user) AS total_user FROM user";
                        $resultTotalUser = mysqli_query($konek, $sqlTotalUser);
                        $rowTotalUser = mysqli_fetch_assoc($resultTotalUser);
                        $totalUser = $rowTotalUser['total_user'];
                        ?>

                        <!-- Total id_transaksi Card -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Produk</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalProduk; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Total Pending Card -->
                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total Kategori</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalkategori; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-4 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total User</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                <?php echo $totalUser; ?>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?php include('footer.php') ?>