<?php
include 'conf/konek.php';
error_reporting(0);
$id = $_GET['id'];
$sql = "DELETE FROM kategori WHERE id_kategori=$id";
$hasil = mysqli_query($konek, $sql);
if ($hasil) {
    echo "<script language='JavaScript'>
        (window.alert('Data terhapus'))
        location.href='category.php'
        </script>";
} else {
    echo "<script language='JavaScript'>
        (window.alert('Data tidak terhapus'))
        location.href='category.php'
        </script>";
}
?>