<?php
session_start();
$page = 'Akun';
include('layout/head.php');

if (isset($_POST['submit'])) {
    $name = mysqli_real_escape_string($konek, $_POST['name']);
    $alamat = mysqli_real_escape_string($konek, $_POST['alamat']);
    $nohp = mysqli_real_escape_string($konek, $_POST['nohp']);
    $email = mysqli_real_escape_string($konek, $_POST['email']);
    $pass = $_POST['password'];
    $cpass = $_POST['cpassword'];

    $select = "SELECT * FROM user WHERE email = '$email'";

    $result = mysqli_query($konek, $select);

    if (mysqli_num_rows($result) > 0) {
    } else {
        if ($pass != $cpass) {
        } else {
            $hashed_password = password_hash($pass, PASSWORD_BCRYPT);

            $insert = "INSERT INTO user (name, alamat, no_hp, email, password, user_type) VALUES ('$name', '$alamat', '$nohp', '$email', '$hashed_password', 'user')";
            mysqli_query($konek, $insert);
            echo '<META HTTP-EQUIV="Refresh" Content="0; URL=login.php">';
            exit;
        }
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
                    <h3>Registrasi</h3>
                    <form class="row login_form" action="" method="post" id="contactForm">
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" name="name" placeholder="Nama" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" name="alamat" placeholder="Alamat" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="text" class="form-control" name="nohp" placeholder="No Hp" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="email" class="form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <input type="password" class="form-control" name="cpassword"
                                placeholder="Confirm Your Password" required>
                        </div>
                        <div class="col-md-12 form-group">
                            <button type="submit" value="submit" name="submit" class="primary-btn">Daftar</button>
                            <a href="login.php">Memiliki Akun</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
<!--================End Login Box Area =================-->


<?php include('layout/footer.php') ?>