<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Order Management</h1>
    </div>

    <div class="card mb-5">
        <div class="card-header">
            <div class=" d-flex justify-content-between align-items-center">
                <p class="mb-0 py-1">
                    Order Details
                </p>
                <a href="dashboard.php?view=order_index" class="btn btn-sm btn-outline-dark rounded-0">
                    <i class="fa fa-arrow-circle-left"></i>&nbsp;
                    B A C K
                </a>
            </div>
        </div>
        
        <div class="card-body">
            <div class="row justify-content-between align-items-center mb-4">
                <div class="col-md-6 d-flex">
                    <span class="h6">
                        <i class="fab fa-php mr-2"></i>PHP Online Store
                        <span class="d-block" style="font-size: 12px; font-weight: 400;">
                            Lorem ipsum dolor sit amet consectetur adipisicing elit.
                        </span>
                    </span>
                </div>
                
                <div class="mr-3" style="margin-left: 30px;">
                   <?php if($orders[0]->status): ?>
                    <a href="javascript:;" class="btn btn-sm btn-success rounded-0">
                        <i class="far fa-check-circle"></i>&nbsp;
                        Completed
                    </a>
                    <?php else: ?>
                    <a href="javascript:;" class="btn btn-sm btn-danger rounded-0" style="cursor: default;">
                        <i class="fas fa-spinner"></i>&nbsp;
                        In Progress
                    </a>
                    <?php endif; ?>
                </div>
            </div><!-- End of 1st row -->

            <div class="row justify-content-between mb-4">
                <div class="col-6">
                    From
                    <address class="mb-2">
                        <strong>PHP Online Store</strong><br>
                        123 Wakanda City<br>
                        Phone: +959 123123123<br>
                        Email: info@example.com
                    </address>
                </div>

                <div class="col-6 text-right">
                    <span>To</span>
                    <address class="mb-2">
                        <strong><?= $orders[0]->user_name ?></strong><br>
                        <?= $orders[0]->user_address ?><br>
                        Phone: <?= $orders[0]->user_phone ?><br>
                        Email: <?= $orders[0]->user_email ?>
                    </address>
                </div>
            </div><!-- End of 2nd Row -->

            <table class="table table-bordereless">
                <thead>
                    <tr class="text-center">
                        <th>#</th>
                        <th>Image</th>
                        <th>Movie Name</th>
                        <th>Quantity</th>
                        <th>Unit Price</th>
                        <th>Sub Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($orders as $key => $order): ?>
                    <tr class="text-center">
                        <td><?= ++$key ?></td>
                        <td>
                            <img src="uploads/movie/<?= $order->movie_img ?>" alt="<?= $order->movie_name ?>" width="50">
                        </td>
                        <td><?= $order->movie_name ?></td>
                        <td><?= $order->qty ?></td>
                        <td><?= number_format($order->movie_price) ?> <small>MMK</small></td>
                        <td><?= number_format($order->qty * $order->movie_price); ?> <small>MMK</small></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr class="text-center">
                        <th colspan="4"></th>
                        <th class="text-danger">
                            Grand Total
                        </th>
                        <th class="text-danger">
                            <?= number_format($orders[0]->total_amt); ?> <small>MMK</small>
                        </th>
                    </tr>
                </tfoot>
            </table>
        </div><!-- /.card-body -->

    </div>
</main>
