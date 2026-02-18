<?php
require_once('php/session.php');
require_once('php/secure.php');
require_once('php/view_all_details.php');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>View Census Data</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
   <?php include('layout/header.php');?>

    <div class="container">
        <h2 class="mt-5">Census Data</h2>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>#</th> <!-- Serial Number Column -->
                        <th>Household ID</th>
                        <th>Ward</th>
                        <th>Surname</th>
                        <th>Firstname</th>
                        <th>Othername</th>
                        <th>Age</th>
                        <th>Sex</th>
                        <th>Date of Birth</th>
                        <th>Occupation</th>
                        <th>Disability Status</th>
                        <th>State of Birth</th>
                        <th>LGA of Birth</th>
                        <th>State of Origin</th>
                        <th>LGA of Origin</th>
                        <th>NIN</th>
                        <th>Address</th>
                        <th>Date Recorded</th>
                        <th>Operator</th>
                        <th>Location</th>
                        <th>Details</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Calculate starting serial number for current page
                    $serial_number = $offset + 1;

                    while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($serial_number++); ?></td> <!-- Serial Number -->
                            <td><?php echo htmlspecialchars($row['household_id']); ?></td>
                            <td><?php echo htmlspecialchars($row['ward']); ?></td>
                            <td><?php echo htmlspecialchars($row['surname']); ?></td>
                            <td><?php echo htmlspecialchars($row['firstname']); ?></td>
                            <td><?php echo htmlspecialchars($row['othername']); ?></td>
                            <td><?php echo htmlspecialchars($row['current_age']); ?></td>
                            <td><?php echo htmlspecialchars($row['sex']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_of_birth']); ?></td>
                            <td><?php echo htmlspecialchars($row['occupation']); ?></td>
                            <td><?php echo htmlspecialchars($row['disability_status']); ?></td>
                            <td><?php echo htmlspecialchars($row['state_of_birth']); ?></td>
                            <td><?php echo htmlspecialchars($row['local_government_of_birth']); ?></td>
                            <td><?php echo htmlspecialchars($row['state_of_origin']); ?></td>
                            <td><?php echo htmlspecialchars($row['local_government_of_origin']); ?></td>
                            <td><?php echo htmlspecialchars($row['national_identity_number']); ?></td>
                            <td><?php echo htmlspecialchars($row['address']); ?></td>
                            <td><?php echo htmlspecialchars($row['date_recorded']); ?></td>
                            <td><?php echo htmlspecialchars($row['operator_id']); ?></td>
                            <td>
<?php
$lat = $row['latitude'];
$lng = $row['longitude'];

if ($lat !== null && $lng !== null) {

    $url = "https://www.google.com/maps?q={$lat},{$lng}";

    echo '<a href="'.htmlspecialchars($url).'" target="_blank" rel="noopener" class="btn btn-sm btn-outline-success">
            Map
          </a>';

    if (!empty($row['gps_accuracy'])) {
        echo '<div class="small text-muted">± '
            . htmlspecialchars(round($row['gps_accuracy']))
            . ' m</div>';
    }

} else {
    echo '<span class="text-muted">No GPS</span>';
}
?>
</td>
                            <td><a href="view_details.php?id=<?php echo $row['census_id']; ?>" class="btn btn-primary btn-sm">View Details</a></td>
                        </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        </div>

        <!-- Pagination Controls -->
        <nav aria-label="Page navigation">
            <ul class="pagination">
                <?php if ($page > 1): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page - 1; ?>" aria-label="Previous">
                            <span aria-hidden="true">&laquo;</span>
                        </a>
                    </li>
                <?php endif; ?>

                <?php for ($i = 1; $i <= $total_pages; $i++): ?>
                    <li class="page-item <?php echo $i == $page ? 'active' : ''; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>

                <?php if ($page < $total_pages): ?>
                    <li class="page-item">
                        <a class="page-link" href="?page=<?php echo $page + 1; ?>" aria-label="Next">
                            <span aria-hidden="true">&raquo;</span>
                        </a>
                    </li>
                <?php endif; ?>
            </ul>
        </nav>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
