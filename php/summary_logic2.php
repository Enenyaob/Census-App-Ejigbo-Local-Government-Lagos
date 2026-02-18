<?php
include('db_connect.php');

// Total number of people counted
$total_population_query = "SELECT COUNT(*) AS total_population FROM census";
$total_population_result = $conn->query($total_population_query);
$total_population = $total_population_result->fetch_assoc()['total_population'];

// Gender distribution
$gender_distribution_query = "SELECT sex, COUNT(*) AS count FROM census GROUP BY sex";
$gender_distribution_result = $conn->query($gender_distribution_query);

// Age distribution (e.g., children, youth, adults, seniors)
$age_distribution_query = "
    SELECT 
        CASE 
            WHEN current_age BETWEEN 0 AND 14 THEN 'Children (0-14)'
            WHEN current_age BETWEEN 15 AND 24 THEN 'Youth (15-24)'
            WHEN current_age BETWEEN 25 AND 64 THEN 'Adults (25-64)'
            WHEN current_age >= 65 THEN 'Seniors (65+)'
        END AS age_group, 
        COUNT(*) AS count 
    FROM census 
    GROUP BY age_group";
$age_distribution_result = $conn->query($age_distribution_query);

// Occupation distribution
$occupation_distribution_query = "SELECT occupation, COUNT(*) AS count FROM census GROUP BY occupation";
$occupation_distribution_result = $conn->query($occupation_distribution_query);

// Disability status
$disability_status_query = "SELECT disability_status, COUNT(*) AS count FROM census GROUP BY disability_status";
$disability_status_result = $conn->query($disability_status_query);
?>
