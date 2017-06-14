<?php
session_start();
$root = $_SESSION['root'];
if(!isset($_SESSION['user']) || ( !isset($_SESSION['role']) || $_SESSION['role'] != 'admin')) {
  header("Location: /index.php");
}
include $root.'/app/Database.class.php';
$users = Database::getInstance()::getAllUsers();
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
      List of registered user accounts on site
    </div>
    <table class="table table-hover table-striped table-bordered table-condensed">
      <thead>
        <td>ID</td>
        <td>Login</td>
        <td>Email</td>
        <td>First name</td>
        <td>Last name</td>
        <td>Role</td>
        <td>Action</td>
      </thead>
      <tbody>
        <?php
        foreach ($users as $user) {
          echo "<tr>";
          echo "<td>".$user['ID']."</td>";
          echo "<td>".$user['LOGIN']."</td>";
          echo "<td>".$user['EMAIL']."</td>";
          echo "<td>".$user['FIRST_NAME']."</td>";
          echo "<td>".$user['LAST_NAME']."</td>";
          echo "<td>".$user['ROLE']."</td>";
          echo '<td><a href="/view/admin/edit.php?id='.$user['ID'].'" class="btn btn-default btn-xs">Edit</a>';
          echo '<a href="/view/admin/delete.php?id='.$user['ID'].'" class="btn btn-danger btn-xs">Delete</a></td>';
          echo "</tr>";
        }
         ?>
      </tbody>
    </table>
    <a href="/view/admin/admin.php" class="btn btn-info">Back to admin index</a>
    <div class="row">
      <div class="col-sm-4">
        <?php
        if (!empty($_SESSION['success'])) {
          ?>
          <div class="alert alert-success" role="alert">
            <?= $_SESSION['success'] ?>
          </div>
          <?php
          unset($_SESSION['success']);
        }
        if (!empty($_SESSION['error'])) {
          ?>
          <div class="alert alert-danger" role="alert">
            <?= $_SESSION['error'] ?>
          </div>
          <?php
          unset($_SESSION['error']);
        }
        ?>
      </div>
    </div>
  </div>
</body>
</html>
