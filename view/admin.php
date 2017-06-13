<?php
session_start();
$root = $_SESSION['root'];
if(!isset($_SESSION['user']) || ( !isset($_SESSION['role']) || $_SESSION['role'] != 'admin')) {
  header("Location: /index.php");
}
?>
<!DOCTYPE html>
<html lang="eng">
<head>
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css">
  <meta charset="utf-8">
  <title>Administration Panel</title>
</head>
<body>
  <?php include $root.'/includes/menu.php'; ?>
  <div class="container">
    <div class="page-header">
      Welcome into administration panel!
    </div>
    <div class="row">
      <div class="col-sm-1">
        <a href="/view/admin/user_list.php" class="btn btn-default btn-sm">List of users</a>
      </div>
      <div class="col-sm-1">
        <a href="/view/admin/admin_list.php" class="btn btn-default btn-sm">List of admins</a>
      </div>
    </div>
  </div>
</body>
</html>
