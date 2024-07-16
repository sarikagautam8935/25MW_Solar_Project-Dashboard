<?php
session_start();


if(isset($_SESSION['auth'])){
    $_SESSION['message'] = "You are already Logged In";
    header('Location: index.php');
    exit();
}
include('includes/header.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
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
    </style>
</head>
<body class="first-color">
<div class="py-5"></div>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <?php if (isset($_SESSION['message'])) { ?>
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        <strong>Hey!</strong> <?= $_SESSION['message']; ?>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php
                    unset($_SESSION['message']);
                } ?>
                <div class="card-header">
                    <h4>Login Form</h4>
                </div>
                <div class="card-body">
                    <form action="functions/authcode.php" method="post">
                        <div class="mb-3">
                            <label for="exampleInputEmail1" class="form-label">Email Address</label>
                            <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Your Email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="exampleInputPassword1" class="form-label">Password</label>
                            <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Enter Your Password" name="password" required>
                        </div>
                        <button type="submit" name="login_btn" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
</body>
</html>
<?php include('includes/footer.php'); ?> 