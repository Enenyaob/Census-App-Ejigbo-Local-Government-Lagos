<?php
 require_once("php/session.php");
 require_once("php/secure.php");
include('php/summary_logic2.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census Summary</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
<?php include('layout/header.php');?>
<div class="container mt-5">
    <h2>Census Summary</h2>
    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Total Population</h5>
            <p class="card-text"><?php echo $total_population; ?></p>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Gender Distribution</h5>
            <ul class="list-group">
                <?php while($row = $gender_distribution_result->fetch_assoc()): ?>
                <li class="list-group-item"><?php echo $row['sex']; ?>: <?php echo $row['count']; ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Age Distribution</h5>
            <ul class="list-group">
                <?php while($row = $age_distribution_result->fetch_assoc()): ?>
                <li class="list-group-item"><?php echo $row['age_group']; ?>: <?php echo $row['count']; ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Occupation Distribution</h5>
            <ul class="list-group">
                <?php while($row = $occupation_distribution_result->fetch_assoc()): ?>
                <li class="list-group-item"><?php echo $row['occupation']; ?>: <?php echo $row['count']; ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>

    <div class="card mb-3">
        <div class="card-body">
            <h5 class="card-title">Disability Status</h5>
            <ul class="list-group">
                <?php while($row = $disability_status_result->fetch_assoc()): ?>
                <li class="list-group-item"><?php echo $row['disability_status']; ?>: <?php echo $row['count']; ?></li>
                <?php endwhile; ?>
            </ul>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
