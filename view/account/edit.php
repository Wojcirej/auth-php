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
  $_SESSION['id'] = $user->getId();
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
      Edit your profile (confirm changes by typing password, new or current one)
    </div>
    <form method="POST" action="/app/account/edit.php">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label>Login: </label>
            <input type="text" name="login" class="form-control" required="true" value="<?= $user->getLogin() ?>"/>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Password: </label>
            <input type="password" name="password" class="form-control" required="true"/>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Repeat password: </label>
            <input type="password" name="password2" class="form-control" required="true"/>
          </div>
        </div>
      </div>
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label>First name: </label>
            <input type="text" name="firstName" class="form-control" value="<?= $user->getFirstName() ?>"/>
          </div>
        </div>
        <div class="col-sm-3">
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
          <button type="reset" class="btn btn-default">Reset</button>
          <a href="/view/account/profile.php" class="btn btn-default">Back to profile</a>
        </div>
      </div>
    </form>
    <div class="row">
      <div class="col-sm-4">
        <?php
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
