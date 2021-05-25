<?php
header("Access-Control-Allow-Headers: *");
header("Access-Control-Allow-Origin: *");
session_start();
if (isset($_SESSION['role']) && $_SESSION['role'] == 'prof'){
    $userId = $_SESSION['id'];
    $username = $_SESSION['username'];
    $firstName = $_SESSION['firstName'];
}
else {
    header('Location: index.html');
    die();
}

?>