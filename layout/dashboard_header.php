    <nav class="navbar navbar-expand-lg navbar-dark bg-dark d-lg-none">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Census Dashboard</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a href="add_census.php" class="nav-link">Add Census Data</a>
                    </li>
                    <li class="nav-item">
                        <a href="view_all_census.php" class="nav-link">View All Data</a>
                    </li>
                    <li class="nav-item">
                        <a href="graph.php" class="nav-link">Data Visalization</a>
                    </li>
                    <li class="nav-item">
                        <a href="summary.php" class="nav-link">Summary</a>
                    </li>
                    <?php if ($role == 'admin'): ?>
                    <li class="nav-item">
                        <a href="register.php" class="nav-link">Manage Field Operators</a>
                    </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a href="logout.php" class="nav-link">Logout</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
