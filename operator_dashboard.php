<?php
require_once('php/session.php');
include('php/db_connect.php');

// Retrieve the logged-in field operator's details
$user_id = $_SESSION['user_id'];

// Fetch the first name of the current user
$sql = "SELECT firstname FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$firstname = $user['firstname'];

// Get the total number of census entries created by this operator
$sql_total_census = "SELECT COUNT(*) as total FROM census WHERE operator_id = $user_id";
$result_total_census = $conn->query($sql_total_census);
$total_census = $result_total_census->fetch_assoc()['total'];

// Retrieve the last five census entries created by this operator, sorted from latest to oldest
$sql_census = "SELECT * FROM census WHERE operator_id = $user_id ORDER BY date_recorded DESC LIMIT 1";
$result_census = $conn->query($sql_census);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Field Operator Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include('layout/header.php'); ?>

    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2>Welcome, <?php echo htmlspecialchars($firstname); ?>!</h2>
                <p>This is your dashboard where you can add new census data and view details of the entries you have created.</p>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-4 mb-4">
                <div class="card">
                    <div class="card-header">Total Census Entries</div>
                    <div class="card-body">
                        <h3><?php echo $total_census; ?></h3>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">Your Census Data Entries</div>
                    <div class="table-responsive">
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Household ID</th>
                                    <th>Ward</th>
                                    <th>Surname</th>
                                    <th>Firstname</th>
                                    <th>Age</th>
                                    <th>Date Recorded</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $serial_number = 1;
                                while ($row = $result_census->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo $serial_number++; ?></td>
                                        <td><?php echo htmlspecialchars($row['household_id']); ?></td>
                                        <td><?php echo htmlspecialchars($row['ward']); ?></td>
                                        <td><?php echo htmlspecialchars($row['surname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                                        <td><?php echo htmlspecialchars($row['current_age']); ?></td>
                                        <td><?php echo htmlspecialchars($row['date_recorded']); ?></td>
                                        <td><a href="view_details.php?id=<?php echo $row['census_id']; ?>" class="btn btn-primary btn-sm">View Details</a></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
