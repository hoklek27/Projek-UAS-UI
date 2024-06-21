<?php
$page = 'Product';
include('header.php');
?>

<?php include('sidebar.php') ?>
<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">

    <!-- Main Content -->
    <div id="content">

        <?php include('navbar.php') ?>
        <!-- Begin Page Content -->
        <div class="container-fluid">

            <!-- Breadcrumb -->
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Transaksi</li>
                </ol>
            </nav>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="mb-3 font-weight-bold text-primary">List Product</h6>
                    <a href="add_product.php" class='btn btn-success'>+ Add Products</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th width="10%">id produk</th>
                                    <th width="20%">nama produk</th>
                                    <th width="30%">keterangan</th>
                                    <th width="5%">stok</th>
                                    <th width="15%">harga</th>
                                    <th width="10%">gambar</th>
                                    <th width="10%" class="aksi">aksi</th>
                                </tr>
                            </thead>
                            <tbody>

                                <?php
                                $sql = "SELECT * FROM produk";
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
                                            <span class="d-inline-block text-truncate" style="max-width: 300px;">
                                                <?php echo $row['keterangan']; ?>
                                            </span>
                                        </td>
                                        <td>
                                            <?php echo $row['stok']; ?>
                                        </td>
                                        <td>
                                            <?php echo $row['harga']; ?>
                                        </td>
                                        <td><img src="storage/<?php echo $row['gambar']; ?>" alt="Gambar Produk" style="width: 100px; height:50px;"></td>
                                        <td class="aksi">
                                            <a href="edit_product.php?id=<?php echo $row['id_produk']; ?>" class="btn btn-info btn-circle">
                                                <i class="bi bi-pencil-fill"></i>
                                            </a>
                                            <a href="delete_product.php?id=<?php echo $row['id_produk']; ?>" class="btn btn-danger btn-circle">
                                                <i class="fas fa-trash"></i>
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