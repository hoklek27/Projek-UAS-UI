<?php
session_start();

// Mengecek apakah cart.php sedang diakses
if (!strpos($_SERVER['REQUEST_URI'], 'cart.php')) {
    // Menghapus data session kecuali jika cart.php tidak diakses
    session_destroy();
}

header('location: index.php');
exit;
?>