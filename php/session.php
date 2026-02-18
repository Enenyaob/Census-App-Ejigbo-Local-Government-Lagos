<?php 
session_start();
$role = isset($_SESSION['role']) ? $_SESSION['role'] : null;
if(!isset($_SESSION['username']) || !isset($_SESSION['user_id'] )){
    header("Location:login.php");
    exit;
}

?> 
