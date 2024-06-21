<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
	$(document).ready(function() {
		$('.add-to-cart-form').submit(function(event) {
			event.preventDefault();
			var form = $(this);
			var data = form.serialize();
			$.ajax({
				url: 'keranjang.php',
				type: 'post',
				dataType: 'json',
				data: data,
				success: function(response) {
					if (response.success) {
						alert('Produk berhasil ditambahkan ke keranjang');
						window.location.href = 'cart.php';
						$.ajax({
							url: 'keranjang.php',
							type: 'get',
							success: function(data) {
								$('.keranjang').html(data);
							}
						});
					} else {
						alert('Silahkan login terlebih dahulu');
						location.href = 'login.php';
					}
				},
				error: function() {
					alert('Terjadi kesalahan saat menambahkan produk');
				}
			});
		});
	});
</script>

<?php
session_start();
$page = 'Produk';
include('layout/head.php')
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
</section>
<!-- End Banner Area -->

<!--================Single Product Area =================-->
<?php
$id_produk = $_GET["id"];
$sql = $konek->query("SELECT * FROM produk WHERE id_produk ='$id_produk' ");
$detail = $sql->fetch_assoc();

?>
<div class="product_image_area">
	<div class="container">
		<div class="row s_product_inner">
			<div class="col-md-6  mb-4 text-md-right">
				<img class="img-fluid" src="admin/storage/<?php echo $detail['gambar'] ?>" alt="" style="width: 400px; height:400px;">
			</div>

			<div class="col-md-5 offset-lg-1">
				<div class="s_product_text">
					<h3>
						<?php echo $detail['nama_produk'] ?>
					</h3>
					<h2>
						<?php echo $detail['harga'] ?>/hari
					</h2>
					<ul class="list">
						<li>
							<h6> Stok :
								<?php echo $detail['stok'] ?>
							</h6>
						</li>
					</ul>
					<p>
						<?php echo nl2br($detail['keterangan']); ?>
					</p>

					<form class="add-to-cart-form" action="cart.php" method="post">
						<div class="product_count">
							<input type="hidden" name="image" value="<?php echo $detail['gambar'] ?>" id="">
							<input type="hidden" name="product_id" value="<?php echo $detail['id_produk'] ?>" id="">
							<input type="hidden" name="product_name" value="<?php echo $detail['nama_produk'] ?>" id="">
							<input type="hidden" name="product_price" value="<?php echo $detail['harga'] ?>" id="">
							<input type="hidden" name="ket" value="<?php echo nl2br($detail['keterangan']); ?>" id="">
							<label for="qty">Quantity:</label>
							<input type="text" name="qty" id="sst" maxlength="12" value="1" title="Quantity:" class="input-text qty">
							<button onclick="increaseQty()" class="increase items-count" type="button"><i class="lnr lnr-chevron-up"></i></button>
							<button onclick="decreaseQty()" class="reduced items-count" type="button"><i class="lnr lnr-chevron-down"></i></button>

							<script>
								var maxQty = <?php echo $detail['stok']; ?>;

								function increaseQty() {
									var result = document.getElementById('sst');
									var sst = parseInt(result.value);
									if (!isNaN(sst)) {
										if (sst < maxQty) {
											result.value = sst + 1;
										}
									}
								}

								function decreaseQty() {
									var result = document.getElementById('sst');
									var sst = parseInt(result.value);
									if (!isNaN(sst)) {
										if (sst > 1) {
											result.value = sst - 1;
										}
									}
								}
							</script>
						</div>
						<div class="card_area d-flex align-items-center">
							<button type="submit" class="primary-btn">Masukan ke Keranjang</button>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<?php include('layout/footer.php') ?>