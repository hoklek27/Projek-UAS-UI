<!-- Sidebar -->
<ul class="navbar-nav  sidebar sidebar-dark accordion" id="accordionSidebar" style="background-color: #1B9C85;">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="dashboard.php">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-campground" style='font-size:25px'></i>
        </div>
        <div class="sidebar-brand-text mx-3">Admin Panel</div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item <?php if ($page == 'Dashboard') {echo 'active';} ?>">
        <a class="nav-link" href="dashboard.php">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>


    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Management
    </div>


    <!-- Nav Item - Charts -->
    <li class="nav-item <?php if ($page == 'Product') {echo 'active';} ?> ">
        <a class="nav-link" href="product.php">
            <i class="fas fa-fw fa-box-open"></i>
            <span>Product</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if ($page == 'Category') {echo 'active';} ?>">
        <a class="nav-link" href="category.php">
            <i class="fas fa-fw fa-boxes"></i>
            <span>Category</span></a>
    </li>


    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if ($page == 'Transaction') {echo 'active';} ?>">
        <a class="nav-link" href="transaction.php">
            <i class="fas fa-fw fa-money-bill-wave"></i>
            <span>Transaction</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if ($page == 'History') {echo 'active';} ?>">
        <a class="nav-link" href="history.php">
            <i class="fas fa-fw fa-history"></i>
            <span>History</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item <?php if ($page == 'User') {echo 'active';} ?>">
        <a class="nav-link" href="user.php">
            <i class="fas fa-fw fa-user"></i>
            <span>User</span></a>
    </li>
    
    <hr class="sidebar-divider d-none d-md-block">
    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="../logout.php">
            <i class="color-logoout fas fa-fw font-weight-bold fa-sign-out-alt" style="color: #482121;"></i>
            <span class="color-logout font-weight-bold" style="color: #482121;">Logout</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>