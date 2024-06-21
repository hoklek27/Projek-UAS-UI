<?php include('header.php') ?>
<?php
// Mengambil ID transaksi dari parameter URL
$id_transaksi = $_GET['id'];

// Mengupdate status transaksi menjadi "cancel"
$update_sql = "UPDATE transaksi SET status = 'cancel' WHERE id_transaksi = $id_transaksi";
$update_query = mysqli_query($konek, $update_sql);

if ($update_query) {
    // Status berhasil diperbarui
    header("Location: transaction.php");
    exit();
} else {
    // Terjadi kesalahan saat mengupdate status
    echo "Failed to update status.";
}
?>