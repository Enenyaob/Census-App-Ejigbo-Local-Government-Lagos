<?php
require_once('php/session.php');
 require_once("php/secure.php");
include('php/summary_logic.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Census Data Visualization</title>
    <link href="css/style.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include('layout/header.php');?>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Census Summary</h1>
        <div class="row">
            <div class="col-md-6 mb-4">
    <div class="card">
        <div class="card-header">
            <h5>Total Population</h5>
        </div>
        <div class="card-body chart-container">
            <h3 class="max-auto"><?php echo "Population of Ejigbo: " . $total_population; ?></h3>
            <ul class="list-group mt-3">
                <?php foreach ($ward_data as $ward) : ?>
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <?php echo $ward['ward']; ?>
                        <span class="badge bg-primary rounded-pill"><?php echo $ward['count']; ?></span>
                    </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</div>


            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Gender Distribution</h5>
                    </div>
                    <div class="card-body chart-container">
                        <canvas id="genderChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Age Distribution</h5>
                    </div>
                    <div class="card-body chart-container">
                        <canvas id="ageChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-12 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Occupation Distribution</h5>
                    </div>
                    <div class="card-body chart-container">
                        <canvas id="occupationChart"></canvas>
                    </div>
                </div>
            </div>

            <div class="col-md-6 mb-4">
                <div class="card text-center">
                    <div class="card-header">
                        <h5>Disability Status</h5>
                    </div>
                    <div class="card-body chart-container">
                        <canvas id="disabilityChart"></canvas>
                    </div>
                </div>
            </div>

            <!-- Ward Distribution -->
            <div class="col-md-6 mb-4">
                <div class="card">
                    <div class="card-header">
                        <h5>Ward Distribution</h5>
                    </div>
                    <div class="card-body chart-container">
                        <canvas id="wardChart"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        // Prepare the data from PHP for use in JavaScript
        const genderData = <?php echo json_encode($gender_data); ?>;
        const ageData = <?php echo json_encode($age_data); ?>;
        const occupationData = <?php echo json_encode($occupation_data); ?>;
        const disabilityData = <?php echo json_encode($disability_data); ?>;
        const wardData = <?php echo json_encode($ward_data); ?>;

        // Gender Distribution Chart
        const genderCtx = document.getElementById('genderChart').getContext('2d');
        const genderChart = new Chart(genderCtx, {
            type: 'pie',
            data: {
                labels: genderData.map(item => item.sex),
                datasets: [{
                    data: genderData.map(item => item.count),
                    backgroundColor: ['#007bff', '#dc3545'],
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });

        // Age Distribution Chart
        const ageCtx = document.getElementById('ageChart').getContext('2d');
        const ageChart = new Chart(ageCtx, {
            type: 'bar',
            data: {
                labels: ageData.map(item => item.age_group),
                datasets: [{
                    label: 'Age Groups',
                    data: ageData.map(item => item.count),
                    backgroundColor: '#28a745',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        // Occupation Distribution Chart
   const occupationCtx = document.getElementById('occupationChart').getContext('2d');
const occupationChart = new Chart(occupationCtx, {
    type: 'bar',
    data: {
        labels: occupationData.map(item => item.occupation),
        datasets: [{
            label: 'Occupations',
            data: occupationData.map(item => item.count),
            backgroundColor: [
                '#ffc107', // Agriculture - Yellow
                '#6c757d', // Education - Gray
                '#007bff', // Healthcare - Blue
                '#28a745', // Construction - Green
                '#17a2b8', // Information Technology - Cyan
                '#dc3545', // Manufacturing - Red
                '#fd7e14', // Retail - Orange
                '#343a40', // Finance - Dark Gray
                '#6610f2', // Transport - Purple
                '#e83e8c', // Hospitality - Pink
                '#20c997', // Government - Light Green
                '#ff5733', // Self-Employed - Light Red
                '#ffc0cb', // Unemployed - Light Pink
                '#8a2be2', // Student - Blue Violet
                '#ff69b4', // Other - Hot Pink
            ],
        }]
    },
    options: {
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


        // Disability Status Chart
        const disabilityCtx = document.getElementById('disabilityChart').getContext('2d');
        const disabilityChart = new Chart(disabilityCtx, {
            type: 'pie',
            data: {
                labels: disabilityData.map(item => item.disability_status),
                datasets: [{
                    data: disabilityData.map(item => item.count),
                    backgroundColor: ['#ffc107', '#6c757d'],
                }]
            },
            options: {
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                }
            }
        });

         // Ward Distribution Chart
        const wardCtx = document.getElementById('wardChart').getContext('2d');
        const wardChart = new Chart(wardCtx, {
            type: 'bar',
            data: {
                labels: wardData.map(item => item.ward),
                datasets: [{
                    label: 'Wards',
                    data: wardData.map(item => item.count),
                    backgroundColor: '#fd7e14',
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        display: true,
                        position: 'top',
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
