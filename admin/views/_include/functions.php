<?php

/*
|--------------------------------------------------------------------------
| Database Seeding
|--------------------------------------------------------------------------
*/
function insert_category_data()
{
    global $conn;

    truncate_table($conn, 'categories');

    $json = file_get_contents('assets/files/categories.json');
    $objs = json_decode($json);

    foreach( $objs as $obj ){
        $slug  = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $obj->name));
        $query = "
            INSERT INTO 
                categories (name, slug, created_at)
            VALUES
                ('$obj->name', '$slug', '$obj->created_at')
        ";
        mysqli_query($conn, $query);
    }
}

function insert_movie_data()
{
    global $conn;

    truncate_table($conn, 'movies');
    
    $json = file_get_contents('assets/files/movies.json');
    $objs = json_decode($json);
    $text = "Lorem Ipsum is simply dummy text of the printing and type setting industry. Lorem Ipsum has been the industry standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.";

    foreach( $objs as $obj ){
        $slug  = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $obj->name));
        $image = 'img_'.strtolower(preg_replace('/[^A-Za-z0-9-]+/', '_', $obj->name)).'.jpg';
        $query = "
            INSERT INTO
                movies (category_id, name, synopsis, price, rating, image, slug, created_at)
            VALUES
                ($obj->category_id, '$obj->name', '$text', 1000, '$obj->rating', '$image', '$slug', '$obj->created_at')
        ";
        mysqli_query($conn, $query);
    }
}

function insert_user_data()
{
    global $conn;

    truncate_table($conn, 'users');
    
    $json = file_get_contents('assets/files/users.json');
    $objs = json_decode($json);
    $pwd  = password_hash('password', PASSWORD_BCRYPT);

    foreach( $objs as $obj ){
        $query = "
            INSERT INTO
                users (name, email, role, password, phone, address, created_at)
            VALUES
                ('$obj->name', '$obj->email', '$obj->role', '$pwd', '$obj->phone', 'Yangon, Myanmar', '$obj->created_at')
        ";
        mysqli_query($conn, $query);
    }
}

function truncate_table($conn, $table)
{   
    $query = "TRUNCATE TABLE $table";
    mysqli_query($conn, $query);
}



/*
|--------------------------------------------------------------------------
| Utilities Functions
|--------------------------------------------------------------------------
*/
function is_active($param)
{
    if( isset($_GET['view']) ){
        return str_contains($_GET['view'], $param) ? 'active' : '';
    }else{
        return $param === 'dashboard' ? 'active' : '';
    }
}

function show_alert_message($message, $status)
{
    $status_icon = ($status == 'success') ? 'far fa-check-circle' : 'far fa-times-circle';
    $upper_case_status = strtoupper($status);
    return $_SESSION['alert'] = "<script>toastr.$status('$message &nbsp;<i class=\"$status_icon\"></i>', '$upper_case_status')</script>";
}

function redirect($param = null)
{
    is_null($param) ? header('location: admin/views/dashboard.php') : header('location: ' . $param);
    exit();
}

function redirect_back($call_exit_func = true)
{
    isset($_SERVER['HTTP_REFERER']) ? header('location:' . $_SERVER['HTTP_REFERER']) : header('location: javascript:history.back(-1)');
    $call_exit_func ? exit() : '';
}

function get_data_by_page($tbl, $limit)
{
    global $conn;
    $page   = isset($_GET['page']) ? $_GET['page'] : 1;
    $offset = ($page - 1) * $limit;
    $data   = [];
    if( $tbl == 'movies' ){
        $query  = "
            SELECT
                movies.*, categories.name AS category_name
            FROM
                movies
            LEFT JOIN
                categories
            ON
                movies.category_id = categories.id
            ORDER BY
                movies.created_at DESC
            LIMIT {$offset},{$limit}
        ";
    }elseif( $tbl == 'orders' ){
        $query = "
            SELECT
                orders.*, users.name, users.email, users.phone, users.address, users.image
            FROM
                orders
            LEFT JOIN
                users
            ON
                orders.user_id = users.id
            LIMIT {$offset}, {$limit}
        ";
    }else{
        $query  = "SELECT * FROM {$tbl} ORDER BY created_at DESC LIMIT {$offset},{$limit}";
    }

    if( $result = mysqli_query($conn, $query) ){
        while( $row = mysqli_fetch_object($result) ){
            $data[] = $row;
        }
    }

    return [ $data, $page ];
}

function get_paginator($tbl, $limit)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM $tbl");
    if( mysqli_num_rows($result) > 0 ){
        $total_records = mysqli_num_rows($result);
        $total_page = ceil($total_records / $limit);
        return $total_page;
    }
}

