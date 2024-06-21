<?php
include('header.php');
include('navbar.php');
include('sidebar.php');
include('footer.php');
session_start();

if (!isset($_SESSION['admin_name'])) {
    header('location:../login.php');
}
?>
<div class="container">
    <div class="content">
        <h3>hi, <span>admin</span></h3>
        <h1>welcome <span>
                <?php echo $_SESSION['admin_name'] ?>
            </span></h1>
        <p>this is an admin page</p>
        <a href="login_form.php" class="btn">login</a>
        <a href="register_form.php" class="btn">register</a>
        <a href="../logout.php" class="btn">logout</a>
    </div>
</div>