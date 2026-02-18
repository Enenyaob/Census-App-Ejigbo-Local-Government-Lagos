<?php
//php/dashboard.php
// Database connection
$mysqli = new mysqli("localhost", "root", "", "census_db");

// Check connection
if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);
}

// Dashboard class
class Dashboard {
    private $conn;

    public function __construct($dbConn) {
        $this->conn = $dbConn;
    }

    public function getTotalCensusData() {
        $query = "SELECT COUNT(*) as total FROM census";
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function getFieldOperators() {
        $query = "SELECT COUNT(*) as total FROM users WHERE role = 'field_operator'";
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function getNewEntriesToday() {
        $query = "SELECT COUNT(*) as total FROM census WHERE DATE(date_recorded) = CURDATE()";
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        return $data['total'];
    }

    public function getLastFieldOperator() {
        $query = "SELECT * FROM users WHERE role = 'field_operator' ORDER BY created_at DESC LIMIT 1";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function getLastCensusEntry() {
        $query = "SELECT census.*, users.username AS operator_name 
                  FROM census 
                  JOIN users ON census.operator_id = users.user_id 
                  ORDER BY census.date_recorded DESC LIMIT 1";
        $result = $this->conn->query($query);
        return $result->fetch_assoc();
    }

    public function getRecentActivities() {
        // Fetch the last 3 activities from the census and users tables
        $query = "
            SELECT CONCAT(users.username, ' added new census data on ', DATE_FORMAT(census.date_recorded, '%M %d, %Y at %h:%i %p')) AS activity
            FROM census
            JOIN users ON census.operator_id = users.user_id
            ORDER BY census.date_recorded DESC
            LIMIT 3";
        $result = $this->conn->query($query);
        return $result->fetch_all(MYSQLI_ASSOC);
    }

    public function getNotifications() {
        // Fetch the notifications
        $notifications = [];

        // New field operator registered
        $query = "SELECT CONCAT(firstname, ' ', surname) as name FROM users WHERE role = 'field_operator' ORDER BY created_at DESC LIMIT 1";
        $result = $this->conn->query($query);
        $data = $result->fetch_assoc();
        $notifications[] = 'New field operator registered: ' . $data['name'];

        // System update available (dummy notification)
        $notifications[] = 'System update available.';

        return $notifications;
    }
}

// Create Dashboard instance
$dashboard = new Dashboard($mysqli);

// Fetch data
$totalCensusData = $dashboard->getTotalCensusData();
$fieldOperators = $dashboard->getFieldOperators();
$newEntriesToday = $dashboard->getNewEntriesToday();
$lastFieldOperator = $dashboard->getLastFieldOperator();
$lastCensusEntry = $dashboard->getLastCensusEntry();
$recentActivities = $dashboard->getRecentActivities();
$notifications = $dashboard->getNotifications();

$mysqli->close();
?>
