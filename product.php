<?php
session_start();
$page = 'Produk';
include('layout/head.php');

if (isset($_POST['cart'])) {
	$warning_msg[] = 'Cart is full!';
}

// Mendapatkan nilai pencarian dari URL
$searchKeyword = isset($_GET['cari']) ? $_GET['cari'] : '';

?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
</section>
<!-- End Banner Area -->

<?php
$sql = "SELECT * FROM kategori WHERE id_kategori";
$kategori = mysqli_query($konek, $sql);
?>
<!-- Awal  Product -->
<?php while ($row = mysqli_fetch_array($kategori)): ?>
	<?php
	$sql = "SELECT produk.*, kategori.nama_kategori FROM produk
	        INNER JOIN kategori ON produk.id_kategori = kategori.id_kategori
	        WHERE produk.id_kategori = " . $row['id_kategori'];

	// Jika terdapat pencarian, tambahkan kondisi WHERE dengan kata kunci pencarian
	if (!empty($searchKeyword)) {
		$sql .= " AND (produk.nama_produk LIKE '%$searchKeyword%' OR kategori.nama_kategori LIKE '%$searchKeyword%')";
	}

	$product = mysqli_query($konek, $sql);

	// Cek apakah ada produk yang sesuai dengan pencarian
	if (mysqli_num_rows($product) > 0):
		?>
		<div class="mb-3" id="<?= $row['nama_kategori']; ?>"></div>
		<section class="lattest-product-area pb-40 category-list">
			<div class="container">
				<div class="row justify-content-center">
					<div class="col-lg-6 text-center ">
						<div class="section-title">
							<h1>
								<?= $row['nama_kategori']; ?>
							</h1>
						</div>
					</div>
				</div>
				<div class="row">
					<!-- single product -->
					<?php $delay=0.1; while ($col = mysqli_fetch_array($product)): ?>
						<div class="col-lg-3 col-md-4 col-6 wow fadeInUp" data-wow-delay="<?= $delay; ?>s">
							<a href="detail_product.php?id=<?php echo $col['id_produk']; ?>">
								<div class="single-product">
									<img class="img-fluid" src="admin/storage/<?php echo $col['gambar']; ?>" alt=""
										style="width: 250px; height:200px;">
									<div class=" product-details">
										<h6>
											<?= $col['nama_produk']; ?>
										</h6>
										<div class="price">
											<h6>
												<?= $col['harga']; ?>
											</h6>
											<h6 class="text-primary-color2">/hari</h6>
										</div>
										<div class="prd-bottom">
											<a href="detail_product.php?id=<?php echo $col['id_produk']; ?>" class="social-info">
												<span class="lnr lnr-move"></span>
												<p class="hover-text">Detail</p>
											</a>
										</div>
									</div>
								</div>
							</a>
						</div>
					<?php $delay+=0.1;
					if ($delay>=0.5) {
						$delay=0.1;
					}
					; endwhile; ?>
					<!-- single product -->
				</div>
			</div>
		</section>
		<?php
	endif;
?>
<?php endwhile; ?>
<!-- Akhir  Product -->

<?php include('layout/footer.php') ?>