<?php
include 'config.php';
?>
<!DOCTYPE html>
<html lang="eng">
<head>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <meta charset="utf-8">
  <title>Main page</title>
</head>
<body>
  <?php include $root.'includes/menu.php'; ?>
  <div class="container">
    <div class="page-header">
      <?php
      if(isset($_SESSION['user'])) { ?>
        <p>Logged as <?= $_SESSION['user'] ?></p>
      <?php
      }
      ?>
    </div>
    <?php
    if(isset($_SESSION['success'])) { ?>
      <div class="alert alert-success" role="alert">
        <?= $_SESSION['success'] ?>
      </div>
      <?php
      unset($_SESSION['success']);
      }
      ?>
  </div>
</body>
</html>
