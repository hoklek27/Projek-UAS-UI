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
            <h1 class="h3 mb-2 text-gray-800">Add New Product</h1>


            <!-- DataTales Example -->
            <div class="card shadow mb-4">
                <div class="card-body">
                    <div class="table-responsive">
                        <form method="post" enctype="multipart/form-data">
                            <div class="form-group">
                                <label for="nama_produk">Nama Produk:</label>
                                <input type="text" class="form-control" id="nama" placeholder="Masukkan Nama Produk"
                                    name="nama_produk" required>
                            </div>
                            <div class="form-group">
                                <label for="keterangan">Keterangan Produk:</label>
                                <textarea type="text" class="form-control" id="keterangan"
                                    placeholder="Masukkan keterangan" name="keterangan" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="stok">Stok:</label>
                                <input type="number" class="form-control" id="stok" placeholder="Masukkan stok"
                                    name="stok" required min="1" oninput="validateStok(this)">
                            </div>

                            <script>
                                function validateStok(input) {
                                    if (input.value < 1) {
                                        input.setCustomValidity("Stok harus lebih dari atau sama dengan 1");
                                    } else {
                                        input.setCustomValidity("");
                                    }
                                }
                            </script>

                            <div class="form-group">
                                <label for="harga">Harga:</label>
                                <input type="number" class="form-control" id="harga" placeholder="Masukkan harga"
                                    name="harga" min="0" required>
                            </div>
                            <div class="form-group">
                                <label for="harga">Kategori:</label><br>
                                <select name="kategori" id="kategori" required>
                                    <option value="">Pilih Kategori</option>
                                    <?php
                                    $sql = "SELECT * FROM kategori WHERE id_kategori";
                                    $query = mysqli_query($konek, $sql);
                                    while ($row = mysqli_fetch_array($query)) {
                                        echo "<option value='" . $row['id_kategori'] . "'>" . $row['nama_kategori'] . "</option>";
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="gambar">Gambar:</label>
                                <input type="file" class="form-control" id="gambar" name="gambar" required>
                            </div>
                            <button type="submit" class="btn btn-primary" name="save">Submit</button>
                            <a href='product.php' class='btn btn-danger'>Cancel</a>
                        </form>
                        <?php
                        if (isset($_POST['save'])) {
                            $nama_produk = $_POST['nama_produk'];
                            $keterangan = $_POST['keterangan'];
                            $stok = $_POST['stok'];
                            $harga = $_POST['harga'];
                            $gambar = $_FILES['gambar']['name'];
                            $gambar_tmp = $_FILES['gambar']['tmp_name'];
                            $folder = 'storage/';
                            move_uploaded_file($gambar_tmp, $folder . $gambar);
                            $kategori = $_POST['kategori'];
                            $sql = "INSERT INTO produk (nama_produk,keterangan,stok,harga,gambar,id_kategori) VALUES ('$nama_produk', '$keterangan','$stok', '$harga','$gambar', '$kategori')";
                            $exe = mysqli_query($konek, $sql);

                            if ($exe) {
                                echo "<script language='JavaScript'>
                                            (window.alert('Data tersimpan'))
                                            location.href='product.php'
                                            </script>";
                            } else {
                                echo "<script language='JavaScript'>
                                            (window.alert('Data tidak tersimpan'))
                                            location.href='add_product.php'
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