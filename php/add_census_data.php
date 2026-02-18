<?php
//php/add_census_data.php
require_once('db_connect.php');

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$success = '';
$error = [];



/* ================= CSRF CHECK ================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if (
        !isset($_POST['csrf_token'], $_SESSION['csrf_token']) ||
        !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
    ) {
        die("Invalid CSRF token");
    }

    // rotate token
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}

/* ================= VALIDATION ================= */

function validateCensusData($data) {
    $errors = [];

    /* Household */
    if (empty($data['household_id']))
        $errors[] = "Household ID is required";
    elseif (!preg_match('/^[A-Za-z0-9\-\/\s]+$/', $data['household_id']))
        $errors[] = "Invalid Household ID";

    /* Ward */
    $allowed_wards = ['Aigbaka','Ailegun','Fadu','Ifoshi','Ilamose','Oke-Afa'];
    if (!in_array($data['ward'] ?? '', $allowed_wards))
        $errors[] = "Invalid ward";

    /* Names */
    foreach (['surname','firstname'] as $f) {
        if (empty($data[$f]))
            $errors[] = ucfirst($f)." required";
        elseif (!preg_match('/^[A-Za-z\s\-\']+$/', $data[$f]))
            $errors[] = ucfirst($f)." invalid";
    }

    if (!empty($data['othername']) && !preg_match('/^[A-Za-z\s\-\']*$/', $data['othername']))
        $errors[] = "Other name invalid";

    /* Age */
    if (!isset($data['current_age']) || $data['current_age'] === '')
        $errors[] = "Age required";
    elseif ($data['current_age'] < 0 || $data['current_age'] > 120)
        $errors[] = "Age out of range";
    elseif (!is_numeric($data['current_age']))
    $errors[] = "Age must be numeric";

    /* Sex */
    $sex = ucfirst(strtolower($data['sex'] ?? ''));
    if (!in_array($sex, ['Male','Female']))
        $errors[] = "Invalid sex";

    /* DOB */
    if (empty($data['date_of_birth'])) {
        $errors[] = "DOB required";
    } else {
        $dob = DateTime::createFromFormat('Y-m-d', $data['date_of_birth']);
        if (!$dob || $dob->format('Y-m-d') !== $data['date_of_birth']) {
            $errors[] = "DOB format invalid";
        } elseif ($dob > new DateTime()) {
            $errors[] = "DOB cannot be future";
        } elseif (!empty($data['current_age'])) {
            $calc_age = $dob->diff(new DateTime())->y;
            if ($calc_age != intval($data['current_age']))
                $errors[] = "Age does not match DOB";
        }
    }

    /* Occupation */
    $allowed_occ = [
        'Agriculture','Education','Healthcare','Construction',
        'Information Technology','Manufacturing','Retail','Finance',
        'Transport','Hospitality','Government','Self-Employed',
        'Unemployed','Student','Other'
    ];
    if (!in_array($data['occupation'] ?? '', $allowed_occ))
        $errors[] = "Invalid occupation";

    if (!in_array($data['disability_status'] ?? '', ['Yes','No']))
        $errors[] = "Invalid disability status";

    /* Origin */
    foreach ([
        'state_of_birth',
        'local_government_of_birth',
        'state_of_origin',
        'local_government_of_origin'
    ] as $f) {
        if (empty($data[$f])) $errors[] = "$f required";
    }

    /* NIN */
    $age = intval($data['current_age'] ?? 0);
    if ($age >= 18 && empty($data['national_identity_number']))
        $errors[] = "NIN required for 18+";

    if (!empty($data['national_identity_number']) &&
        !preg_match('/^[0-9]{11}$/', $data['national_identity_number']))
        $errors[] = "NIN must be 11 digits";

    /* Address */
    if (empty($data['address']))
        $errors[] = "Address required";

    /* GPS */
    if (!is_numeric($data['latitude'] ?? null) || !is_numeric($data['longitude'] ?? null)) {
        $errors[] = "Valid GPS location required";
    }
    /* Accuracy */
    if (!empty($data['gps_accuracy']) && $data['gps_accuracy'] > 250) {
        $errors[] = "GPS accuracy too low — retry outdoors";
    }
    return $errors;
}

/* ================= PROCESS ================= */

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // var_dump($_POST);
    // exit;

    $validation_errors = validateCensusData($_POST);

    if (empty($validation_errors)) {

        $household_id = trim($_POST['household_id']);
        $ward = $_POST['ward'];
        $surname = trim($_POST['surname']);
        $firstname = trim($_POST['firstname']);
        $othername = trim($_POST['othername']) ?: null;
        $current_age = intval($_POST['current_age']);
        $sex = $_POST['sex'];
        $date_of_birth = $_POST['date_of_birth'];
        $occupation = $_POST['occupation'];
        $disability_status = $_POST['disability_status'];
        $state_of_birth = $_POST['state_of_birth'];
        $lga_birth = $_POST['local_government_of_birth'];
        $state_origin = $_POST['state_of_origin'];
        $lga_origin = $_POST['local_government_of_origin'];
        $nin = trim($_POST['national_identity_number']) ?: null;
        $address = trim($_POST['address']);
        $gps_accuracy = isset($_POST['gps_accuracy'])
    ? floatval($_POST['gps_accuracy'])
    : null;
        if (!isset($_SESSION['user_id'])) {
            die("Session expired — please login again");
        }
        $operator_id = $_SESSION['user_id'];
        $lat = floatval($_POST['latitude']);
        $lng = floatval($_POST['longitude']);

        $conn->begin_transaction();

        try {

            /* Duplicate person check */
            $dup = $conn->prepare(
                "SELECT census_id FROM census
                 WHERE surname=? AND firstname=? AND date_of_birth=?"
            );
            $dup->bind_param("sss", $surname, $firstname, $date_of_birth);
            $dup->execute();
            if ($dup->get_result()->num_rows > 0)
                throw new Exception("Person already exists");
            $dup->close();

            /* Insert */
            $sql = "INSERT INTO census (
                household_id, ward, surname, firstname, othername,
                current_age, sex, date_of_birth, occupation,
                disability_status, state_of_birth,
                local_government_of_birth, state_of_origin,
                local_government_of_origin, national_identity_number,
                address, operator_id, latitude, longitude, gps_accuracy,
                location_captured_at, location_verified
            ) VALUES (
                ?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,
                NOW(),1
            )";

            $stmt = $conn->prepare($sql);

            /* ✅ CORRECTED TYPE STRING */
            $stmt->bind_param(
                "sssssissssssssssiddd",
                $household_id,
                $ward,
                $surname,
                $firstname,
                $othername,
                $current_age,
                $sex,
                $date_of_birth,
                $occupation,
                $disability_status,
                $state_of_birth,
                $lga_birth,
                $state_origin,
                $lga_origin,
                $nin,
                $address,
                $operator_id,
                $lat,
                $lng,
                $gps_accuracy
            );

            if (!$stmt->execute())
                throw new Exception($stmt->error);

            $stmt->close();

            $conn->commit();
            $success = "Census record added successfully";
            $_POST = [];

        } catch (Exception $e) {
            $conn->rollback();
            $error[] = $e->getMessage();
        }

    } else {
        $error = $validation_errors;
    }
}
?>