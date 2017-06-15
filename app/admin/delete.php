<?php
session_start();
$root = $_SESSION['root'];
include $root.'/controller/AccountController.class.php';
$rowCount = AccountController::deleteAsAdmin($_SESSION['id']);
if($rowCount == 1){
  $_SESSION['success'] = "Account has been deleted successfully.";
}
else if($rowCount == 0){
  $_SESSION['error'] .= $error;
}
header('Location: /view/admin/user_list.php');
?>