function get_counter($page, $limit)
{
    return $page == 1 ? 0 : ($page - 1) * $limit;
}



/*
|--------------------------------------------------------------------------
| Category Module
|--------------------------------------------------------------------------
*/
function get_all_categories($all = true)
{
    global $conn;
    $categories = [];
    
    if( $all ){
        $query = "SELECT * FROM categories";
    }else{
        $query = "
            SELECT
                categories.*, count(movies.category_id) AS movie_count
            FROM
                categories
            LEFT JOIN
                movies
            ON
                categories.id = movies.category_id
            GROUP BY
                categories.id
            HAVING
                movie_count > 0
        "; 
    }

    if( $result = mysqli_query($conn, $query) ){
        while( $row = mysqli_fetch_object($result) ){
            $categories[] = $row;
        }
    }
    return $categories;
} 

function get_category($id)
{
    global $conn;
    $result   = mysqli_query($conn, "SELECT * FROM categories WHERE id=$id");
    $category = mysqli_fetch_object($result);
    return $category;
}

function insert_category()
{
    global $conn;
    $name   = $_POST['name'];
    $slug   = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));
    $query  = "INSERT INTO categories (name, slug, created_at) VALUES ('$name', '$slug', now())";
    mysqli_query($conn, $query);
    show_alert_message('New Category Created Successfully', 'success');
    redirect('dashboard.php?view=category_index');
}

function edit_category()
{
    global $conn;
    $id     = $_POST['id'];
    $name   = $_POST['name'];
    $slug   = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $name));
    $query  = "UPDATE categories SET name='$name', slug='$slug', updated_at=now() WHERE id=$id";
    mysqli_query($conn, $query);
    show_alert_message('Category Updated Successfully', 'success');
    redirect('dashboard.php?view=category_index');
}

function delete_category()
{
    global $conn;
    mysqli_query($conn, "DELETE FROM categories WHERE id={$_POST['del_category_id']}");
    show_alert_message('Category Deleted Successfully', 'success');
    redirect('dashboard.php?view=category_index');
}



/*
|--------------------------------------------------------------------------
| Category Module
|--------------------------------------------------------------------------
*/
function get_all_movies()
{
    global $conn;
    $movies = [];
    $query  = "
        SELECT
            movies.*, categories.name AS category_name
        FROM
            movies
        LEFT JOIN
            categories
        ON
            movies.category_id = categories.id
        ORDER BY
            movies.created_at DESC
    ";

    if($result = mysqli_query($conn, $query)){
        while($row = mysqli_fetch_object($result)){
            $movies[] = $row;
        }
    }
    
    return $movies;
}

function get_movie($param)
{
    global $conn;
    $query  = isset($_GET['movie_slug']) && !isset($_POST['movie_id']) ? "SELECT * FROM movies WHERE slug='$param'" : "SELECT * FROM movies WHERE id=$param";
    $result = mysqli_query($conn, $query);
    $movie  = mysqli_fetch_object($result);
    return $movie;
}

function insert_movie()
{
    global $conn;
    $name        = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price       = $_POST['price'];
    $rating      = $_POST['rating'] ?? '';
    $casts       = $_POST['casts'] ?? '';
    $trailer     = $_POST['trailer'] ?? '';
    $synopsis    = $_POST['synopsis'];
    $slug        = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name']));

    $file_name   = uniqid(time()) . $_FILES['image']['name'];
    $file_temp   = $_FILES['image']['tmp_name'];

    if( isset($file_name) ) {
        move_uploaded_file($file_temp, "uploads/movie/$file_name");
    }

    $query  = "INSERT INTO movies (name, category_id, slug, price, rating, casts, trailer, synopsis, image, created_at) 
               VALUES ('$name', '$category_id', '$slug', '$price', '$rating', '$casts', '$trailer', '$synopsis', '$file_name', now())";
    mysqli_query($conn, $query);
    show_alert_message('New Movie Created Successfully', 'success');
    redirect('dashboard.php?view=movie_index');
}

