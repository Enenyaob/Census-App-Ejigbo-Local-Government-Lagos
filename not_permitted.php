<?php
require_once("php/session.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Access Denied</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header bg-danger text-white">
                        <h3 class="card-title">Access Denied</h3>
                    </div>
                    <div class="card-body">
                        <p class="card-text">You do not have the necessary permissions to access this page. Please contact your administrator if you believe this is an error.</p>
                        <?php if ($role == 'admin'): ?>
                        <a href="dashboard" class="btn btn-primary">Return to Dashboard</a>
                        <?php elseif ($role == 'field_operator'): ?>
                        <a href="operator_dashboard" class="btn btn-primary">Return to Dashboard</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
