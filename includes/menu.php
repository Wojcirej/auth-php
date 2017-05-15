<?php
$login = $_SESSION['user'];
if (!empty($login)) {
  $db = Database::getInstance();
  if ($db::isUserInRole($login, 'admin')) {
    ?>
    <!-- admin -->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Index</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/">Index</a></li>
            <li><a href="/admin.php">Admin Panel</a></li>
            <li><a href="/logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <?php
  } else if ($db::isUserInRole($login, 'user')) {
    ?>
    <!--user-->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Index</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/profile.php">Profile</a></li>
            <li><a href="/logout.php">Logout</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <?php  }  ?>  <?php
  } else {
    ?>
    <!--guest-->
    <nav class="navbar navbar-inverse navbar-static-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="/">Index</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="nav navbar-nav">
            <li><a href="/login.php">Login</a></li>
            <li><a href="/register.php">Register</a></li>
          </ul>
        </div>
      </div>
    </nav>
    <?php } ?>
