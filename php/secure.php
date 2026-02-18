<?php
//php/secure.php
// Check if the user is logged in and is an admin
$user_role = strtoupper($_SESSION['role']);
if (!isset($_SESSION['user_id']) || $user_role  !== 'ADMIN') {
    header("Location: not_permitted.php");
    exit();
}


?>
