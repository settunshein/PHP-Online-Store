<main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-md-4">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h5">Movie Management</h1>
    </div>

    <form method="POST" enctype="multipart/form-data" id="editMovieForm"> 
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="card-custom-title">Edit Movie Form</span>
                        </div>
                    </div>

                    <div class="card-body">
                        <div class="form-row">
                            <input type="hidden" name="id" value="<?= $movie->id ?>">
                            <input type="hidden" name="old_image" value="<?= $movie->image ?>">
                            <div class="form-group col-md-6">
                                <label for="name">
                                    Movie Name <span class="font-weight-bold text-danger">*</span>
                                </label>
                                <input name="name" id="name" type="text" class="form-control form-control-sm" value="<?= $movie->name ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="category_id" style="font-size: 12.5px;">
                                    Category Name <span class="font-weight-bold text-danger">*</span>
                                </label>
                                <select class="form-control form-control-sm" id="category_id" name="category_id">
                                    <option selected disabled class="text-muted">Select Category</option>
                                    <?php foreach($categories as $category): ?>
                                    <option value="<?= $category->id ?>"
                                    <?= $category->id == $movie->category_id ? 'selected' : '' ?>>
                                        <?= $category->name ?>
                                    </option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label for="price">
                                    Price <span class="font-weight-bold text-danger">*</span>
                                </label>
                                <input name="price" id="price" type="number" class="form-control form-control-sm" value="<?= $movie->price ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="rating">
                                    Rating
                                </label>
                                <input name="rating" id="rating" type="text" class="form-control form-control-sm" value="<?= $movie->rating ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="casts">
                                    Cast
                                </label>
                                <input name="casts" id="casts" type="text" class="form-control form-control-sm" value="<?= $movie->casts ?>">
                            </div>
                                    
                            <div class="form-group col-md-12">
                                <label for="trailer">
                                    Trailer Link
                                </label>
                                <input name="trailer" id="trailer" type="text" class="form-control form-control-sm" value="<?= $movie->trailer ?>">
                            </div>

                            <div class="form-group col-md-12">
                                <label for="synopsis">
                                    Synopsis <span class="font-weight-bold text-danger">*</span>
                                </label>
                                <textarea name="synopsis" id="synopsis" cols="30" rows="8" class="form-control form-control-sm"><?= $movie->synopsis ?></textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <span class="table-title">Movie Image</span>
                                <a href="dashboard.php?view=movie_index" class="btn btn-sm btn-outline-dark rounded-0">
                                    <i class="fas fa-arrow-circle-left"></i>&nbsp;
                                    B A C K
                                </a>
                            </div>
                        </div>

                        <div class="card-body">
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <input type="file" class="dropify" name="image" id="image"
                                    data-default-file="<?= isset($movie->image) ? 'uploads/movie/'.$movie->image : '' ?>">
                                </div>
                            </div>
                        </div>

                        <div class="card-footer">
                            <button class="btn btn-sm btn-outline-dark rounded-0 float-right" type="submit" name="edit_movie">
                                <i class="fa fa-edit"></i>&nbsp;
                                Update
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</main>