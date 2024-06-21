<?php
$page = 'User';
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
                            <li class="breadcrumb-item active" aria-current="page">User</li>
                        </ol>
                    </nav>

                    <!-- Page Heading -->
                    <h1 class="h3 mb-2 text-gray-800">User</h1>


                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="mb-3 font-weight-bold text-primary">List User</h6>
                            <a href="add_user.php" class='btn btn-success'>+ Add User</a>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th width="10%">id user</th>
                                            <th width="20%">nama user</th>
                                            <th width="25%">alamat</th>
                                            <th width="15%">no hp</th>
                                            <th width="20%">email</th>
                                            <th width="20%" class="aksi">aksi</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $sql = "SELECT * FROM user";
                                        $query = mysqli_query($konek, $sql);
                                        while ($row = mysqli_fetch_array($query)) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $row['id_user']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['name']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['alamat']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['no_hp']; ?>
                                                </td>
                                                <td>
                                                    <?php echo $row['email']; ?>
                                                </td>
                                                <td class="aksi">
                                                    <a href="edit_user.php?id=<?php echo $row['id_user']; ?>"
                                                        class="btn btn-info btn-circle">
                                                        <i class="bi bi-pencil-fill"></i>
                                                    </a>
                                                    <a href="delete_user.php?id=<?php echo $row['id_user']; ?>"
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