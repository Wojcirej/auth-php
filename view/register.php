<?php
session_start();
$root = $_SESSION['root'];
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
      Create account
    </div>
    <form method="POST" action="/app/account/register.php">
      <div class="row">
        <div class="col-sm-3">
          <div class="form-group">
            <label>Login: </label>
            <input type="text" name="login" class="form-control" required="true"/>
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
            <input type="text" name="firstName" class="form-control"/>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Last name: </label>
            <input type="text" name="lastName" class="form-control"/>
          </div>
        </div>
        <div class="col-sm-3">
          <div class="form-group">
            <label>Email: </label>
            <input type="email" name="email" class="form-control" required="true"/>
          </div>
        </div>
      </div>
      <div class="row">
        <button type="submit" class="btn btn-default">Register</button>
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
