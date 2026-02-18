<?php
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
?>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container-fluid">

        <?php if ($role == 'admin'): ?>
        <a class="navbar-brand" href="dashboard.php">Census App</a>
        <?php elseif ($role == 'field_operator'): ?>
        <a class="navbar-brand" href="operator_dashboard.php">Census App</a>   
        <?php endif; ?>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="add_census.php">Add Census Data</a>
                </li>
                <?php if ($role == 'admin'): ?>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        View Census Data
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="view_all_census.php">View details</a>
                        <li><a class="dropdown-item" href="graph">Data Visualization</a></li>
                        <li><a class="dropdown-item" href="summary">Summary</a></li>
                    </ul>
                </li>
            <?php elseif ($role == 'field_operator'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="view_census.php">View details</a>
                </li>
            <?php endif; ?>
                <?php if ($role == 'admin'): ?>
                <li class="nav-item">
                    <a class="nav-link" href="register.php">Manage Field Operators</a>
                </li>
                <?php endif; ?>
                <li class="nav-item">
                    <a class="nav-link" href="logout.php">Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>
