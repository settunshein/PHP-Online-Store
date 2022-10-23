<?php 
include('include/header.php'); 

if( isset($_POST['add_to_cart']) ){
    add_to_cart();
}

if( isset($_GET['movie_slug']) ){
    $movie = get_movie($_GET['movie_slug']);
}
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark" href="#">Home</a>
                <a class="breadcrumb-item text-dark" href="#">Shop</a>
                <span class="breadcrumb-item active">Shop Detail</span>
            </nav>
        </div>
    </div>
</div>

<form method="POST">
    <input type="hidden" name="movie_id" value="<?= $movie->id ?>">
    <div class="container-fluid pb-5">
        <div class="row px-xl-5">
            <div class="col-lg-3 mb-30">
                <div class="carousel-item active p-50">
                    <img src="admin/views/uploads/movie/<?=$movie->image?>" 
                    class="w-100 h-100" alt="<?= $movie->name ?>">
                </div>
            </div>

            <div class="col-lg-9 h-auto mb-30">
                <div class="h-100 bg-light p-30">
                    <h3><?= $movie->name ?></h3>

                    <div class="d-flex mb-3">
                        <div class="text-primary mr-2">
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star"></small>
                            <small class="fas fa-star-half-alt"></small>
                            <small class="far fa-star"></small>
                        </div>
                        <small class="pt-1">(99 Reviews)</small>
                    </div>

                    <h3 class="font-weight-semi-bold mb-4">
                        <?= number_format($movie->price) ?> <small style="font-size: 20px; font-weight: 700;">MMK</small>
                    </h3>

                    <p class="mb-4">
                        <?= $movie->synopsis ?>
                    </p>

                    <div class="d-flex align-items-center mb-4 pt-2">
                        <div class="input-group quantity mr-3" style="width: 130px;">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-minus">
                                    <i class="fa fa-minus"></i>
                                </button>
                            </div>
                            <input type="text" class="form-control bg-secondary border-0 text-center qty" value="1" name="qty">
                            <div class="input-group-btn">
                                <button type="button" class="btn btn-primary btn-plus">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary px-3" name="add_to_cart">
                            <i class="fa fa-shopping-cart mr-1"></i> 
                            Add To Cart
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

<?php include('include/footer.php'); ?>
