<?php
session_start();
if (!isset($_SESSION['user_name'])) {
    echo json_encode(array('success' => false));
    exit;
}

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
        'name' => $product_name,
        'image' => $image,
        'price' => $product_price,
        'ket' => $keterangan,
        'quantity' => $product_quantity
    );

    $_SESSION['cart'][$product_id] = $product;

    header('Content-Type: application/json');
    echo json_encode(array('success' => true));
    exit;
}

if (count($_SESSION['cart']) > 0) {
    echo '<table>';
    echo '<thead>';
    echo '<tr><th>Nama Produk</th><th>Keterangan</th><th>Jumlah</th><th>Harga</th><th>Subtotal</th></tr>';
    echo '</thead>';
    echo '<tbody>';
    $total_price = 0;
    foreach ($_SESSION['cart'] as $product) {
        $product_price = $product['price'] * $product['quantity'];
        echo '<tr>';
        echo '<td>' . $product['name'] . '</td>';
        echo '<td>' . $product['ket'] . '</td>';
        echo '<td>' . $product['quantity'] . '</td>';
        echo '<td>Rp' . number_format($product['price']) . '</td>';
        echo '<td>Rp' . number_format($product_price) . '</td>';
        echo '</tr>';
        $total_harga += $product_price;
    }
    echo '<tr><td colspan="4">Total harga:</td><td>Rp' . number_format($total_price) . '</td></tr>';
    echo '</tbody>';
    echo '</table>';
} else {
    echo 'Keranjang belanja kosong';
}

echo '<pre>';
print_r($_SESSION['cart']);
echo '</pre>';
?>