function edit_movie()
{
    global $conn;
    $id          = $_POST['id'];
    $name        = $_POST['name'];
    $category_id = $_POST['category_id'];
    $price       = $_POST['price'];
    $rating      = $_POST['rating'] ?? '';
    $casts       = $_POST['casts'] ?? '';
    $trailer     = $_POST['trailer'] ?? '';
    $synopsis    = $_POST['synopsis'];
    $old_image   = $_POST['old_image'];
    $slug        = strtolower(preg_replace('/[^A-Za-z0-9-]+/', '-', $_POST['name']));
    
    $file_name   = $_FILES['image']['name'];
    $file_temp   = $_FILES['image']['tmp_name'];

    if( $file_name ){
        $file_name = uniqid(time()) . $file_name;
        $query     = "UPDATE movies SET category_id='$category_id', name='$name', slug='$slug', price='$price', rating='$rating', 
                      image='$file_name', casts='$casts', trailer='$trailer', synopsis='$synopsis', updated_at=now() WHERE id=$id";
        move_uploaded_file($file_temp, "uploads/movie/$file_name");
    }else{
        $query = "UPDATE movies SET category_id='$category_id', name='$name', slug='$slug', price='$price', rating='$rating', 
        image='$old_image', casts='$casts', trailer='$trailer', synopsis='$synopsis', updated_at=now() WHERE id=$id";
    }

    mysqli_query($conn, $query);
    show_alert_message('Movie Updated Successfully', 'success');
    redirect('dashboard.php?view=movie_index');
}

function delete_movie()
{
    global $conn;
    mysqli_query($conn, "DELETE FROM movies WHERE id={$_POST['del_movie_id']}");
    show_alert_message('Movie Deleted Successfully', 'success');
    redirect('dashboard.php?view=movie_index');
}



/*
|--------------------------------------------------------------------------
| User Module
|--------------------------------------------------------------------------
*/
function get_user($param)
{
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM users WHERE id=$param");
    $user   = mysqli_fetch_object($result);
    return $user;
}

function insert_user()
{
    global $conn;
    $name      = $_POST['name'];
    $email     = $_POST['email'];
    $password  = password_hash($_POST['password'], PASSWORD_BCRYPT);
    $role      = $_POST['role'];
    $phone     = $_POST['phone'] ?? '';
    $address   = $_POST['address'] ?? '';

    $file_name = $_FILES['image']['name'];
    $file_temp = $_FILES['image']['tmp_name'];

    if( $file_name ) {
        $file_name = uniqid(time()) . $file_name;
        move_uploaded_file($file_temp, "uploads/user/$file_name");
    }

    $query  = "INSERT INTO users (name, email, password, role, phone, address, image, created_at) 
               VALUES ('$name', '$email', '$password', '$role', '$phone', '$address', '$file_name', now())";
    mysqli_query($conn, $query);
    show_alert_message('New User Created Successfully', 'success');
    redirect('dashboard.php?view=user_index');
}

function edit_user()
{
    global $conn;
    $id        = $_POST['edit_user_id'];
    $name      = $_POST['name'];
    $email     = $_POST['email'];
    $role      = $_POST['role'];
    $phone     = $_POST['phone'] ?? '';
    $address   = $_POST['address'] ?? '';
    $old_image = $_POST['old_image'];

    $file_name = $_FILES['image']['name'];
    $file_temp = $_FILES['image']['tmp_name'];

    if( $file_name ) {
        $file_name = uniqid(time()) . $file_name;
        move_uploaded_file($file_temp, "uploads/user/$file_name");

        $query = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', 
                  role='$role', image='$file_name', updated_at=now() WHERE id=$id";
    }else{
        $query = "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address', 
                  role='$role', image='$old_image', updated_at=now() WHERE id=$id";
    }
    mysqli_query($conn, $query);
    show_alert_message('User Updated Successfully', 'success');
    redirect('dashboard.php?view=user_index');
}

function delete_user()
{
    global $conn;
    mysqli_query($conn, "DELETE FROM users WHERE id={$_POST['del_user_id']}");
    show_alert_message('User Deleted Successfully', 'success');
    redirect('dashboard.php?view=user_index');
}


/*
|--------------------------------------------------------------------------
| Cart Module
|--------------------------------------------------------------------------
*/
function add_to_cart()
{
    //echo '<pre>' . print_r($_POST, true) . '</pre>'; die;
    $id    = $_POST['movie_id'];
    $movie = get_movie($id);
    $movie = (array) $movie;
    if( isset($_SESSION['cart']) ){
        if( !in_array($id, array_keys($_SESSION['cart'])) ){
            $_SESSION['cart'][$id] = $movie;
            $_SESSION['cart'][$id]['qty'] = isset($_POST['qty']) ? $_POST['qty'] : 1;
            show_alert_message('Item Added to Your Cart Successfully', 'success');
        }else{
            show_alert_message('Item Already Exist in Your Cart', 'warning');
        }
    }else{
        $_SESSION['cart'][$id] = $movie;
        $_SESSION['cart'][$id]['qty'] = isset($_POST['qty']) ? $_POST['qty'] : 1;
        show_alert_message('Item Added to Your Cart Successfully', 'success');
    }
    redirect_back();
}

function increase_cart_qty()
{
    $cart_id = $_POST['cart_id'];
    $_SESSION['cart'][$cart_id]['qty'] += 1;
    redirect_back();
}

