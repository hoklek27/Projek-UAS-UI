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
                    <h1 class="h3 mb-2 text-gray-800">Edit Product</h1>

                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-body">
                            <div class="table-responsive">
                                <?php
                                $id = $_GET['id'];
                                $sql = "SELECT * FROM produk WHERE id_produk = $id";
                                $result = mysqli_query($konek, $sql);

                                while ($row = mysqli_fetch_array($result)) {
                                    ?>
                                    <form method="post" enctype="multipart/form-data">
                                        <div class="form-group">
                                            <label for="nama_produk">Nama Produk:</label>
                                            <input type="text" class="form-control" id="nama"
                                                value="<?php echo $row['nama_produk'] ?>" name="nama_produk" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="keterangan">Keterangan Produk:</label>
                                            <textarea type="text" class="form-control" id="keterangan"
                                                value="<?php echo $row['keterangan'] ?>" name="keterangan" required><?php echo $row['keterangan'] ?></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="stok">Stok:</label>
                                            <input type="number" class="form-control" id="stok"
                                                value="<?php echo $row['stok'] ?>" name="stok" min="1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="harga">Harga:</label>
                                            <input type="text" class="form-control" id="harga"
                                                value="<?php echo $row['harga'] ?>" name="harga" min="1" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="kategori">Kategori:</label><br>
                                            <select name="kategori" id="kategori" required>
                                                <option value="">Pilih Kategori</option>
                                                <?php
                                                $sql_kat = "SELECT * FROM kategori";
                                                $query_kat = mysqli_query($konek, $sql_kat);
                                                while ($row_kat = mysqli_fetch_array($query_kat)) {
                                                    $selected = ($row_kat['id_kategori'] == $row['id_kategori']) ? "selected" : "";
                                                    echo "<option value='" . $row_kat['id_kategori'] . "' $selected>" . $row_kat['nama_kategori'] . "</option>";
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="gambar">Gambar Sebelumnya: <?php echo $row['gambar']; ?></label>
                                            <?php if (!empty($row['gambar'])): ?>
                                                <input type="hidden" name="gambar_sebelumnya" value="<?php echo $row['gambar']; ?>">
                                            <?php endif; ?>
                                            <input type="file" class="form-control" id="gambar" name="gambar" accept="image/*">
                                        </div>

                                        <button type="submit" class="btn btn-primary" name="save">Submit</button>
                                        <a href='product.php' class='btn btn-danger'>Cancel</a>
                                    </form>
                                    <?php
                                }
                                ?>

                                <?php
                                if (isset($_GET['id'])) {
                                    $id_produk = $_GET['id'];
                                    $sql = "SELECT * FROM produk WHERE id_produk = '$id_produk'";
                                    $query = mysqli_query($konek, $sql);
                                    $row = mysqli_fetch_array($query);
                                }

                                if (isset($_POST['save'])) {
                                    $nama_produk = $_POST['nama_produk'];
                                    $keterangan = $_POST['keterangan'];
                                    $stok = $_POST['stok'];
                                    $harga = $_POST['harga'];
                                    $gambar = $_FILES['gambar']['name'];
                                    $gambar_tmp = $_FILES['gambar']['tmp_name'];
                                    $folder = 'storage/';
                                    if (!empty($gambar_tmp)) {
                                        move_uploaded_file($gambar_tmp, $folder . $gambar);
                                    } else {
                                        // Gunakan gambar sebelumnya jika gambar baru tidak diunggah
                                        $gambar = $_POST['gambar_sebelumnya'];
                                    }
                                    $kategori = $_POST['kategori'];

                                    $sql = "UPDATE produk SET nama_produk = '$nama_produk', keterangan = '$keterangan', stok = '$stok', harga = '$harga', gambar = '$gambar', id_kategori = '$kategori' WHERE id_produk = '$id_produk'";
                                    $exe = mysqli_query($konek, $sql);

                                    if ($exe) {
                                        echo "<script language='JavaScript'>
                                                 (window.alert('Data terupdate'))
                                                 location.href='product.php'
                                                 </script>";
                                    } else {
                                        echo "<script language='JavaScript'>
                                                 (window.alert('Data tidak terupdate'))
                                                 location.href='edit_product.php?id=$id_produk'
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