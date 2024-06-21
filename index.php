<?php
session_start();
$page = 'Beranda';
include('layout/head.php') ?>

<!-- Awal banner Area -->
<section class="banner-area" style="background-attachment: fixed;">
    <div class="container">
        <div class="row fullscreen align-items-center justify-content-start">
            <div class="col-lg-5 col-md-6 ">
                <div class="banner-content">
                    <h1 class="text-light wow fadeIn pulse" data-wow-delay="0.1s" data-wow-iteration="5s">DAENG CAMP</h1>
                    <h3 class="text-light wow fadeInLeft" data-wow-delay="0.5s">Sewa Tenda Camping</h3>
                    <h2 class="text-light wow fadeInRight" data-wow-delay="0.8s">Samarinda </h2>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Akhir banner Area -->

<section class="features-area section_gap">
    <div class="container">
        <div class="justify-content-center">
            <div class="text-center">
                <div class="mt-2">
                    <h2>Cara Pemesanan</h2>
                </div>
            </div>
        </div>
        <div class="row features-inner">
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInDown" data-wow-delay="0.1s">
                <div class="single-features">
                    <h3>1</h3>
                    <h6>Login / Daftar</h6>
                    <p>Lakukan login atau Daftar akun</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.3s">
                <div class="single-features">
                    <h3>2</h3>
                    <h6>Menyewa</h6>
                    <p>Pilih produk yang ingin di sewa lalu Klik Gambar atau tombol detail</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInDown" data-wow-delay="0.5s">
                <div class="single-features">
                    <h3>3</h3>
                    <h6>Keranjang</h6>
                    <p>Edit data produk yang ingin di sewa</p>
                </div>
            </div>
            <!-- single features -->
            <div class="col-lg-3 col-md-6 col-sm-6 wow fadeInUp" data-wow-delay="0.7s">
                <div class="single-features">
                    <h3>4</h3>
                    <h6>Reservasi</h6>
                    <p>Isi data reservasi dan klik kirim WA dan anda akan mendapatkan <b>Kode Pengambilan</b> </p>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- end features Area -->

<!--================Categorie Area =================-->
<section class="categorie_area">
    <div class="container">
        <div class="text-center">
            <h2>Kategori</h2>
        </div>
        <div class="row">
            <?php
            $sql = "SELECT * FROM kategori";
            $query = mysqli_query($konek, $sql);
            $delay = 0.1;
            while ($row = mysqli_fetch_array($query)) {

                ?>

                <div class="col-lg-4 wow fadeIn" data-wow-delay="<?= $delay; ?>s">
                    <div class="categories_post">
                        <a href="product.php#<?= $row['nama_kategori']; ?>">
                            <img src="admin/storage/<?= $row['gambar_kategori']; ?>" alt="post">
                            <div class="categories_details">
                                <div class="categories_text">

                                    <h5>
                                        <?= $row['nama_kategori']; ?>
                                    </h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>

                <!--================Blog Categorie Area =================-->
            <?php $delay+=0.1;} ?>
        </div>
    </div>
</section>

<?php include('layout/footer.php') ?>