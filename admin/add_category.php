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
            <h1 class="h3 mb-2 text-gray-800">Add New Category</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama">Nama Kategori:</label>
                                <input type="text" class="form-control" id="nama_kategori"
                                    placeholder="Masukkan Nama Produk" name="nama_kategori" required>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar:</label>
                                <input type="file" class="form-control" id="gambar_kategori" name="gambar_kategori"
                                    required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save">Submit</button>
                            <a href='category.php' class='btn btn-danger'>Cancel</a>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            $nama_kategori = $_POST['nama_kategori'];
                            $gambar_kategori = $_FILES['gambar_kategori']['name'];
                            $gambar_tmp = $_FILES['gambar_kategori']['tmp_name'];
                            $folder = 'storage/';
                            move_uploaded_file($gambar_tmp, $folder . $gambar_kategori);
                            $sql = "INSERT INTO kategori (nama_kategori,gambar_kategori) VALUES ('$nama_kategori', '$gambar_kategori')";
                            $exe = mysqli_query($konek, $sql);

                            if ($exe) {
                                echo "<script language='JavaScript'>
                                            (window.alert('Data tersimpan'))
                                            location.href='category.php'
                                            </script>";
                            } else {
                                echo "<script language='JavaScript'>
                                            (window.alert('Data tidak tersimpan'))
                                            location.href='add_category.php'
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