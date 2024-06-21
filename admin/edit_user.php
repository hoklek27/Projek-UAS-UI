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
            <h1 class="h3 mb-2 text-gray-800">Edit Category</h1>

            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <?php
                        $id = $_GET['id'];
                        $sql = "SELECT * FROM user WHERE id_user = $id";
                        $result = mysqli_query($konek, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="name">Nama :</label>
                                    <input type="text" class="form-control" id="name"
                                        value="<?php echo $row['name'] ?>" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="alamat">Alamat :</label>
                                    <input type="text" class="form-control" id="alamat"
                                        value="<?php echo $row['alamat'] ?>" name="alamat" required>
                                </div>
                                <div class="form-group">
                                    <label for="no_hp">No HP :</label>
                                    <input type="text" class="form-control" id="no_hp"
                                        value="<?php echo $row['no_hp'] ?>" name="no_hp" required>
                                </div>
                                <div class="form-group">
                                    <label for="email">Email :</label>
                                    <input type="text" class="form-control" id="email"
                                        value="<?php echo $row['email'] ?>" name="email" required>
                                </div>
                                <div class="form-group">
                                    <label for="password">Password :</label>
                                    <input type="password" class="form-control" id="password" name="password" placeholder="Leave blank if you don't want to change the password">
                                </div>
                                <div class="form-group">
                                    <label for="user_type">User Type:</label>
                                    <select class="form-control" id="user_type" name="user_type" required>
                                        <option value="user" <?php if ($row['user_type'] == 'user') echo 'selected'; ?>>User</option>
                                        <option value="admin" <?php if ($row['user_type'] == 'admin') echo 'selected'; ?>>Admin</option>
                                    </select>
                                </div>

                                <button type="submit" class="btn btn-primary" name="save">Submit</button>
                                <a href='user.php' class='btn btn-danger'>Cancel</a>
                            </form>
                            <?php
                        }
                        ?>

                        <?php
                        if (isset($_GET['id'])) {
                            $user = $_GET['id'];
                            $sql = "SELECT * FROM user WHERE id_user = $id";
                            $query = mysqli_query($konek, $sql);
                            $row = mysqli_fetch_array($query);
                        }

                        if (isset($_POST['save'])) {
                            $name = $_POST['name'];
                            $alamat = $_POST['alamat'];
                            $no_hp = $_POST['no_hp'];
                            $email = $_POST['email'];
                            $password = $_POST['password']; // Password diambil dari input form
                            $user_type = $_POST['user_type'];

                            // Periksa apakah password diinputkan
                            if (!empty($password)) {
                                // Enkripsi password menggunakan bcrypt
                                $password_hash = password_hash($password, PASSWORD_BCRYPT);
                            } else {
                                // Jika password tidak diinputkan, gunakan password yang ada di database
                                $password_hash = $row['password'];
                            }

                            $sql = "UPDATE user SET name = '$name', alamat = '$alamat', no_hp = '$no_hp', email = '$email', password = '$password_hash', user_type = '$user_type' WHERE id_user = $id";

                            $exe = mysqli_query($konek, $sql);

                            if ($exe) {
                                echo "<script language='JavaScript'>
                                    alert('Data terupdate');
                                    window.location.href='user.php';
                                    </script>";
                            } else {
                                echo "<script language='JavaScript'>
                                    alert('Data tidak terupdate');
                                    window.location.href='edit_user.php?id=$user';
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
