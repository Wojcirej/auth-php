<?php
session_start();
$root = $_SESSION['root'];
include $root.'/app/Database.class.php';
include $root.'/model/Account.class.php';
if(!isset($_SESSION['user']) || ( !isset($_SESSION['role']) || $_SESSION['role'] != 'admin')) {
  header("Location: /index.php");
}
else {
  $user = Database::getInstance()::getUserById($_GET['id']);
  $_SESSION['id'] = $_GET['id'];
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <meta charset="utf-8">
  <title>Profile</title>
</head>
<body>
  <?php include $root.'includes/menu.php'; ?>
  <div class="container">
    <div class="page-header">
      Deleting user
    </div>
    <div class="row">
      <div class="col-sm-12">
        <p class="alert alert-danger">Are you sure you want delete account <?=$user->getLogin()?>?</p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-12">
        <div class="btn-group">
          <a href="/app/admin/delete.php" class="btn btn-danger">Yes</a>
          <a href="/view/admin/user_list.php" class="btn btn-default">No</a>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
