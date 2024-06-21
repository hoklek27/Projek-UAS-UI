<?php include('header.php') ?>

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

            <!-- Page Heading -->
            <h1 class="h3 mb-2 text-gray-800">Add New User</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="name">Nama User:</label>
                                <input type="text" class="form-control" id="name" placeholder="Masukkan Nama User"
                                    name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="alamat">Alamat:</label>
                                <input type="text" class="form-control" id="alamat" placeholder="Masukkan Alamat"
                                    name="alamat" required>
                            </div>
                            <div class="form-group">
                                <label for="no_hp">No HP:</label>
                                <input type="number" class="form-control" id="no_hp" placeholder="Masukkan no hp"
                                    name="no_hp" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email:</label>
                                <input type="email" class="form-control" id="email" placeholder="Masukkan Email"
                                    name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password:</label>
                                <input type="password" class="form-control" id="password"
                                    placeholder="Masukkan Password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="user_type">User Type:</label>
                                <select class="form-control" id="user_type" name="user_type" required>
                                    <option value="user">User
                                    </option>
                                    <option value="admin">
                                        Admin</option>
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save">Submit</button>
                            <a href='user.php' class='btn btn-danger'>Cancel</a>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            $name = $_POST['name'];
                            $alamat = $_POST['alamat'];
                            $no_hp = $_POST['no_hp'];
                            $email = $_POST['email'];
                            $password = $_POST['password'];
                            $user_type = $_POST['user_type'];
                            $hashed_password = password_hash($password, PASSWORD_BCRYPT);
                            $sql = "INSERT INTO user (name, alamat, no_hp, email, password, user_type) VALUES ('$name', '$alamat', '$no_hp', '$email', '$hashed_password', '$user_type')";
                            $exe = mysqli_query($konek, $sql);

                            if ($exe) {
                                echo "<script language='JavaScript'>
                                            (window.alert('Data tersimpan'))
                                            location.href='user.php'
                                            </script>";
                            } else {
                                echo "<script language='JavaScript'>
                                            (window.alert('Data tidak tersimpan'))
                                            location.href='add_user.php'
                                            </script>";
                            }
                        }
                        ?>
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