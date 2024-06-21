<?php
session_start();

if (isset($_GET['id_produk'])) {
    $id_produk = $_GET['id_produk'];

    unset($_SESSION['cart'][$id_produk]);

    header('Location: cart.php');
    exit;
}
