<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $productId = $_POST['id'];
  $newQty = $_POST['qty'];

  if (isset($_SESSION['cart'][$productId])) {
    $product = $_SESSION['cart'][$productId];
    $product['quantity'] = $newQty;
    $_SESSION['cart'][$productId] = $product;

    $totalPrice = 0;
    foreach ($_SESSION['cart'] as $cartProduct) {
      $productPrice = $cartProduct['price'] * $cartProduct['quantity'];
      $totalPrice += $productPrice;
    }

    $_SESSION['total_price'] = $totalPrice;

    header('Content-Type: application/json');
    echo json_encode(
      array(
        'price' => number_format($product['price'] * $newQty),
        'total_price' => number_format($totalPrice)
      )
    );
    exit;
  }
}

?>