<?php
session_start();
$root = $_SESSION['root'];
include $root.'/controller/AccountController.class.php';
?>
<!DOCTYPE html>
<html lang="eng">
<head>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <meta charset="utf-8">
  <title>Login success</title>
</head>
<body>
  <?php include $root.'/includes/menu.php'; ?>
  <div class="container">
    <div class="page-header">
      Login
    </div>
    <?php
    AccountController::login();
    ?>
  </div>
</body>
</html>
