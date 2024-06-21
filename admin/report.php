<?php include('header.php') ?>

<?php

echo '<html>
<head>
  <style>
    /* Define your CSS styles here */
    .invoice {
      width: 100%;
      border-collapse: collapse;
      margin:auto;
      margin-bottom:20px;
    }
    .invoice th,
    .invoice td {
      border: 1px solid #ddd;
      padding: 8px;
    }
    .invoice th {
      background-color: #f5f5f5;
    }
    .invoice tbody tr:last-child td {
      border-bottom: none;
    }
    .invoice tfoot td {
      border-top: 1px solid #ddd;
      font-weight: bold;
    }
    .container {
        margin-top: 50px;
        margin-bottom: auto;
        border: 1px solid grey;
        border-radius: 5px;
        border-color: #ccc;
    }
  </style>
</head>
<body>
<div class="container">
<div class="invoice-title"><h2 class="pull-right">Invoice Pesanan</h2>';
$totalCancelQuery = "SELECT COUNT(*) AS totalcancel FROM transaksi WHERE status = 'cancel'";
$totalCancelResult = mysqli_query($konek, $totalCancelQuery);
$totalCancelRow = mysqli_fetch_assoc($totalCancelResult);
$totalCancel = $totalCancelRow['totalcancel'];
echo 'Total Pesanan Cancel:  ' . $totalCancel;

$totalQuery = "SELECT COUNT(*) AS total FROM transaksi WHERE status = 'paid'";
$totalResult = mysqli_query($konek, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$total = $totalRow['total'];
echo '<br>Total Pesanan Success:  ' . $total;

echo '</div>
  <table class="invoice">
    <thead>
      <tr>
        <th>id transaksi</th>
        <th>nama pemesan</th>
        <th>tanggal transaksi</th>
        <th>total harga</th>
        <th>status</th>
      </tr>
    </thead>
    <tbody>';

$sql = "SELECT transaksi.id_transaksi, transaksi.nama_pemesan, transaksi.lokasi, transaksi.tanggal_ambil, transaksi.lama_sewa, transaksi.total_harga, transaksi.status
    FROM transaksi
    WHERE transaksi.status = 'cancel' OR transaksi.status = 'paid'";
$query = mysqli_query($konek, $sql);
while ($row = mysqli_fetch_array($query)) {
    echo '<tr>
            <td>' . $row['id_transaksi'] . '</td>
            <td>' . $row['nama_pemesan'] . '</td>
            <td>' . $row['tanggal_ambil'] . '</td>
            <td>' . $row['total_harga'] . '</td>
            <td>' . ($row['status'] == 'Pending' ? "<span class='badge badge-secondary'>Pending</span>" : ($row['status'] == 'paid' ? "<span class='badge badge-success'>Success</span>" : "<span class='badge badge-danger'>cancel</span>")) . '</td>
          </tr>';
}

echo '</tbody>
      <tfoot>
        <tr>
          <td colspan="4" style="text-align: right;">Total Cancel:</td>
          
          <td>';

// Query to calculate the total
// Query to calculate the total
$totalCancelQuery = "SELECT SUM(total_harga) AS totalcancel FROM transaksi WHERE status = 'cancel'";
$totalCancelResult = mysqli_query($konek, $totalCancelQuery);
$totalCancelRow = mysqli_fetch_assoc($totalCancelResult);
$totalCancel = $totalCancelRow['totalcancel'];

$totalQuery = "SELECT SUM(total_harga) AS total FROM transaksi WHERE status = 'paid'";
$totalResult = mysqli_query($konek, $totalQuery);
$totalRow = mysqli_fetch_assoc($totalResult);
$total = $totalRow['total'];

echo '-' . $totalCancel . '</td>
        </tr>
        <tr>
          <td colspan="4" style="text-align: right;">Total:</td>
          <td>' . $total . '</td>
        </tr>
      </tfoot>
      <a href="cetak_report.php" class="btn btn-success mb-3 mt-3">Print PDF</a>
    </table>
  </div>   
</body>
</html>';
?>