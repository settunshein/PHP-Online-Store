<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Order Management</h1>
    </div>

    <div class="card mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="table-title">Order List Table</span>
        </div>
        
        <div class="card-body">
            <table class="table table-bordered text-center v-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Customer Name</th>
                        <th>Customer Email</th>
                        <th>Customer Phone</th>
                        <th>Customer Address</th>
                        <th>Total Amount</th>
                        <th>Ordered Date</th>
                        <th>Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(count($orders) > 0): ?>
                    <?php foreach($orders as $key => $order): ?>
                    <tr>
                        <td><?= ++$counter ?></td>
                        <td><?= $order->name ?></td>
                        <td><?= $order->email ?></td>
                        <td><?= $order->phone ?></td>
                        <td><?= $order->address ?></td>
                        <td>
                            <?= number_format($order->total_amt) ?>
                            <small>MMK</small>
                        </td>
                        <td><?= date("M d, Y", strtotime($order->created_at)) ?></td>
                        <td>
                            <a href="dashboard.php?view=order_details&order_id=<?=$order->id?>" 
                            class="btn-sm btn btn-outline-dark rounded-0">
                                <i class="fa fa-list"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0" 
                            data-toggle="modal" data-target="#showDeleteOrderModal<?=$order->id?>">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                            <?php include('order_delete.php'); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="8">
                            <p class="text-danger mb-0">No Order Found</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
                    
        <?php $total_page = get_paginator('orders', 10); ?>
        <?php if( $total_page > 1 ): ?>
        <div class="card-footer">
            <nav> 
                <ul class="pagination justify-content-end mb-0">
                    <li class="page-item <?= $page > 1 ? '' : 'disabled'; ?>">
                        <a class="page-link disabled" href="dashboard.php?view=order_index&page=<?= $page - 1 ?>">
                            <span>&xlarr;</span>
                        </a>
                    </li>

                    <?php for($i=1; $i<=$total_page; $i++): ?>
                    <?php $active = $i == $page ? 'active' : ''; ?>
                    <li class="page-item <?= $active ?>">
                        <a class="page-link" href="dashboard.php?view=order_index&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $total_page > $page ? '' : 'disabled'; ?>">
                        <a class="page-link" href="dashboard.php?view=order_index&page=<?= $page + 1 ?>">
                            <span>&xrarr;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>

    </div>
</main>
