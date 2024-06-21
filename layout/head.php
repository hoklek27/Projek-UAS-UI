<?php
include 'config/konek.php';
error_reporting(0);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Mobile Specific Meta -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Favicon-->
    <link rel="shortcut icon" href="img/camplogo1.png">
    <!-- Author Meta -->
    <meta name="author" content="CodePixar">
    <!-- Meta Description -->
    <meta name="description" content="">
    <!-- Meta Keyword -->
    <meta name="keywords" content="">
    <!-- meta character set -->
    <meta charset="UTF-8">
    <!-- Site Title -->
    <!-- Link ke Flatpickr CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    <!-- Link ke Flatpickr JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

    <title>Daeng Camp -
        <?= $page; ?>
    </title>

    <!--
        CSS
        ============================================= -->
    <link rel="stylesheet" href="css/linearicons.css">
    <link rel="stylesheet" href="css/font-awesome.min.css">
    <link rel="stylesheet" href="css/themify-icons.css">
    <link rel="stylesheet" href="css/bootstrap.css">
    <link rel="stylesheet" href="css/owl.carousel.css">
    <link rel="stylesheet" href="css/nice-select.css">
    <link rel="stylesheet" href="css/nouislider.min.css">
    <link rel="stylesheet" href="css/ion.rangeSlider.css" />
    <link rel="stylesheet" href="css/ion.rangeSlider.skinFlat.css" />
    <link rel="stylesheet" href="css/magnific-popup.css">
    <!-- Link Animate -->
    <link href="lib/animate/animate.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>



    <!--Awal Header Area -->
    <header class="header_area sticky-header">
        <div class="main_menu">
            <nav class="navbar navbar-expand-lg navbar-light main_box">
                <div class="container">
                    <!-- Brand and toggle get grouped for better mobile display -->
                    <a class="navbar-brand logo_h" href="index.php"><img src="img/logo.png" alt=""></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse"
                        data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                        aria-expanded="false" aria-label="Toggle navigation">
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse offset" id="navbarSupportedContent">
                        <ul class="nav navbar-nav menu_nav ml-auto">
                            <li class="nav-item <?php if ($page == 'Beranda') {
                                echo 'active';
                            } ?> "><a class="nav-link" href="index.php">Beranda</a></li>
                            <li class="nav-item <?php if ($page == 'Produk') {
                                echo 'active';
                            } ?>  submenu dropdown">
                                <a href="product.php" class="nav-link dropdown-toggle" data-toggle="dropdown"
                                    role="button" aria-haspopup="true" aria-expanded="false">Produk</a>
                                <ul class="dropdown-menu">

                                    <?php
                                    $sql = "SELECT * FROM kategori";
                                    $query = mysqli_query($konek, $sql);
                                    while ($row = mysqli_fetch_array($query)) {
                                        ?>
                                        <li class="nav-item"><a class="nav-link"
                                                href="product.php#<?= $row['nama_kategori']; ?>"><?= $row['nama_kategori']; ?></a>
                                        </li>
                                    <?php } ?>

                                </ul>
                            </li>
                            <li class="nav-item  <?php if ($page == 'Akun') {
                                echo 'active';
                            } ?> submenu dropdown">
                                <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown" role="button"
                                    aria-haspopup="true" aria-expanded="false">Akun</a>
                                <ul class="dropdown-menu">
                                    <?php if (isset($_SESSION['user_name'])): ?>
                                        <li class="nav-item"><a class="nav-link" href="#">Welcome
                                                <?php echo $_SESSION['user_name'] ?>
                                            </a></li>
                                        <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
                                    <?php else: ?>
                                        <li class="nav-item"><a class="nav-link" href="login.php">Login</a></li>
                                        <li class="nav-item"><a class="nav-link" href="registrasi.php">Registrasi</a></li>
                                    <?php endif; ?>
                                </ul>
                            </li>
                        </ul>
                        <ul class="nav navbar-nav navbar-right">
                            <li class="nav-item <?php if ($page == 'Keranjang') {
                                echo 'active';
                            } ?>"><a href="cart.php" class="nav-link cart"><span class="fa fa-shopping-cart"
                                        style="font-size:20px">
                                        <h6 class="d-lg-none nav-link">&nbsp; Keranjang</h6>
                                    </span></a></li>
                            <li class="nav-item">
                                <button class="search"><span class="nav-link lnr lnr-magnifier mt-2"
                                        id="search"></span></button>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
        <div class="search_input" id="search_input_box">
            <div class="container">

                <form class="d-flex justify-content-between" id="search_form" action="product.php" method="GET">
                    <input name="cari" type="text" class="form-control" id="search_input" placeholder="Search Here">
                    <button type="submit" class="btn"></button>
                    <span class="lnr lnr-cross" id="close_search" title="Close Search"></span>
                </form>

                <script>
                    document.getElementById("close_search").addEventListener("click", function () {
                        document.getElementById("search_input").value = "";
                        document.getElementById("search_form").action = "product.php";
                    });
                </script>



            </div>
        </div>
    </header>
    <!-- Akhir Header Area -->