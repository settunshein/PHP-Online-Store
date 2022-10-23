<?php  
include('include/header.php');  
$user = get_user($auth_user->id);
?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark text-uppercase" href="index.php">Home</a>
                <a class="breadcrumb-item text-dark text-uppercase" href="cart.php">Cart</a>
                <span class="breadcrumb-item active text-uppercase">Checkout</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <form method="POST" enctype="multipart/form-data" class="d-inline">
        <div class="row px-xl-5">
            <div class="col-lg-6 mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">User Information</span></h5>
                <div class="contact-form bg-light p-30">
                    <input type="hidden" name="user_id" value="<?= $user->id ?>">
                    <div class="control-group">
                        <input type="text" class="form-control" placeholder="Please Enter Your Name"
                        name="name" value="<?= $user->name ?? '' ?>">
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" placeholder="Please Enter Your Email Address"
                        name="email" value="<?= $user->email ?? '' ?>">
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" placeholder="Please Enter Your Address"
                        name="address" value="<?= $user->address ?? '' ?>">
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div class="control-group">
                        <input type="text" class="form-control" placeholder="Please Enter Your Phone Number"
                        name="phone" value="<?= $user->phone ?? '' ?>">
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div class="control-group">
                        <div class="input-group">
                            <label class="input-group-text rounded-0" for="slip">Transaction Screenshot</label>
                            <input type="file" class="form-control" id="slip" name="slip">
                        </div>
                        <div class="text-danger">
                            ( <small class="mr-2"><i class="far fa-credit-card"></i>&nbsp;XYZ PAY - 09 123 123 123</small>
                            <small><i class="far fa-credit-card"></i>&nbsp;JBL PAY - 09 117 228 339</small> )
                        </div>
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div>
                        <button type="submit" class="btn btn-primary py-2 px-4 text-uppercase" name="checkout">
                            Checkout
                        </button>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 mb-5">
                <h5 class="section-title position-relative text-uppercase mb-3"><span class="bg-secondary pr-3">Order Summary</span></h5>
                <div class="bg-light p-30 mb-5">
                    <div class="table-responsive">
                        <table class="table table-hover text-center mb-0 table-borderless">
                            <thead class="bg-secondary">
                                <tr style="border-bottom: 0;">
                                    <th>Item</th>
                                    <th>Unit Price</th>
                                    <th>Qty</th>
                                    <th>Sub Total</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $total_price = 0; ?>
                                <?php foreach($cart as $key => $item): ?>
                                <tr style="border-bottom: 0;">
                                    <td>
                                        <img class="img-fluid" src="admin/views/uploads/movie/<?= $item['image'] ?>" 
                                        style="width: 50px;" alt="<?= $item['name'] ?>">
                                        <p class="mt-2 mb-0 custom-fs-13"><?= $item['name']; ?></p>
                                    </td>
                                    <td><?= number_format($item['price']) ?> <small>MMK</small></td>
                                    <td><?= $item['qty'] ?></td>
                                    <td><?= number_format($item['price'] * $item['qty']) ?> <small>MMK</small></td>
                                </tr>
                                <?php $total_price += ($item['price'] * $item['qty']); ?>
                                <?php endforeach; ?>
                                <input type="hidden" name="total_amt" value="<?= $total_price ?>">
                            </tbody>
                            <tfoot>
                                <tr style="border-bottom: 4px double #CED4DA; border-top: 4px double #CED4DA;">
                                    <td colspan="2"></td>
                                    <td class="fw-bold text-primary">Grand Total</td>
                                    <td class="fw-bold text-primary">
                                        <?= number_format($total_price) ?> 
                                        <small class="fw-bold">MMK</small>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>

<?php include('include/footer.php'); ?>