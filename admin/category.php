<?php
$page = 'Category';
include('header.php'); ?>

<!-- Sidebar -->
<?php include('sidebar.php') ?>

<!-- Content Wrapper -->
<div id="content-wrapper" class="d-flex flex-column">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
            <?php include('navbar.php') ?>
            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <section class="header" id="header"></section>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">
                    <!-- Breadcrumb -->
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Category</li>
                        </ol>
                    </nav>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">Category</h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="mb-3 font-weight-bold text-primary">List Category</h6>
                            <a href="add_category.php" class='btn btn-success'>+ Add Category</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="20%">id kategori</th>
                                            <th width="40%">nama kategori</th>
                                            <th width="20%">gambar</th>
                                            <th width="20%" class="aksi">aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM kategori";
                                        $query = mysqli_query($konek, $sql);
                                        while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['id_kategori']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['nama_kategori']; ?>
                                                </td>
                                                <td><img src="storage/<?php echo $row['gambar_kategori']; ?>"
                                                        alt="Gambar Kategori" style="width: 100px; height:50px;"></td>
                                                <td class="aksi">
                                                    <a href="edit_category.php?id=<?php echo $row['id_kategori']; ?>"
                                                        class="btn btn-info btn-circle">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a href="delete_category.php?id=<?php echo $row['id_kategori']; ?>"
                                                        class="btn btn-danger btn-circle">
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
        <!-- End of Content Wrapper --
<?php include('footer.php') ?>