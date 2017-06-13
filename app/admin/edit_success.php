<?php
session_start();
$root = $_SESSION['root'];
include $root.'/controller/AccountController.class.php';
$rowCount = AccountController::editAsAdmin($_SESSION['id']);
if($rowCount == 1){
  $_SESSION['success'] = "Account ".$_POST['login']." has been edited successfully.";
}
else if($rowCount == 0){
  $_SESSION['error'] .= $error;
}
header('Location: /view/admin/user_list.php');
?>
