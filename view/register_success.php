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
  <title>Registration</title>
</head>
<body>
  <?php include $root.'/includes/menu.php'; ?>
  <div class="container">
    <div class="page-header">
      Registration process
    </div>
    <?php
    $rowCount = AccountController::register();
    if($rowCount == 1){
    ?>
      <div class="alert alert-success" role="alert">
        Account registered successfully.
      </div>
    <?php
    }
    else if($rowCount == 0){
      $_SESSION['error'] .= $error;
      header('Location: /view/register.php');
    }
    ?>
  </div>
</body>
</html>
