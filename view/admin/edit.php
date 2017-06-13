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
      Edit user profile (confirm changes by typing password, new or current one)
    </div>
    <form method="POST" action="/app/admin/edit_success.php">
      <div class="row">
        <div class="col-sm-2">
          <div class="form-group">
            <label>Login: </label>
            <input type="text" name="login" class="form-control" required="true" value="<?= $user->getLogin() ?>"/>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label>Role: </label>
            <select name="role" class="form-control">
              <?php
              if ($user->getRole() == 'admin') {
                echo "<option selected>admin</option><option>user</option>";
              }
              if ($user->getRole() == 'user') {
                echo "<option>admin</option><option selected>user</option>";
              }
               ?>
            </select>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label>First name: </label>
            <input type="text" name="firstName" class="form-control" value="<?= $user->getFirstName() ?>"/>
          </div>
        </div>
        <div class="col-sm-2">
          <div class="form-group">
            <label>Last name: </label>
            <input type="text" name="lastName" class="form-control" value="<?= $user->getLastName() ?>"/>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Email: </label>
            <input type="email" name="email" class="form-control" required="true" value="<?= $user->getEmail() ?>"/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="btn-group">
          <button type="submit" class="btn btn-default">Edit</button>
          <button type="reset" class="btn btn-danger">Reset</button>
          <a href="/view/admin/user_list.php" class="btn btn-info">Back to accounts list</a>
        </div>
      </div>
    </form>
  </div>
</body>
</html>
