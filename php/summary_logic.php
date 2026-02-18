<?php
include('db_connect.php');

// Total number of people counted
$total_population_query = "SELECT COUNT(*) AS total_population FROM census";
$total_population_result = $conn->query($total_population_query);
$total_population = $total_population_result->fetch_assoc()['total_population'];

// Gender distribution
$gender_distribution_query = "SELECT sex, COUNT(*) AS count FROM census GROUP BY sex";
$gender_distribution_result = $conn->query($gender_distribution_query);
$gender_data = [];
while ($row = $gender_distribution_result->fetch_assoc()) {
    $gender_data[] = ['sex' => $row['sex'], 'count' => $row['count']];
}

// Age distribution
$age_distribution_query = "
    SELECT 
        CASE 
            WHEN current_age BETWEEN 0 AND 4 THEN 'Infants and toddlers (0-4)'
            WHEN current_age BETWEEN 5 AND 9 THEN 'Early childhood (5-9)'
            WHEN current_age BETWEEN 10 AND 14 THEN 'Late childhood (10-14)'
            WHEN current_age BETWEEN 15 AND 19 THEN 'Adolescents (15-19)'
            WHEN current_age BETWEEN 20 AND 24 THEN 'Young adults (20-24)'
            WHEN current_age BETWEEN 25 AND 29 THEN 'Late twenties (25-29)'
            WHEN current_age BETWEEN 30 AND 34 THEN 'Early thirties (30-34)'
            WHEN current_age BETWEEN 35 AND 39 THEN 'Late thirties (35-39)'
            WHEN current_age BETWEEN 40 AND 44 THEN 'Early forties (40-44)'
            WHEN current_age BETWEEN 45 AND 49 THEN 'Late forties (45-49)'
            WHEN current_age BETWEEN 50 AND 54 THEN 'Early fifties (50-54)'
            WHEN current_age BETWEEN 55 AND 59 THEN 'Late fifties (55-59)'
            WHEN current_age BETWEEN 60 AND 64 THEN 'Early sixties (60-64)'
            WHEN current_age BETWEEN 65 AND 69 THEN 'Late sixties (65-69)'
            WHEN current_age BETWEEN 70 AND 74 THEN 'Early seventies (70-74)'
            WHEN current_age BETWEEN 75 AND 79 THEN 'Late seventies (75-79)'
            ELSE 'Elderly (80+)' 
        END AS age_group, 
        COUNT(*) AS count 
    FROM census 
    GROUP BY age_group";

$age_distribution_result = $conn->query($age_distribution_query);
$age_data = [];
while ($row = $age_distribution_result->fetch_assoc()) {
    $age_data[] = ['age_group' => $row['age_group'], 'count' => $row['count']];
}

// Occupation distribution
$occupation_distribution_query = "SELECT occupation, COUNT(*) AS count FROM census GROUP BY occupation";
$occupation_distribution_result = $conn->query($occupation_distribution_query);
$occupation_data = [];
while ($row = $occupation_distribution_result->fetch_assoc()) {
    $occupation_data[] = ['occupation' => $row['occupation'], 'count' => $row['count']];
}

// Disability status
$disability_status_query = "SELECT disability_status, COUNT(*) AS count FROM census GROUP BY disability_status";
$disability_status_result = $conn->query($disability_status_query);
$disability_data = [];
while ($row = $disability_status_result->fetch_assoc()) {
    $disability_data[] = ['disability_status' => $row['disability_status'], 'count' => $row['count']];
}

// Ward distribution
$ward_distribution_query = "SELECT ward, COUNT(*) AS count FROM census GROUP BY ward";
$ward_distribution_result = $conn->query($ward_distribution_query);
$ward_data = [];
while ($row = $ward_distribution_result->fetch_assoc()) {
    $ward_data[] = ['ward' => $row['ward'], 'count' => $row['count']];
}
?>
