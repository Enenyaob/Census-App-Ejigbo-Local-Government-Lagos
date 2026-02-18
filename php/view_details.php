<?php
include('php/db_connect.php');
// Get the household ID from the URL
$household_id = isset($_GET['id']) ? $_GET['id'] : null;

if ($household_id) {
    // Fetch the details from the database
    $sql = "SELECT * FROM census WHERE census_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $household_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
    } else {
        echo "<div class='alert alert-warning'>No records found for the given Household ID.</div>";
        exit;
    }
} else {
    echo "<div class='alert alert-danger'>Invalid or missing Household ID. Please check and try again.</div>";
    exit;
}
?>