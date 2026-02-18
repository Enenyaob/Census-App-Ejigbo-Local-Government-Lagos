<div class="sidebar bg-dark text-light p-3 d-none d-lg-block">
            <h3 class="text-center">Census Dashboard</h3>
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a href="add_census.php" class="nav-link text-light"><i class="fas fa-plus-circle"></i> Add Census Data</a>
                </li>
                <li class="nav-item">
                    <a href="view_all_census.php" class="nav-link text-light"><i class="fas fa-database"></i> View All Data</a>
                </li>
                <li class="nav-item">
                    <a href="graph.php" class="nav-link text-light"><i class="fas fa-chart-bar"></i> Data Visualization</a>
                </li>
                <li class="nav-item">
                    <a href="summary.php" class="nav-link text-light"><i class="fas fa-chart-pie"></i> Summary</a>
                </li>
                <?php if ($role == 'admin'): ?>
                <li class="nav-item">
                    <a href="register.php" class="nav-link text-light"><i class="fas fa-user-cog"></i> Manage Field Operators</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a href="logout.php" class="nav-link text-light"><i class="fas fa-sign-out-alt"></i> Logout</a>
                </li>
            </ul>
        </div>