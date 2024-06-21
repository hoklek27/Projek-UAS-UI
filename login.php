<?php
session_start();

if (isset($_SESSION['user_name'])) {
    header('location:index.php');
    exit;
}

$page = 'Akun';
include('layout/head.php');

if (isset($_POST['login'])) {

    $email = mysqli_real_escape_string($konek, $_POST['email']);
    $pass = $_POST['password'];

    $select = " SELECT * FROM user WHERE email = '$email' ";

    $result = mysqli_query($konek, $select);

    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_array($result);
        if (password_verify($pass, $row['password'])) {
            if ($row['user_type'] == 'admin') {
                $_SESSION['admin_name'] = $row['name'];
                $_SESSION['id_user'] = $row['id_user'];
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=admin/dashboard.php">';
                exit;
            } elseif ($row['user_type'] == 'user') {
                $_SESSION['user_name'] = $row['name'];
                $_SESSION['id_user'] = $row['id_user'];
                echo '<META HTTP-EQUIV="Refresh" Content="0; URL=product.php">';
                exit;
            }
        } else {
            $error_msg[] = 'Password Salah!';
        }
    } else {
        $error_msg[] = 'Email Tidak Ditemukan!';
    }
}
?>

<!-- Start Banner Area -->
<section class="banner-area organic-breadcrumb">
</section>
<!-- End Banner Area -->

<!--================Login Box Area =================-->
<section class="login_box_area section_gap">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-6">
                <div class="login_form_inner">
                    <h3>LOGIN</h3>
                    <?php
                    if (isset($error_msg) && is_array($error_msg)) {
                        foreach ($error_msg as $msg) {
                            echo '<div class="alert alert-danger">' . $msg . '</div>';
                        }
                    }
                    ?>
                    <form class="row login_form" action="" method="post" id="contactForm">
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" name="login" class="primary-btn">Log In</button>
                            <a href="registrasi.php">Daftar Akun</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->

<?php include('layout/footer.php') ?>