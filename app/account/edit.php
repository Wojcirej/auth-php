<?php
session_start();
$root = $_SESSION['root'];
include $root.'/controller/AccountController.class.php';
$rowCount = AccountController::edit($_SESSION['id']);
if($rowCount == 1){
  $_SESSION['success'] = "Your account has been edited successfully.";
  header('Location: /index.php');
}
else if($rowCount == 0){
  $_SESSION['error'] .= $error;
  header('Location: /view/account/edit.php');
}
?>
