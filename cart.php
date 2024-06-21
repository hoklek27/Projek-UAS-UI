<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function () {
        function updateQty(productId, newQty) {
            $.ajax({
                url: 'update_qty.php',
                method: 'POST',
                data: {
                    id: productId,
                    qty: newQty
                },
                success: function (response) {
                    var productPrice = response.price;
                    var totalPrice = response.total_price;

                    $('#product-price-' + productId).text(productPrice);
                    $('#total-price').text(totalPrice);
                }
            });
        }

        $('.qty').change(function () {
            var productId = $(this).data('product-id');
            var newQty = parseInt($(this).val());
            updateQty(productId, newQty);
        });
    });
</script>

<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    header('location:login.php');
    exit;
}
$page = 'Keranjang';
include('layout/head.php') ?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
</section>
<!-- End Banner Area -->

<!--================Cart Area =================-->
<section class="cart_area">
    <div class="container">
        <div class="cart_inner">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Product</th>
                            <th scope="col">Price</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Total</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        if (count($_SESSION['cart']) > 0) {
                            $total_price = 0;
                            foreach ($_SESSION['cart'] as $product) {
                                $productId = $product['id'];

                                // Query untuk mendapatkan stok produk dari database
                                $query = "SELECT id_produk, stok FROM produk WHERE id_produk = $productId";
                                $result = mysqli_query($konek, $query);

                                if (mysqli_num_rows($result) > 0) {
                                    $row = mysqli_fetch_assoc($result);
                                    $stok = $row['stok'];
                                } else {
                                    $stok = 0; // Jika tidak ada hasil dari query, set stok menjadi 0
                                }

                                $product_price = $product['price'] * $product['quantity'];
                                $total_price += $product_price;
                                ?>
                                <tr>
                                    <td>
                                        <div class="media">
                                            <div class="d-flex">
                                                <img src="<?php echo 'admin/storage/' . $product['image']; ?>" alt=""
                                                    style="width: 200px; height:200px;">
                                            </div>
                                            <div class="media-body">
                                                <p>
                                                    <?php echo $product['name'] ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <h5>
                                            <?php echo number_format($product['price']) ?>
                                        </h5>
                                    </td>
                                    <td>
                                        <div class="product_count">
                                            <input type="number" name="qty" id="sst" maxlength="12"
                                                value="<?php echo $product['quantity']; ?>" title="Quantity:"
                                                class="input-text qty" data-product-id="<?php echo $product['id']; ?>"
                                                onchange="updateQty(<?php echo $product['id']; ?>, this.value)" min="1"
                                                max="<?php echo $stok; ?>">
                                            <span class="stock">tersedia:
                                                <?php echo $stok; ?>
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <h5 id="product-price-<?php echo $product['id']; ?>">
                                            <?php echo number_format($product_price) ?>
                                        </h5>
                                    </td>
                                    <td>
                                        <a class="genric-btn danger circle"
                                            href="hapus_cart.php?id_produk=<?php echo $product['id'] ?>">Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td>
                                    <h5>Total Barang</h5>
                                </td>
                                <td>
                                    <h5 id="total-price">
                                        <?php echo number_format($total_price) ?>
                                    </h5>
                                </td>
                                <td></td>
                            </tr>
                            <?php
                        } else {
                            echo 'Keranjang belanja kosong';
                        } ?>
                        <tr class="out_button_area">
                            <td></td>
                            <td></td>
                            <td></td>
                            <td>
                                <div class="checkout_btn_inner d-flex align-items-center">
                                    <a class="gray_btn" href="product.php">Kembali Ke Produk</a>
                                    <a class="primary-btn" href="reservasi.php">Reservasi Sekarang</a>
                                </div>
                            </td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>
<!--================End Cart Area =================-->

<?php include('layout/footer.php') ?>