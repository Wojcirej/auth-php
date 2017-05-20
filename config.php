<?php
session_start();
define('ROOT', dirname(__FILE__).DIRECTORY_SEPARATOR);
$_SESSION['root'] = ROOT;
$root = $_SESSION['root'];
?>
