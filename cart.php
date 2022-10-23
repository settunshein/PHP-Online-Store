<?php  include('include/header.php');  ?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark text-uppercase" href="index.php">Home</a>
                <span class="breadcrumb-item active text-uppercase">Shopping Cart</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-lg-8 table-responsive mb-5">
            <table class="table table-light table-borderless table-hover text-center mb-0">
                <thead class="thead-dark">
                    <tr>
                        <th>Products</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Sub Total</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody class="align-middle">
                    <?php $total_price = 0; ?>
                    <?php if( isset($_SESSION['cart']) && count($cart) > 0 ): ?>
                    <?php foreach($cart as $key => $item): ?>
                    <tr>
                        <td class="align-middle">
                            <img class="img-fluid" style="width: 65px;" src="admin/views/uploads/movie/<?= $item['image'] ?>" alt="<?= $item['name'] ?>">
                            <p class="mt-2 mb-0"><?= $item['name']; ?></p>
                        </td>
                        <td class="align-middle">
                            <?= number_format($item['price']) ?> <small>MMK</small>
                        </td>
                        <td class="align-middle">
                            <div class="input-group quantity mx-auto" style="width: 100px;">
                                <div class="input-group-btn">
                                    <form class="d-inline" method="POST">
                                        <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-primary btn-minus" name="dec_cart">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </form>
                                </div>
                                <input type="text" class="form-control form-control-sm bg-secondary border-0 text-center qty" 
                                value="<?= $item['qty'] ?>">
                                <div class="input-group-btn">
                                    <form class="d-inline" method="POST">
                                        <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                                        <button type="submit" class="btn btn-sm btn-primary btn-plus" name="inc_cart">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </td>
                        <td class="align-middle">
                            <?= number_format($item['qty'] * $item['price']) ?> <small>MMK</small>
                        </td>
                        <td class="align-middle">
                            <form class="d-inline" method="POST">
                            <input type="hidden" name="cart_id" value="<?= $item['id'] ?>">
                                <button type="submit" class="btn btn-sm btn-danger" name="remove_cart">
                                    <i class="fa fa-times"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    <?php $total_price += ($item['price'] * $item['qty']); ?>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="5" class="text-uppercase">
                            Your Cart is Empty
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-lg-4">
            <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Cart Summary</span></h5>
            <div class="bg-light p-30 mb-5">
                <div class="border-bottom pb-2">
                    <div class="d-flex justify-content-between mb-3">
                        <h6>Sub Total</h6>
                        <h6><?= number_format($total_price) ?> <small>MMK</small></h6>
                    </div>
                    <div class="d-flex justify-content-between">
                        <h6 class="font-weight-medium">Shipping</h6>
                        <h6 class="font-weight-medium">FREE</h6>
                    </div>
                </div>
                <div class="pt-2">
                    <div class="d-flex justify-content-between mt-2">
                        <h5>Grand Total</h5>
                        <h5><?= number_format($total_price) ?> <small>MMK</small></h5>
                    </div>
                    <?php if( isset($_SESSION['cart']) && count($_SESSION['cart']) > 0 ): ?>
                        <?php if( isset($_SESSION['auth_user']) ): ?>
                            <a href="checkout.php" class="btn btn-block btn-primary font-weight-bold my-3 py-3">
                                Proceed To Checkout
                            </a>
                        <?php else: ?>
                            <button class="btn btn-block btn-primary font-weight-bold my-3 py-3" 
                            onclick="toastr.error('You Must Login to Proceed Checkout &nbsp;<i class=\'fas fa-exclamation-circle\'></i>', 'ACCESS DENIED', {
                                closeButton: true,
                                progressBar: true,
                            })">
                                Proceed To Checkout
                            </button>
                        <?php endif; ?>
                    <?php else: ?>
                        <a class="btn btn-block btn-primary font-weight-bold my-3 py-3" 
                        onclick="toastr.error('Your Cart is Empty &nbsp;<i class=\'far fa-times-circle\'></i>', 'ACCESS DENIED', {
                            closeButton: true,
                            progressBar: true,
                        })">
                            Proceed To Checkout
                        </a>
                    <?php endif; ?>
                    <a href="cart.php?clear_cart" class="btn btn-block btn-danger font-weight-bold my-3 py-2">
                        Clear Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>