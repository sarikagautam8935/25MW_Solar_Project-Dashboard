<?php
$page = basename($_SERVER['SCRIPT_NAME']);
ob_start();
?>

<style>
    .sidenav .nav-link {
        font-weight: bold;
        color: white;
    }
    .sidenav .nav-link:hover {
        background-color: #193441; 
    }

    .sidenav .nav-link.active {
        background-color: #193441;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .sidenav .nav-link .nav-link-text {
        color: white; 
    }
</style>

<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3" id="sidenav-main" style="background-color: #3e606f; /* Updated to third-color */">
    <div class="sidenav-header">
        <i class="fas fa-times p-3 cursor-pointer text-white opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
        <a class="navbar-brand m-0" href="#" target="_blank">
            <span class="ms-1 font-weight-bold text-white">Project Dashboard</span>
        </a>
    </div>
    <hr class="horizontal light mt-0 mb-2" style="border-color: #d1dbbd;"> <!-- Updated to second-color -->
    <div class="collapse navbar-collapse w-auto max-height-vh-100" id="sidenav-collapse-main">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "index.php" ? 'active bg-gradient primary' : ''; ?>" href="index.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">home</i>
                    </div>
                    <span class="nav-link-text ms-1">Home</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "design_display.php" ? 'active bg-gradient primary' : ''; ?>" href="design_display.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">brush</i>
                    </div>
                    <span class="nav-link-text ms-1">Design</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "supply.php" ? 'active bg-gradient primary' : ''; ?>" href="supply.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">local_shipping</i>
                    </div>
                    <span class="nav-link-text ms-1">Supply</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "service.php" ? 'active bg-gradient primary' : ''; ?>" href="service.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">build</i>
                    </div>
                    <span class="nav-link-text ms-1">Service</span>
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-white <?= $page == "invoice.php" ? 'active bg-gradient primary' : ''; ?>" href="../pages/invoice.php">
                    <div class="text-white text-center me-2 d-flex align-items-center justify-content-center">
                        <i class="material-icons opacity-10">receipt</i>
                    </div>
                    <span class="nav-link-text ms-1">Invoice</span>
                </a>
            </li>
        </ul>
    </div>
    <div class="sidenav-footer position-absolute w-100 bottom-0">
        <div class="mx-3">
            <a class="btn bg-gradient-primary mt-4 w-100" href="../logout.php"> LOGOUT </a>
        </div>
    </div>
</aside>
