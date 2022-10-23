<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h5">User Management</h1>
</div>

<div class="card mb-5">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span class="table-title">User List Table</span>
        <a href="dashboard.php?view=user_create" class="btn btn-sm btn-outline-dark rounded-0">
            Create&nbsp;
            <i class="fa fa-plus"></i>
        </a>
    </div>
    
    <div class="card-body">
        <table class="table table-bordered text-center v-middle mb-0">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Photo</th>
                    <th>Username</th>
                    <th>Email</th>
                    <th>Created Date</th>
                    <th>Action</th>
                </tr>
            </thead>

            <tbody>
                <?php if(count($users) > 0): ?>
                <?php foreach($users as $key => $user): ?>
                <tr>
                    <td><?= ++$counter ?></td>
                    <td>
                        <?php if($user->image): ?>
                            <img src="uploads/user/<?=$user->image?>" alt="<?= ucwords($user->name); ?>"
                            class="rounded-circle img-fluid" width="65">
                        <?php else: ?>
                            <img src="https://ui-avatars.com/api/?background=006699&color=fff&name=<?= $user->name ?>" 
                            class="img-fluid rounded-circle align-self-center mr-3" width="65" height="65">
                        <?php endif; ?>
                    </td>
                    <td><?= $user->name ?></td>
                    <td><?= $user->email ?></td>
                    <td><?= date("M d, Y", strtotime($user->created_at)) ?></td>
                    <td>
                        <a href="dashboard.php?view=user_edit&edit_user_id=<?=$user->id?>" 
                        class="btn-sm btn btn-outline-dark rounded-0">
                            <i class="fa fa-edit"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0" 
                        data-toggle="modal" data-target="#showDeleteUserModal<?=$user->id?>">
                            <i class="fa fa-trash-alt"></i>
                        </a>
                        <?php include('user_delete.php'); ?>
                    </td>
                </tr>
                <?php endforeach; ?>
                <?php else: ?>
                <tr>
                    <td colspan="4">
                        <p class="text-danger mb-0">No User Found</p>
                    </td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
    
    <?php $total_page = get_paginator('users', 5); ?>
    <?php if( $total_page > 1 ): ?>
    <div class="card-footer">
        <nav> 
            <ul class="pagination justify-content-end mb-0">
                <li class="page-item <?= $page > 1 ? '' : 'disabled'; ?>">
                    <a class="page-link disabled" href="dashboard.php?view=user_index&page=<?= $page - 1 ?>">
                        <span>&xlarr;</span>
                    </a>
                </li>

                <?php for($i=1; $i<=$total_page; $i++): ?>
                <?php $active = $i == $page ? 'active' : ''; ?>
                <li class="page-item <?= $active ?>">
                    <a class="page-link" href="dashboard.php?view=user_index&page=<?= $i ?>"><?= $i ?></a>
                </li>
                <?php endfor; ?>

                <li class="page-item <?= $total_page > $page ? '' : 'disabled'; ?>">
                    <a class="page-link" href="dashboard.php?view=user_index&page=<?= $page + 1 ?>">
                        <span>&xrarr;</span>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <?php endif; ?>
</div>
</main>

