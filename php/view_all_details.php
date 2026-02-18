<?php
include('php/db_connect.php');

// Retrieve the user's role
$user_id = $_SESSION['user_id'];
$sql = "SELECT role FROM users WHERE user_id = $user_id";
$result = $conn->query($sql);
$user = $result->fetch_assoc();
$role = $user['role'];

// Pagination setup
$records_per_page = 5; // Number of records per page
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($page - 1) * $records_per_page;

// Get total number of records
$sql_total = "SELECT COUNT(*) as total FROM census";
$result_total = $conn->query($sql_total);
$total_records = $result_total->fetch_assoc()['total'];
$total_pages = ceil($total_records / $records_per_page);

// Retrieve census data with pagination
$sql = "SELECT * FROM census LIMIT $records_per_page OFFSET $offset";
$result = $conn->query($sql);
?>