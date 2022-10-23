<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">User Management</h1>
    </div>

    <form method="POST" enctype="multipart/form-data" id="editUserForm"> 
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-custom-title">Edit User Form</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-row">
                            <input type="hidden" name="edit_user_id" value="<?= $user->id ?>">
                            <input type="hidden" name="old_image" value="<?= $user->image ?>">
                            <div class="form-group col-md-6">
                                <label for="name">
                                    Username <span class="font-weight-bold text-danger">*</span>
                                </label>
                                <input name="name" id="name" type="text" class="form-control form-control-sm" value="<?= $user->name ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="email">
                                    Email Address <span class="font-weight-bold text-danger">*</span>
                                </label>
                                <input name="email" id="email" type="email" class="form-control form-control-sm" value="<?= $user->email ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="role" style="font-size: 12.5px;">
                                    Role Name <span class="font-weight-bold text-danger">*</span>
                                </label>
                                <select class="form-control form-control-sm" id="role" name="role">
                                    <option selected disabled class="text-muted">Select Category</option>
                                    <?php $roles = ['user', 'admin'];  ?>
                                    <?php foreach($roles as $role): ?>
                                    <option value="<?= $role ?>" <?= $user->role == $role ? 'selected' : '' ?>>
                                        <?= ucwords($role) ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="phone">
                                    Phone
                                </label>
                                <input name="phone" id="phone" type="text" class="form-control form-control-sm" value="<?= $user->phone ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="password">
                                    Password <span class="font-weight-bold text-danger">*</span>
                                </label>
                                <input name="password" id="password" type="password" class="form-control form-control-sm" disabled placeholder="* * * * * * * *">
                            </div>
                                    
                            <div class="form-group col-md-12">
                                <label for="address">
                                    Address
                                </label>
                                <textarea name="address" id="address" cols="30" rows="5" class="form-control form-control-sm"><?= $user->address ?></textarea>
                            </div>
                        </div>
                    </div><!-- End of card-body -->
                </div>
            </div><!-- End of col-md-8 -->

            <div class="col-md-4">
                <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="table-title">User Image</span>
                                <a href="dashboard.php?view=user_index" class="btn btn-sm btn-outline-dark rounded-0">
                                    <i class="fas fa-arrow-circle-left"></i>&nbsp;
                                    B A C K
                                </a>
                            </div>
                        </div><!-- End of card-header -->

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="file" class="dropify" name="image" id="image"
                                    data-default-file="<?= ($user->image) ? 'uploads/user/'.$user->image : '' ?>">
                                </div>
                            </div>
                        </div><!-- End of card-body -->

                        <div class="card-footer">
                            <button class="btn btn-sm btn-outline-dark rounded-0 float-right" type="submit" name="edit_user">
                                <i class="fa fa-edit"></i>&nbsp;
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div><!-- End of col-md-4 -->
        </div><!-- End of row -->
    </form>
</main>