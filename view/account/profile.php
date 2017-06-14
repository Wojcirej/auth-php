<?php
session_start();
$root = $_SESSION['root'];
include $root.'/app/Database.class.php';
include $root.'/model/Account.class.php';
if(!isset($_SESSION['user']) || !isset($_SESSION['role'])) {
  header("Location: /index.php");
}
else {
  $user = Database::getInstance()::getUserByLogin($_SESSION['user']);
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
      Your profile
    </div>
    <div class="row">
      <div class="col-sm-3">
        <p>First name: <?= $user->getFirstName() ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <p>Last name: <?= $user->getLastName() ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <p>Email: <?= $user->getEmail() ?></p>
      </div>
    </div>
    <div class="row">
      <div class="col-sm-3">
        <a href="/view/account/edit.php" class="btn btn-default">Edit profile</a>
      </div>
    </div>
  </div>
</div>
</body>
</html>
