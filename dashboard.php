<?php
require_once("php/session.php");
require_once("php/secure.php");
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
include 'php/dashboard.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/dashboard.css" rel="stylesheet">
</head>
<body>
    <!-- Responsive Navbar for mobile screens -->
    <?php include('layout/dashboard_header.php');?>

    <!-- Sidebar -->
    <div class="d-flex">
        <?php include('layout/sidebar.php');?>

        <!-- Main Content -->
        <div class="main-content flex-grow-1 p-4">
            <div class="container">
                <h1 class="mb-4">Welcome, <?php echo isset($_SESSION['username']) ? ucfirst($_SESSION['username']) : 'User'; ?></h1>
                <div class="row">
                    <!-- Cards for Metrics -->
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-primary">
                            <div class="card-body">
                                <h5 class="card-title">Total Census Data</h5>
                                <p class="card-text"><?php echo $totalCensusData; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-success">
                            <div class="card-body">
                                <h5 class="card-title">No of Field Operators</h5>
                                <p class="card-text"><?php echo $fieldOperators; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-warning">
                            <div class="card-body">
                                <h5 class="card-title">New Entries Today</h5>
                                <p class="card-text"><?php echo $newEntriesToday; ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 mb-4">
                        <div class="card text-white bg-danger">
                            <div class="card-body">
                                <h5 class="card-title">No. of Wards in Ejigbo</h5>
                                <p class="card-text">6</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Recent Activity and Notifications -->
                <div class="row">
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">Recent Activity</div>
                            <ul class="list-group list-group-flush">
                                <?php if (!empty($recentActivities)): ?>
                                    <?php foreach ($recentActivities as $activity): ?>
                                        <li class="list-group-item">
                                            <?php echo $activity['activity']; ?>
                                        </li>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <li class="list-group-item">No recent activities found.</li>
                                <?php endif; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-6 mb-4">
                        <div class="card">
                            <div class="card-header">Notifications</div>
                            <ul class="list-group list-group-flush">
                                <?php foreach ($notifications as $notification): ?>
                                    <li class="list-group-item"><?php echo $notification; ?></li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                </div>

                <!-- Application Information -->
                <div class="row">
                    <div class="col-md-12 mb-4">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">About the Census App</h5>
                                <p class="card-text">
                                    This application is designed to conduct a detailed census within Ejigbo, a key area of the Oshodi-Isolo Local Government in Lagos State, Nigeria. The data gathered through this platform plays a crucial role in understanding the demographic distribution of the area, facilitating better governance, resource allocation, and community development. The app enables field operators to collect and manage data efficiently, ensuring accurate records of all residents across all wards in Ejigbo.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap and FontAwesome JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>
</html>
