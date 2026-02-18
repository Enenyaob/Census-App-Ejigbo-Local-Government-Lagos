<?php
require_once('php/session.php');
require_once('php/view_details.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
    <?php include('layout/header.php');?>

    <div class="container details-container">
        <h2>Census Details for Household ID: <?php echo htmlspecialchars($row['household_id']); ?></h2>
        <div class="row">
            <div class="col-sm-4"><label>Ward:</label> <?php echo htmlspecialchars($row['ward']); ?></div>
            <div class="col-sm-4"><label>Surname:</label> <?php echo htmlspecialchars($row['surname']); ?></div>
            <div class="col-sm-4"><label>Firstname:</label> <?php echo htmlspecialchars($row['firstname']); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><label>Othername:</label> <?php echo htmlspecialchars($row['othername']); ?></div>
            <div class="col-sm-4"><label>Age:</label> <?php echo htmlspecialchars($row['current_age']); ?></div>
            <div class="col-sm-4"><label>Sex:</label> <?php echo htmlspecialchars($row['sex']); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><label>Date of Birth:</label> <?php echo htmlspecialchars($row['date_of_birth']); ?></div>
            <div class="col-sm-4"><label>Occupation:</label> <?php echo htmlspecialchars($row['occupation']); ?></div>
            <div class="col-sm-4"><label>Disability Status:</label> <?php echo htmlspecialchars($row['disability_status']); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><label>State of Birth:</label> <?php echo htmlspecialchars($row['state_of_birth']); ?></div>
            <div class="col-sm-4"><label>LGA of Birth:</label> <?php echo htmlspecialchars($row['local_government_of_birth']); ?></div>
            <div class="col-sm-4"><label>State of Origin:</label> <?php echo htmlspecialchars($row['state_of_origin']); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><label>LGA of Origin:</label> <?php echo htmlspecialchars($row['local_government_of_origin']); ?></div>
            <div class="col-sm-4"><label>NIN:</label> <?php echo htmlspecialchars($row['national_identity_number']); ?></div>
            <div class="col-sm-4"><label>Address:</label> <?php echo htmlspecialchars($row['address']); ?></div>
        </div>
        <div class="row">
            <div class="col-sm-4"><label>Date Recorded:</label> <?php echo htmlspecialchars($row['date_recorded']); ?></div>
            <div class="col-sm-4"><label>Operator:</label> <?php echo htmlspecialchars($row['operator_id']); ?></div>
        </div>

        <button class="btn btn-primary btn-print" onclick="window.print()">Print Details</button>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
