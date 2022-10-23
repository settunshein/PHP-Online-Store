<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">

    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Movie Management</h1>
    </div>

    <div class="card mb-5">
        <div class="card-header d-flex justify-content-between align-items-center">
            <span class="table-title">Movie List Table</span>
            <a href="dashboard.php?view=movie_create" class="btn btn-sm btn-outline-dark rounded-0">
                Create&nbsp;
                <i class="fa fa-plus"></i>
            </a>
        </div>
        
        <div class="card-body">
            <table class="table table-bordered text-center v-middle mb-0">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Poster</th>
                        <th>Movie Name</th>
                        <th width="15%">Category</th>
                        <th>Price</th>
                        <th width="15%">Created Date</th>
                        <th width="15%">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <?php if(count($movies) > 0): ?>
                    <?php foreach($movies as $key => $movie): ?>
                    <tr>
                        <td><?= ++$counter ?></td>
                        <td><img src="uploads/movie/<?= $movie->image ?>" alt="<?= $movie->name ?>" width="60"></td>
                        <td><?= $movie->name ?></td>
                        <td><?= $movie->category_name ?></td>
                        <td><?= number_format($movie->price) ?> <small>MMK</small></td>
                        <td><?= date("M d, Y", strtotime($movie->created_at)) ?></td>
                        <td>
                            <a href="dashboard.php?view=movie_details&movie_slug=<?=$movie->slug?>" 
                            class="btn-sm btn btn-outline-dark rounded-0">
                                <i class="fa fa-list"></i>
                            </a>

                            <a href="dashboard.php?view=movie_edit&edit_movie_id=<?=$movie->id?>" 
                            class="btn-sm btn btn-outline-dark rounded-0">
                                <i class="fa fa-edit"></i>
                            </a>

                            <a href="javascript:;" class="btn btn-sm btn-outline-dark rounded-0" 
                            data-toggle="modal" data-target="#showDeleteMovieModal<?=$movie->id?>">
                                <i class="fa fa-trash-alt"></i>
                            </a>
                            <?php include('movie_delete.php'); ?>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                    <?php else: ?>
                    <tr>
                        <td colspan="7">
                            <p class="text-danger mb-0">No Movie Found</p>
                        </td>
                    </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

        <?php $total_page = get_paginator('movies', 10); ?>
        <?php if( $total_page > 1 ): ?>
        <div class="card-footer">
            <nav> 
                <ul class="pagination justify-content-end mb-0">
                    <li class="page-item <?= $page > 1 ? '' : 'disabled'; ?>">
                        <a class="page-link disabled" href="dashboard.php?view=movie_index&page=<?= $page - 1 ?>">
                            <span>&xlarr;</span>
                        </a>
                    </li>

                    <?php for($i=1; $i<=$total_page; $i++): ?>
                    <?php $active = $i == $page ? 'active' : ''; ?>
                    <li class="page-item <?= $active ?>">
                        <a class="page-link" href="dashboard.php?view=movie_index&page=<?= $i ?>"><?= $i ?></a>
                    </li>
                    <?php endfor; ?>

                    <li class="page-item <?= $total_page > $page ? '' : 'disabled'; ?>">
                        <a class="page-link" href="dashboard.php?view=movie_index&page=<?= $page + 1 ?>">
                            <span>&xrarr;</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
        <?php endif; ?>
    </div>

</main>
