<?php
$page = 'History';
include('header.php'); ?>
<?php include('sidebar.php') ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <!-- Topbar -->
        <?php include('navbar.php') ?>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">
            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">History</li>
                </ol>
            </nav>

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">History Pesanan</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="mb-3 font-weight-bold text-primary">History Pesanan</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>id transaksi</th>
                                    <th>nama pemesan</th>
                                    <th>tanggal transaksi</th>
                                    <th>total harga</th>
                                    <th>status</th>
                                    <th>detail</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT transaksi.id_transaksi, transaksi.name, transaksi.lokasi, transaksi.tanggal_ambil, transaksi.lama_sewa, transaksi.total_harga, transaksi.status
                                FROM transaksi
                                WHERE (transaksi.status = 'cancel' OR transaksi.status = 'paid') AND transaksi.total_harga != 0";

                                $query = mysqli_query($konek, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['id_transaksi']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['tanggal_ambil']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['total_harga']; ?>
                                        </td>
                                        <td>
                                            <?= ($row['status'] == 'Pending') ? "<span class='badge badge-secondary'>Pending</span>" : (($row['status'] == 'paid') ? "<span class='badge badge-success'>Success</span>" : "<span class='badge badge-danger'>cancel</span>"); ?>
                                        </td>
                                        <td class="aksi">
                                            <a href="detail.php?ref=<?php echo urlencode($_SERVER['REQUEST_URI']); ?>&id=<?php echo $row['id_transaksi']; ?>"
                                                class="btn btn-info btn-circle">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                            <a href="cetak_report.php" class="btn btn-success mb-3">Cetak Laporan</a>

                        </table>
                        <script>
                            $(document).ready(function () {
                                $('#dataTable').DataTable({
                                    dom: 'Bfrtip',
                                    buttons: [{
                                        'copy', 'csv', 'excel', 'pdf', 'print',
                                    }
                                    ]
                                });
                            });

                        </script>

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