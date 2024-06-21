<?php
include 'conf/konek.php'
    ?>
<html>

<head>
    <title>Laporan Transaksi</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.css">
    <link rel="stylesheet" type="text/css"
        href="https://cdn.datatables.net/buttons/1.6.5/css/buttons.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
    <script type="text/javascript" charset="utf8"
        src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.js"></script>

    <style>
        .form-group {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .form-group label {
            flex-shrink: 0;
            width: 120px;
        }

        .form-group input[type="date"] {
            flex-grow: 1;
            max-width: 150px;
        }
    </style>
</head>

<body>
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="dashboard.php">Dashboard</a></li>
            <li class="breadcrumb-item"><a href="history.php">History</a></li>
            <li class="breadcrumb-item active" aria-current="page">Cetak Report</li>
        </ol>
    </nav>
    <div class="container">
        <h2>Invoice Pesanan</h2>
        <div class="data-tables datatable-dark">
            <div class="row mb-3">
                <div class="col-md-6 mt-3">
                    <form action="cetak_report.php" method="GET">
                        <div class="form-group">
                            <label for="start_date">Tanggal Mulai:</label>
                            <input type="date" class="form-control" name="start_date" required>
                        </div>
                        <div class="form-group">
                            <label for="end_date">Tanggal Akhir:</label>
                            <input type="date" class="form-control" name="end_date" required>
                        </div>
                        <button class="btn btn-primary" type="submit">Sort By Date</button>
                    </form>
                    <a class="btn btn-primary" href="cetak_report.php?all_date">All Date</a>

                </div>
            </div>
        </div>
        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
            <thead>
                <tr>
                    <th>id transaksi</th>
                    <th>nama pemesan</th>
                    <th>tanggal transaksi</th>
                    <th>status</th>
                    <th>total harga</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (isset($_GET['all_date'])) {
                    // Reset the start_date and end_date values
                    $start_date = '';
                    $end_date = '';
                }
                $start_date = isset($_GET['start_date']) ? $_GET['start_date'] : '';
                $end_date = isset($_GET['end_date']) ? $_GET['end_date'] : '';

                // Query untuk mengambil data
                $sql = "SELECT transaksi.id_transaksi, transaksi.name, transaksi.tanggal_ambil, transaksi.total_harga, transaksi.status
        FROM transaksi
        WHERE (transaksi.status = 'cancel' OR transaksi.status = 'paid') AND transaksi.total_harga != 0";


                // Tambahkan kondisi rentang tanggal jika tanggal mulai dan akhir sudah diisi
                if (!empty($start_date) && !empty($end_date)) {
                    $sql .= " AND transaksi.tanggal_ambil BETWEEN '$start_date' AND '$end_date'";
                }
                $query = mysqli_query($konek, $sql);
                while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <tr>
                        <td>
                            <?php echo $row['id_transaksi']; ?>
                        </td>
                        <td>
                            <?php echo $row['name']; ?>
                        </td>
                        <td>
                            <?php echo $row['tanggal_ambil']; ?>
                        </td>
                        <td>
                            <?= ($row['status'] == 'Pending') ? "<span class='badge badge-secondary'>Pending</span>" : (($row['status'] == 'paid') ? "<span class='badge badge-success'>Success</span>" : "<span class='badge badge-danger'>cancel</span>"); ?>
                        </td>
                        <td>
                            <?php echo $row['total_harga']; ?>
                        </td>


                    </tr>

                    <?php
                }
                ?>

            </tbody>
            <?php
            // Calculate total cancel
            $query = "SELECT SUM(total_harga) AS total_cancel
            FROM transaksi
            WHERE status = 'cancel'";

            if (!empty($start_date) && !empty($end_date)) {
                $query .= " AND tanggal_ambil BETWEEN '$start_date' AND '$end_date'";
            }

            $result = mysqli_query($konek, $query);
            $row = mysqli_fetch_assoc($result);
            $jumlah_cancel = $row['total_cancel'];

            // Calculate total paid
            $query = "SELECT SUM(total_harga) AS total_paid
            FROM transaksi
            WHERE status = 'paid'";

            if (!empty($start_date) && !empty($end_date)) {
                $query .= " AND tanggal_ambil BETWEEN '$start_date' AND '$end_date'";
            }

            $result = mysqli_query($konek, $query);
            $row = mysqli_fetch_assoc($result);
            $jumlah_sukses = $row['total_paid'];
            ?>

            <tbody>
                <tr>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td align="right">Jumlah pesanan cancel</td>
                    <td style="">
                        <?php echo '-' . $jumlah_cancel; ?>
                    </td>
                </tr>
                <tr>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td style="border:none;"></td>
                    <td align="right">Jumlah pesanan sukses</td>
                    <td style="">
                        <?php echo $jumlah_sukses; ?>
                    </td>
                </tr>
            </tbody>

        </table>
    </div>
    </div>


    <script>
        $(document).ready(function () {
            $('#dataTable').DataTable({
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });
        });

    </script>

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.flash.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/1.6.5/js/buttons.print.min.js"></script>



</body>

</html>