<?php
//php/register.php
include('php/db_connect.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Trim and convert all inputs to uppercase
    $username = strtoupper(trim($_POST['username']));
    $surname = strtoupper(trim($_POST['surname']));
    $firstname = strtoupper(trim($_POST['firstname']));
    $othername = strtoupper(trim($_POST['othername']));
    $password = $_POST['password'];
    $password2 = $_POST['password2'];
    $email = strtoupper(trim($_POST['email']));
    $sex = strtoupper(trim($_POST['sex']));
    $date_of_birth = trim($_POST['date_of_birth']);
    $address = strtoupper(trim($_POST['address']));
    $state_of_origin = strtoupper(trim($_POST['state_of_origin']));
    $local_government_of_origin = strtoupper(trim($_POST['local_government_of_origin']));
    $role = 'field_operator';

    // Check if all fields are filled
    if (empty($username) || empty($surname) || empty($firstname) || empty($password) || empty($password2) ||
        empty($email) || empty($sex) || empty($date_of_birth) || empty($address) ||
        empty($state_of_origin) || empty($local_government_of_origin)) {
        $error = "All fields are required.";
    } elseif ($password !== $password2) {
        $error = "Passwords do not match.";
    } else {
        // Prepare statements to prevent SQL Injection
        $stmt = $conn->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->bind_param("ss", $username, $email);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows > 0) {
            $error = "Username or email already exists.";
        } else {
            // Hash the password
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Insert into the database
            $stmt = $conn->prepare("INSERT INTO users (username, surname, firstname, othername, password, email, sex, date_of_birth, address, state_of_origin, local_government_of_origin, role)
                                    VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssssssssssss", $username, $surname, $firstname, $othername, $hashed_password, $email, $sex, $date_of_birth, $address, $state_of_origin, $local_government_of_origin, $role);

            if ($stmt->execute()) {
                $success = "Field operator registered successfully";
            } else {
                $error = "Error: " . $stmt->error;
            }
        }

        $stmt->close();
    }
}
?>
