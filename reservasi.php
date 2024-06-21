<?php
session_start();
$page = 'Reservasi';
include('layout/head.php') ?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
</section>
<!-- End Banner Area -->

<?php
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = array();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image = $_POST['image'];
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $keterangan = $_POST['ket'];
    $product_quantity = $_POST['qty'];


    $product = array(
        'id' => $product_id,
        'image' => $image,
        'name' => $product_name,
        'price' => $product_price,
        'ket' => $keterangan,
        'quantity' => $product_quantity
    );

    $_SESSION['cart'][$product_id] = $product;

    header('Content-Type: application/json');
    echo json_encode(array('success' => true));
    exit;
}

?>


<!--================Checkout Area =================-->
<section class="checkout_area section_gap">
    <div class="container">
        <div class="billing_details">
            <form class="row contact_form" action="proses_reservasi.php" method="post" novalidate="novalidate"
                id="reservasiForm">
                <div class="row">
                    <div class="col-lg-8">
                        <h3>Format Reservasi</h3>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="first" name="name" placeholder="Nama" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="number" class="form-control" id="add1" name="add1" placeholder="Nomor Telpon"
                                required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="number" class="form-control" id="add2" name="add2"
                                placeholder="Lama sewa / hari" min="1" required>
                        </div>
                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="tanggalWaktu" name="add4"
                                placeholder="Pilih tanggal dan waktu" required>
                        </div>
                        <script>
                            // Inisialisasi Flatpickr pada elemen input dengan id "tanggalWaktu"
                            flatpickr("#tanggalWaktu", {
                                enableTime: true,
                                dateFormat: "Y-m-d H:i",
                            });
                        </script>

                        <div class="col-md-12 form-group p_star">
                            <input type="text" class="form-control" id="city" name="city" placeholder="Lokasi Camp">
                        </div>
                        <input type="text" name="user" id="" value="<?= $_SESSION['id_user'] ?>" hidden>
                    </div>
                    <div class="col-lg-4">
                        <div class="order_box">
                            <h2>Daftar Pesanan</h2>
                            <?php
                            if (count($_SESSION['cart']) > 0) {
                                $total_price = 0;
                                ?>
                                <table class="list">
                                    <thead>
                                        <tr>
                                            <th width="50%">Nama Produk</th>
                                            <th width="40%">Jumlah</th>
                                            <th width="10%">Harga</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        foreach ($_SESSION['cart'] as $product) {
                                            $product_price = $product['price'] * $product['quantity'];
                                            $total_price += $product_price;
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $product['name']; ?>
                                                </td>
                                                <td>x
                                                    <?php echo $product['quantity']; ?> Pcs
                                                </td>
                                                <td>
                                                    <?php echo $product['price']; ?>
                                                </td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <br>
                                <ul class="list list_2">
                                    <li style="font-size: 15px;">Total <span style="font-size: 15px;">
                                            <?php echo number_format($total_price); ?>
                                        </span></li>
                                </ul>
                                <button class="primary-btn" id="reservasiBtn" type="submit">Konfirmasi Reservasi</button>
                                <?php
                            } else {
                                echo 'Keranjang belanja kosong';
                            }
                            ?>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</section>
<!--================End Checkout Area =================-->

<?php include('layout/footer.php'); ?>

<script>
    document.getElementById("reservasiForm").addEventListener("submit", function (event) {
        // Mengambil nilai dari input
        var name = document.getElementById("first").value;
        var telpon = document.getElementById("add1").value;
        var lamaSewa = document.getElementById("add2").value;
        var tanggalWaktu = document.getElementById("tanggalWaktu").value;

        // Mengecek apakah ada input yang kosong
        if (name.trim() === "" || telpon.trim() === "" || lamaSewa.trim() === "" || tanggalWaktu.trim() === "") {
            event.preventDefault(); // Mencegah pengiriman formulir
            alert("Harap lengkapi semua input sebelum melakukan reservasi.");
        }
    });
</script>