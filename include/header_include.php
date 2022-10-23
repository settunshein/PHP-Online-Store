<?php

isset($_SESSION['auth_user']) ? $auth_user = (object) $_SESSION['auth_user'] : '';

/* Cart Functionality */
isset($_SESSION['cart']) ? $cart = $_SESSION['cart'] : '';
isset($_POST['add_to_cart']) ? add_to_cart() : '';
isset($_POST['inc_cart']) ? increase_cart_qty() : '';
isset($_POST['dec_cart']) ? decrease_cart_qty() : '';
isset($_GET['clear_cart']) ? clear_cart() : '';
isset($_POST['remove_cart']) ? remove_cart() : '';

/* Checkout */
isset($_POST['checkout']) ? checkout($cart) : '';

/* Authentication */
isset($_POST['login']) ? login() : '';

if( isset($_GET['logout']) ){
    logout();
    show_alert_message('Logged Out Successfully', 'success');
    redirect('index.php');
}