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
    <!-- Site Title -->

    <title>Daeng Camp -
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
    <link rel="stylesheet" href="css/main.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>

<body>



    <?php
    session_start();

    include 'config/konek.php';

    $name = $_POST['name'];
    $no_telpon = $_POST['add1'];
    $lama_sewa = $_POST['add2'];
    $tgl_ambil = $_POST['add4'];
    $lokasi_camp = $_POST['city'];
    $user = $_POST['user'];
    $status = 'Pending';

    $total_produk = 0;
    if (is_array($_SESSION['cart'])) {
        foreach ($_SESSION['cart'] as $product) {
            $product_price = $product['price'] * $product['quantity'];
            $total_produk += $product_price;
        }
    }

    $total_harga = $total_produk * $lama_sewa;

    $sql = "INSERT INTO transaksi (name, telpon, lokasi, tanggal_ambil, status, lama_sewa, total_harga, id_user) VALUES ('$name', $no_telpon, '$lokasi_camp', '$tgl_ambil', '$status', '$lama_sewa', $total_harga, $user)";
    if ($konek->query($sql) === TRUE) {
        $id_transaksi = $konek->insert_id;
        $nomor_telepon = "+6287846540586"; // Nomor telepon yang ingin dituju
        $pesan = "Halo, saya ingin membahas transaksi dengan ID " . $id_transaksi . ". Total harga: " . $total_harga;

        // Membentuk URL deep link untuk mengirim pesan ke WhatsApp
        $url = "https://wa.me/" . $nomor_telepon . "?text=" . urlencode($pesan);

        echo "
    <section class='banner-area organic-breadcrumb'>
    </section>
    <div class='container'>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <br>
        <p align='center'>
            Reservasi berhasil disimpan<br>
            ID Transaksi:  $id_transaksi<br>
            Total Harga :  $total_harga<br><br>
            <a href='$url'>Hubungi via WhatsApp</a><br><br>
            <a class='primary-btn' href='product.php'>kembali ke produk</a>
        </p>
    </div>
    ";

        if (is_array($_SESSION['cart'])) {
            foreach ($_SESSION['cart'] as $product) {
                $produk_id = $product['id'];
                $produk_price = $product['price'];
                $produk_qty = $product['quantity'];

                // Query untuk mengurangi stok barang di tabel 'produk'
                $update_stok_query = "UPDATE produk SET stok = stok - $produk_qty WHERE id_produk = $produk_id";
                if ($konek->query($update_stok_query) !== TRUE) {
                    echo "Error: " . $update_stok_query . "<br>" . $konek->error;
                }

                // Query untuk INSERT ke tabel 'detail_produk'
                $insert_detail_query = "INSERT INTO detail_produk (jumlah, harga_barang, id_produk, id_transaksi) VALUES ('$produk_qty', '$produk_price', '$produk_id', '$id_transaksi')";
                if ($konek->query($insert_detail_query) !== TRUE) {
                    echo "Error: " . $insert_detail_query . "<br>" . $konek->error;
                }
            }
        }


        // Menghapus session barang di keranjang setelah reservasi dikonfirmasi
        unset($_SESSION['cart']);



        $konek->close();
    } else {
        echo "Error: " . $sql . "<br>" . $konek->error;
    }
    ?>

    <script>
        if (window.performance && window.performance.navigation.type === 1) {
            // Halaman ini sedang direfresh, lakukan tindakan yang diinginkan
            window.location.href = 'product.php'; // G

            // Menambahkan entri baru ke riwayat peramban
            window.history.pushState(null, null, window.location.href);
            window.onpopstate = function () {
                // Mencegah pengguna kembali ke halaman sebelumnya
                window.history.pushState(null, null, window.location.href);
            };
        }
    </script>



    <script src="js/vendor/jquery-2.2.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js"
        integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4"
        crossorigin="anonymous"></script>
    <script src="js/vendor/bootstrap.min.js"></script>
    <script src="js/jquery.ajaxchimp.min.js"></script>
    <script src="js/jquery.nice-select.min.js"></script>
    <script src="js/jquery.sticky.js"></script>
    <script src="js/nouislider.min.js"></script>
    <script src="js/jquery.magnific-popup.min.js"></script>
    <script src="js/owl.carousel.min.js"></script>
    <!--gmaps Js-->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
    <script src="js/gmaps.min.js"></script>
    <script src="js/main.js"></script>

    <!-- Alert -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
    <?php include 'components/alert.php'; ?>
</body>

</html>