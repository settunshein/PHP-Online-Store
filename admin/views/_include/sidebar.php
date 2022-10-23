<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
    <div class="sidebar-sticky pt-3">
        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mb-1 text-muted">
            <span class="font-weight-bold">GENERAL</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link <?= is_active('dashboard') ?>" href="dashboard.php">
                    <span data-feather="archive"></span>
                    Dashboard
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link <?= is_active('category') ?? '' ?>" href="dashboard.php?view=category_index">
                    <span data-feather="align-right"></span>
                    Categories
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= is_active('movie') ?? '' ?>" href="dashboard.php?view=movie_index">
                    <span data-feather="video"></span>
                    Movies
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= is_active('order') ?? '' ?>" href="dashboard.php?view=order_index">
                    <span data-feather="shopping-cart"></span>
                    Orders
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link <?= is_active('user') ?? '' ?>" href="dashboard.php?view=user_index">
                    <span data-feather="users"></span>
                    Users
                </a>
            </li>
        </ul>

        <h6 class="sidebar-heading d-flex justify-content-between align-items-center px-3 mt-4 mb-1 text-muted">
            <span class="font-weight-bold">SETTINGS</span>
            <a class="d-flex align-items-center text-muted" href="#" aria-label="Add a new report">
                <span data-feather="plus-circle"></span>
            </a>
        </h6>
        <ul class="nav flex-column mb-2">
            <li class="nav-item">
                <a class="nav-link <?= is_active('profile') ?? '' ?>" href="dashboard.php?view=profile_index">
                    <span data-feather="user"></span>
                    Profile
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link <?= is_active('password') ?? '' ?>" href="dashborad.php?view=password_edit">
                    <span data-feather="lock"></span>
                    Update Password
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="dashboard.php?view=logout">
                    <span data-feather="log-out"></span>
                    Logout
                </a>
            </li>
        </ul>
    </div>
</nav>