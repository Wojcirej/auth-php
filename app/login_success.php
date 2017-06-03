<?php
session_start();
$root = $_SESSION['root'];
include $root.'/controller/AccountController.class.php';
AccountController::login();
?>
