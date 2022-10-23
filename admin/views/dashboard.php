<?php 

include('_include/header.php');
include('_include/nav.php');

?>

<div class="container-fluid">
    <div class="row">
        <?php include_once('_include/sidebar.php'); ?>
            
        <?php if( isset($_GET['view']) ): ?>

            <?php include('_include/route.php'); ?>

        <?php else: ?>

            <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
                <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
                    <h1 class="h5">Dashboard</h1>
                </div>
            </main>
            
        <?php endif; ?>
    </div>
</div>

<?php include('_include/footer.php'); ?>