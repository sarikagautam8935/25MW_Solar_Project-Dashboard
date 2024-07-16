<?php
session_start();
include('includes/header.php'); ?>

<?php if (isset($_SESSION['message'])) { ?>
    <div class="alert alert-warning alert-dismissible fade show" role="alert">
        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
<?php
    unset($_SESSION['message']);
} ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <style>
        .first-color {
            background: #d1dbbd;
        }

        .second-color {
            background: #91aa9d;
        }

        .third-color {
            background: #3e606f;
        }

        .fourth-color {
            background: #193441;
        }

        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            color: #333;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        header {
            background-color: #193441;
            color: white;
            padding: 10px 0;
            text-align: center;
        }

        h1 {
            color: #193441;
            text-align: center;
        }

        .content {
            flex: 1;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        footer {
            text-align: center;
            padding: 10px 0;
            background-color: #193441;
            color: white;
        }

        .footer-text {
            margin-top: auto;
            text-align: center;
            padding: 10px 0;
            background-color: #d1dbbd;
            color: black;
            width: 100%;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 20px;
            background-color: #d1dbbd;
        }

        .logo-container {
            flex: 1;
        }

        .logo-container img {
            width: 400px; /* Reduce the size of the logos */
            height: auto;
        }

        .heading-container {
            text-align: center;
            background-color: #d1dbbd;
            font-family: 'Times New Roman', sans-serif;
            color: #045F5F;
            margin-top: 75px;
            font-weight: bold;
        }

        .heading-container h2 {
            font-size: 68px; /* Change the font size here */
        }

        .button-container {
            text-align: center;
            margin-top: 20px;
        }

        .dashboard-button {
            padding: 10px 20px;
            font-size: 18px;
            color: white;
            background-color: #193441;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
        }

        .dashboard-button:hover {
            background-color: #3e606f;
        }
    </style>
</head>

<body class="first-color">
    <div class="header-container">
        <div class="logo-container" style="text-align: left;">
            <img src="../enerture_dashboard/admin/assets/image/LOGO1.png" alt="Logo 1">
        </div>
        <div class="logo-container" style="text-align: right;">
            <img src="../enerture_dashboard/admin/assets/image/LOGO2.png" alt="Logo 2">
        </div>
    </div>
    <div class="heading-container">
        <h2>25MW AC Solar Project Namrup, Assam - Dashboard</h2>
        <div class="button-container">
            <a href="../enerture_dashboard/admin/index.php" class="dashboard-button">Go to Dashboard</a>
        </div>
    </div>

    <footer class="footer-text">
        <p>Copyright © Enerture Technologies Pvt. Ltd</p>
    </footer>
</body>

</html>
<?php include('includes/footer.php'); ?>
