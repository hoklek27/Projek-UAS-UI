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
                        $sql = "SELECT * FROM kategori WHERE id_kategori = $id";
                        $result = mysqli_query($konek, $sql);

                        while ($row = mysqli_fetch_array($result)) {
                            ?>
                            <form method="post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <label for="nama_kategori">Nama Kategori:</label>
                                    <input type="text" class="form-control" id="nama"
                                        value="<?php echo $row['nama_kategori'] ?>" name="nama_kategori" required>
                                </div>
                                <div class="form-group">
                                    <label for="gambar_kategori">Gambar:</label>
                                    <?php if (!empty($row['gambar_kategori'])): ?>
                                        <input type="hidden" name="gambar_kategori_sebelumnya"
                                            value="<?php echo $row['gambar_kategori']; ?>">
                                    <?php endif; ?>
                                    <input type="file" class="form-control" id="gambar_kategori" name="gambar_kategori"
                                        accept="image/*">
                                </div>


                                <button type="submit" class="btn btn-primary" name="save">Submit</button>
                                <a href='category.php' class='btn btn-danger'>Cancel</a>
                            </form>
                            <?php
                        }
                        ?>

                        <?php
                        if (isset($_GET['id'])) {
                            $kategori = $_GET['id'];
                            $sql = "SELECT * FROM kategori WHERE id_kategori = $id";
                            $query = mysqli_query($konek, $sql);
                            $row = mysqli_fetch_array($query);
                        }

                        if (isset($_POST['save'])) {
                            $nama_kategori = $_POST['nama_kategori'];
                            $gambar_kategori = $_FILES['gambar_kategori']['name'];
                            $gambar_kategori_tmp = $_FILES['gambar_kategori']['tmp_name'];
                            $folder = 'storage/';
                            if (!empty($gambar_kategori_tmp)) {
                                move_uploaded_file($gambar_kategori_tmp, $folder . $gambar_kategori);
                            } else {
                                // Gunakan gambar sebelumnya jika gambar baru tidak diunggah
                                $gambar_kategori = $_POST['gambar_kategori_sebelumnya'];
                            }

                            $sql = "UPDATE kategori SET nama_kategori = '$nama_kategori', gambar_kategori = '$gambar_kategori' WHERE id_kategori = $id";

                            $exe = mysqli_query($konek, $sql);

                            if ($exe) {
                                echo "<script language='JavaScript'>
                                    alert('Data terupdate');
                                    window.location.href='category.php';
                                    </script>";
                            } else {
                                echo "<script language='JavaScript'>
                                    alert('Data tidak terupdate');
                                    window.location.href='edit_category.php?id=$kategori';
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