function decrease_cart_qty()
{
    $cart_id = $_POST['cart_id'];
    if( $_SESSION['cart'][$cart_id]['qty'] == 1 ){
        unset($_SESSION['cart'][$cart_id]);
    }else{
        $_SESSION['cart'][$cart_id]['qty'] -= 1;
    }
    redirect_back();
}

function remove_cart()
{
    $cart_id = $_POST['cart_id'];
    unset($_SESSION['cart'][$cart_id]);
    show_alert_message('Your Cart Item Removed Successfully', 'success');
    redirect_back();
}

function clear_cart()
{
    unset($_SESSION['cart']);
    show_alert_message('Your Cart Cleared Successfully', 'success');
    redirect_back();
}

function checkout($cart)
{
    //echo '<pre>' . print_r($_POST, true) . '</pre>'; die;
    //echo '<pre>' . print_r($cart, true) . '</pre>'; die;
    global $conn;
    $user_id   = $_POST['user_id'];
    $name      = $_POST['name'];
    $email     = $_POST['email'];
    $phone     = $_POST['phone'];
    $address   = $_POST['address'];
    $total_amt = $_POST['total_amt'];

    $file_name = uniqid(time()) . $_FILES['slip']['name'];
    $file_temp = $_FILES['slip']['tmp_name'];

    mysqli_query($conn, "UPDATE users SET name='$name', email='$email', phone='$phone', address='$address' WHERE id='$user_id'");
    mysqli_query($conn, "INSERT INTO orders (user_id, slip, total_amt, created_at) VALUES ($user_id, '$file_name', '$total_amt', now())");
    
    $last_id = mysqli_insert_id($conn);

    foreach($cart as $item){
        $query = "INSERT INTO order_items (order_id, movie_id, price, qty, created_at)
                  VALUES ($last_id, {$item['id']}, {$item['price']}, {$item['qty']}, now())";
        mysqli_query($conn, $query);
    }

    unset($_SESSION['cart']);
    move_uploaded_file($file_temp, "uploads/order/$file_name");
    
    show_alert_message('Your Order Submitted Successfully', 'success');
    redirect('index.php');
}   



/*
|--------------------------------------------------------------------------
| Order Module
|--------------------------------------------------------------------------
*/
function get_order_details($param)
{
    global $conn;
    $orders = [];
    $query  = "
        SELECT 
            orders.slip, orders.status, orders.total_amt, 
            users.name AS user_name, users.email AS user_email, users.phone AS user_phone, users.address AS user_address, 
            order_items.qty, movies.name AS movie_name, movies.price AS movie_price, movies.image AS movie_img
        FROM
            orders
        JOIN
            users
        ON
            orders.user_id = users.id
        JOIN
            order_items
        ON
            order_items.order_id = orders.id
        JOIN
            movies
        ON
            order_items.movie_id = movies.id
        WHERE
            order_items.order_id = $param 
       
    ";
    if($result = mysqli_query($conn, $query)){
        while($row = mysqli_fetch_object($result)){
            $orders[] = $row;
        }
    }
    //echo '<pre>' . print_r($orders, true) . '</pre>'; die;
    return $orders;
}

function delete_order()
{
    global $conn;
    mysqli_query($conn, "DELETE FROM orders WHERE id={$_POST['del_order_id']}");
    mysqli_query($conn, "DELETE FROM order_items WHERE order_id={$_POST['del_order_id']}");
    show_alert_message('Order Deleted Successfully', 'success');
    redirect('dashboard.php?view=order_index');
}





/*
|--------------------------------------------------------------------------
| Auth Module
|--------------------------------------------------------------------------
*/
function login()
{
    global $conn;
    $email    = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    $result   = mysqli_query($conn, "SELECT * FROM users WHERE email='$email'");
    $authUser = mysqli_fetch_object($result);

    if( $email === '' || $password === '' ){
        show_alert_message('Both Email and Password Field is Required', 'error');
        redirect_back();
    }

    if( $email !== $authUser->email ){
        show_alert_message('Invalid Email', 'error');
        redirect_back();
        exit();
    }

    if( !password_verify($password, $authUser->password) ){
        show_alert_message('Invalid Password', 'error');
        redirect_back();
    }

    $_SESSION['auth_user'] = [
        'id'   => $authUser->id,
        'name' => $authUser->name,
        'role' => $authUser->role,
    ];

    show_alert_message('LoggedIn Successfully', 'success');
    
    if( $_SESSION['auth_user']['role'] == 'admin'){
        redirect();
    }else{
        redirect_back();
    }
}

function register()
{

}

function logout()
{
    unset($_SESSION['auth_user']);
}

?>