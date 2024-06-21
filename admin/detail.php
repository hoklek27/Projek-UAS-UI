<?php include('header.php') ?>

<?php include('sidebar.php') ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include('navbar.php') ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Breadcrumb -->
            <?php
            $ref = isset($_GET['ref']) ? $_GET['ref'] : '';
            if (!empty($ref)) {
                $ref = urldecode($ref);
                $refText = ($ref == 'transaction.php') ? 'Transaction' : 'History';
                $refLink = ($ref == 'transaction.php') ? 'transaction.php' : 'history.php';
            } else {
                $refText = 'Transaksi';
                $refLink = 'transaction.php';
            }
            ?>

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Home</a></li>
                    <li class="breadcrumb-item"><a href="<?php echo $refLink; ?>"><?php echo $refText; ?></a></li>
                    <li class="breadcrumb-item active" aria-current="page">Details</li>
                </ol>
            </nav>
            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Detail Pesanan</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="20%">id produk</th>
                                    <th width="30%">nama produk</th>
                                    <th width="15%">harga</th>
                                    <th width="15%">jumlah</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $id_transaksi = $_GET['id'];
                                $sql = "SELECT detail_produk.*, produk.id_produk, produk.nama_produk FROM detail_produk INNER JOIN produk ON detail_produk.id_produk = produk.id_produk WHERE detail_produk.id_transaksi = $id_transaksi";
                                $query = mysqli_query($konek, $sql);
                                while ($row = mysqli_fetch_array($query)) {
                                    ?>
                                    <tr>
                                        <td>
                                            <?php echo $row['id_produk']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['nama_produk']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['harga_barang']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['jumlah']; ?>
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