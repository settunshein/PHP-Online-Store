<?php

$view = $_GET['view'];

switch($view){
    /* User Module */
    case 'user_index':
        $data    = get_data_by_page('users', 5);
        $users   = $data[0];
        $page    = $data[1];
        $counter = get_counter($page, 5);
        isset($_POST['del_user_id']) ? delete_user() : '';
        include('user/user_index.php');
        break;
    
    case 'user_create':
        isset($_POST['insert_user']) ? insert_user() : '';
        include('user/user_create.php');
        break;

    case 'user_edit':
        $user = get_user($_GET['edit_user_id']);
        isset($_POST['edit_user']) ? edit_user() : '';
        include('user/user_edit.php');
        break;
        

    /* Category Routes */
    case 'category_index':
        $data       = get_data_by_page('categories', 5);
        $categories = $data[0];
        $page       = $data[1];
        $counter    = get_counter($page, 5);
        isset($_POST['del_category_id']) ? delete_category() : '';
        include('category/category_index.php');
        break;
    
    case 'category_create':
        isset($_POST['insert_category']) ? insert_category() : '';
        include('category/category_create.php');
        break;
    
    case 'category_edit':
        $category = get_category($_GET['edit_category_id']);
        isset($_POST['edit_category']) ? edit_category() : '';
        include('category/category_edit.php');
        break;

    case 'category_delete':
        isset($_POST['del_category_id']) ? delete_category() : '';
        break;
        
    /* Movie Routes */
    case 'movie_index':
        $data    = get_data_by_page('movies', 10);
        $movies  = $data[0];
        $page    = $data[1];
        $counter = get_counter($page, 10);
        isset($_POST['del_movie_id']) ? delete_movie() : '';
        include('movie/movie_index.php');
        break;

    case 'movie_details':
        $movie = isset($_GET['movie_slug']) ? get_movie($_GET['movie_slug']) : '';
        include('movie/movie_details.php');
        break;

    case 'movie_create':
        $categories = get_all_categories();
        isset($_POST['insert_movie']) ? insert_movie() : '';
        include('movie/movie_create.php');
        break;

    case 'movie_edit':
        $categories = get_all_categories();
        $movie      = get_movie($_GET['edit_movie_id']);
        isset($_POST['edit_movie']) ? edit_movie() : '';
        include('movie/movie_edit.php');
        break;

    /* Order Routes */
    case 'order_index':
        $data    = get_data_by_page('orders', 10);
        $orders  = $data[0];
        $page    = $data[1];
        $counter = get_counter($page, 10);
        isset($_POST['del_order_id']) ? delete_order() : '';
        include('order/order_index.php');
        break;

    case 'order_details':
        $orders = get_order_details($_GET['order_id']);
        include('order/order_details.php');
        break;
    
    /* Auth Routes */
    case 'logout';
        logout();
        show_alert_message('Logged Out Successfully', 'success');
        redirect('../../index.php');
        break;
}
