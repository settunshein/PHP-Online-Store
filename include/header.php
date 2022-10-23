<?php ob_start(); ?>

<?php
if (!isset($_SESSION)) {
    session_start();
}

include('include/db.php');
include('admin/views/_include/functions.php');
include('include/header_include.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Movie Hub</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">  

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.10.0/css/all.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link href="assets/css/style.min.css" rel="stylesheet">

    <!-- toastr Alert -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Cairo:wght@400;500;600;700;800;900;1000&display=swap');
        
        body{
            font-family: 'Cairo', sans-serif;
            font-weight: 500;
        }

        #toast-container > div { 
            width: 340px !important; 
            opacity: 1 !important;
        }

        .add-cart-form{
            opacity: 0;
            transition: .4s ease;
        }

        .product-item:hover .add-cart-form{
            opacity: 1;
        }
        
        .custom-fs-13{
            font-size: 13px;
        }

        .table > tbody > tr > td {
            vertical-align: middle;
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <div class="row align-items-center bg-light py-3 px-xl-5 d-none d-lg-flex">
            <div class="col-lg-4">
                <a href="" class="text-decoration-none">
                    <span class="h3 text-uppercase text-primary bg-dark px-2 fw-bold">MOVIE</span>
                    <span class="h3 text-uppercase text-dark bg-primary px-2 ml-n1 fw-bold">HUB</span>
                </a>
            </div>
        </div>
    </div>


    <div class="container-fluid bg-dark mb-30">
        <div class="row px-xl-5">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg bg-dark navbar-dark py-3 py-lg-0 px-0">
                    <a href="" class="text-decoration-none d-block d-lg-none">
                        <span class="h1 text-uppercase text-dark bg-light px-2">MOVIE</span>
                        <span class="h1 text-uppercase text-light bg-primary px-2 ml-n1">HUB</span>
                    </a>
                    <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                        <div class="navbar-nav ml-auto py-0">
                            <a href="index.php" class="nav-item nav-link active">HOME</a>
                            <a href="cart.php" class="nav-item nav-link">CART</a>
                            
                            <?php if(isset($cart) && count($cart) > 0): ?>
                                <?php if(isset($auth_user)): ?>
                                    <a href="checkout.php" class="nav-item nav-link">CHECKOUT</a>
                                <?php else: ?>
                                    <a type="button" class="nav-item nav-link"
                                    onclick="toastr.error('You Must Login to Proceed Checkout &nbsp;<i class=\'far fa-times-circle\'></i>', 'ACCESS DENIED', {
                                        closeButton: true,
                                        progressBar: true,
                                    })">
                                        CHECKOUT
                                    </a>
                                <?php endif; ?>
                            <?php else: ?>
                            <a type="button" class="nav-item nav-link"
                            onclick="toastr.error('Your Cart is Empty &nbsp;<i class=\'far fa-times-circle\'></i>', 'ACCESS DENIED', {
                                closeButton: true,
                                progressBar: true,
                            })">
                                CHECKOUT
                            </a>
                            <?php endif; ?>

                            <?php if( isset($auth_user) ): ?>
                                <?php if($auth_user->role === 'admin'): ?>
                                <a href="admin/views/dashboard.php" class="nav-item nav-link">DASHBOARD</a>
                                <?php endif; ?>
                                <a href="" class="nav-item nav-link">ACCOUNT</a>
                                <a href="index.php?logout" class="nav-item nav-link">LOGOUT</a>
                            <?php else: ?>
                                <a href="register.php" class="nav-item nav-link">REGISTER</a>
                                <a href="login.php" class="nav-item nav-link">LOGIN</a>
                            <?php endif; ?>
                        </div>
                    </div>
                </nav>
            </div>
        </div>
    </div>