<?php include('include/header.php'); ?>

<div class="container-fluid">
    <div class="row px-xl-5">
        <div class="col-12">
            <nav class="breadcrumb bg-light mb-30">
                <a class="breadcrumb-item text-dark text-uppercase" href="index.php">Home</a>
                <span class="breadcrumb-item active text-uppercase">Authentication</span>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <h3 class="section-title position-relative text-uppercase mx-xl-5 mb-4">
        <span class="bg-secondary pr-3">REGISTER</span>
    </h3>
    <div class="row px-xl-5">
        <div class="col-lg-12 mb-5">
            <div class="contact-form bg-light p-30">
                <div id="success"></div>
                <form action="" method="POST">
                    <div class="control-group">
                        <input type="email" class="form-control" placeholder="Please Enter Your Name"
                        name="current_password"/>
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div class="control-group">
                        <input type="email" class="form-control" placeholder="Please Enter Your Email Address"
                        name="current_password"/>
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div class="control-group">
                        <input type="password" class="form-control" placeholder="Please Enter Your Password"
                        name="current_password"/>
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div class="control-group">
                        <input type="confirm_pwd" class="form-control" placeholder="Please Confirm Your Password"
                        name="new_password"/>
                        <small class="d-block text-danger mb-3"></small>
                    </div>
                    <div>
                        <button class="btn btn-primary py-2 px-4" type="submit">
                            REGISTER
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include('include/footer.php'); ?>