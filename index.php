<?php 
include('include/header.php'); 
$categories = get_all_categories(false);
$movies     = get_all_movies();

if( isset($_POST['add_to_cart']) ){
    add_to_cart();
}
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <div class="d-flex align-items-center justify-content-end mb-4">
                <div>
                    <a href="cart.php" class="me-3">
                        <button type="button" class="btn btn-primary position-relative">
                            <i class="fas fa-cart-plus"></i> Cart
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger cart-count">
                                <?php if( isset($_SESSION['cart']) ): ?>
                                    <span><?= count($_SESSION['cart']); ?></span>
                                <?php else: ?>
                                    <span>0</span>
                                <?php endif; ?>
                            </span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-3 col-md-4">
            <h5 class="section-title position-relative text-uppercase mb-3">
                <span class="bg-secondary pr-3">Categories</span>
            </h5>
            <div class="bg-light p-4 mb-30">
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a class="text-dark " role="button">All Categories</a>
                </div>
                <?php foreach($categories as $category): ?>
                <div class="d-flex align-items-center justify-content-between mb-3">
                    <a class="text-dark " role="button"><?= $category->name ?></a>
                    <span class="text-dark badge border font-weight-normal rounded-0"><?= $category->movie_count ?></span>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <div class="col-lg-9 col-md-8">
            <div class="row">
                <div class="col-lg-12">
                    <h5 class="section-title position-relative text-uppercase mb-3">
                        <span class="bg-secondary pr-3">All Movies</span>
                    </h5>
                </div>
            </div>

            <div class="row pb-3">
                <?php foreach($movies as $movie): ?>
                <div class="col-lg-3 col-md-6 col-sm-6 pb-1">
                    <div class="product-item bg-light mb-4">
                        <div class="product-img position-relative overflow-hidden">
                            <img class="img-fluid w-100"
                            src="admin/views/uploads/movie/<?= $movie->image ?>" alt="<?= $movie->name ?>">
                            <div class="product-action">
                                <form class="d-inline add-cart-form" method="POST">
                                    <input type="hidden" name="movie_id" value="<?=$movie->id?>">
                                    <button type="submit" class="btn btn-outline-dark btn-square" name="add_to_cart">
                                        <i class="fa fa-shopping-cart"></i>    
                                    </button>
                                </form>
                                <a href="details.php?movie_slug=<?= $movie->slug ?>" class="btn btn-outline-dark btn-square">
                                    <i class="fa fa-list"></i>
                                </a>
                            </div>
                        </div>
                        <div class="p-3">
                            <a class="h6 text-decoration-none text-truncate" role="button">
                                <?= $movie->name ?>
                            </a>
                            <div class="my-3">
                                <h6><?= number_format($movie->price) ?> <small>MMK</small></h6>
                            </div>
                            <div class="mb-1 d-flex align-items-center">
                                <span class="badge badge-primary text-dark rounded-0" style="padding: 5px 12px;">
                                    IMDb
                                    <?= $movie->rating ?>
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>
