<?php
$page = 'Transaction';
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
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                </ol>
            </nav>
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Transaksi</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="mb-3 font-weight-bold text-primary">List Transaksi</h6>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>id transaksi</th>
                                    <th>id user</th>
                                    <th>nama reservasi</th>
                                    <th>lokasi</th>
                                    <th>tanggal ambil</th>
                                    <th>lama sewa/hari</th>
                                    <th>total harga</th>
                                    <th>status</th>
                                    <th class="aksi">aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $sql = "SELECT transaksi.id_transaksi,transaksi.id_user, transaksi.name, transaksi.lokasi, transaksi.tanggal_ambil, transaksi.lama_sewa, transaksi.total_harga, transaksi.status
                                FROM transaksi
                                WHERE transaksi.status = 'Pending' AND transaksi.total_harga != 0";

                                $query = mysqli_query($konek, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['id_transaksi']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['id_user']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['name']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['lokasi']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['tanggal_ambil']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['lama_sewa']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['total_harga']; ?>
                                        </td>
                                        <td>
                                            <?= ($row['status'] == 'Pending') ? "<span class='badge badge-secondary'>Pending</span>" : (($row['status'] == 'paid') ? "<span class='badge badge-success'>Success</span>" : "<span class='badge badge-danger'>cancel</span>"); ?>
                                        </td>
                                        <td class="aksi">
                                            <a href="detail.php?ref=transaction.php&id=<?php echo $row['id_transaksi']; ?>"
                                                class="btn btn-info btn-circle">
                                                <i class="bi bi-info-lg"></i>
                                            </a>
                                            <a href="paid.php?id=<?php echo $row['id_transaksi']; ?>"
                                                class="btn btn-success btn-circle">
                                                <i class="bi bi-check-lg"></i>
                                            </a>
                                            <a href="cancel.php?id=<?php echo $row['id_transaksi']; ?>"
                                                class="btn btn-danger btn-circle">
                                                <i class="bi bi-x"></i>
                                            </a>
                                        </td>
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
        <!-- /.container-fluid -->

    </div>
    <!-- End of Main Content -->

</div>
<!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->
<?php include('footer.php') ?>