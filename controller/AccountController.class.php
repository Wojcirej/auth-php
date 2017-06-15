<?php
include $root.'/app/Database.class.php';
include $root.'/model/Account.class.php';
class AccountController {

  private static function isUserLoginAlreadyExists($login) {
    $user = Database::getUserByLogin($login);
    return !empty($user);
  }

  private static function isEmailAlreadyExists($email) {
    $user = Database::getUserByEmail($email);
    return !empty($user);
  }

  public static function register() {
    $error = "";
    $db = Database::getInstance();
    if($db == null){
      $_SESSION['error'] = "Connection with database cannot be established, try again later.";
      return 0;
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $login = trim($_POST['login']);
      $password = trim($_POST['password']);
      $password2 = trim($_POST['password2']);
      $firstName = trim($_POST['firstName']);
      $lastName = trim($_POST['lastName']);
      $email = trim($_POST['email']);

      if(empty($login)){
        $error .= "<li>Please enter login.</li>";
      }
      if(empty($password)){
        $error .= "<li>Please enter password.</li>";
      }
      if(strcmp($password, $password2)){
        $error .= "<li>Passwords don't match.</li>";
      }
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error .= "<li>Email address is incorrect.</li>";
      }
      if(AccountController::isUserLoginAlreadyExists($login)){
        $error .= "<li>Account with login ".$login." already exists.</li>";
      }
      if(AccountController::isEmailAlreadyExists($email)){
        $error .= "<li>Email ".$email." is already in use.</li>";
      }

      if(empty($error)){
        $account = new Account();
        $account->setLogin($login);
        $account->setPassword($password);
        $account->setFirstName($firstName);
        $account->setLastName($lastName);
        $account->setEmail($email);
        $account->setRole("user");
        return $db::addUser($account);
      }
      else{
        $_SESSION['error'] = "Following errors occured during registration:";
        $_SESSION['error'] .= "<ul>";
        $_SESSION['error'] .= $error;
        $_SESSION['error'] .= "</ul>";
        return 0;
      }
    }
  }

  public static function login() {
    if (!empty($_POST['login']) && !empty($_POST['password'])) {
      $login = trim($_POST['login']);
      $password = trim($_POST['password']);
      $db = Database::getInstance();
      if($db == null){
        $_SESSION['error'] .= "Connection with database cannot be established, try again later.";
        header("Location: /view/login.php");
      }
      $user = $db::getUserByLoginAndPassword($login, $password);
      if (!empty($user)) {
        $_SESSION['user'] = $user->getLogin();
        $_SESSION['role'] = $user->getRole();
        header("Location: /index.php");
      }
      else {
        $_SESSION['error'] .= "Invalid login or password. Try again.";
        header("Location: /view/login.php");
      }
    }
  }

  public static function logout() {
    session_destroy();
    header("Location: /index.php");
  }

  public static function edit($id) {
    $error = "";
    $db = Database::getInstance();
    if($db == null){
      $_SESSION['error'] = "Connection with database cannot be established, try again later.";
      return 0;
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $login = trim($_POST['login']);
      $password = trim($_POST['password']);
      $password2 = trim($_POST['password2']);
      $firstName = trim($_POST['firstName']);
      $lastName = trim($_POST['lastName']);
      $email = trim($_POST['email']);

      if(empty($login)){
        $error .= "<li>Please enter login.</li>";
      }
      if(empty($password)){
        $error .= "<li>Please enter password.</li>";
      }
      if(strcmp($password, $password2)){
        $error .= "<li>Passwords don't match.</li>";
      }
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error .= "<li>Email address is incorrect.</li>";
      }

      if(empty($error)){
        $account = new Account();
        $account->setId($id);
        $account->setLogin($login);
        $account->setPassword($password);
        $account->setFirstName($firstName);
        $account->setLastName($lastName);
        $account->setEmail($email);
        $account->setRole("user");
        return $db::editUser($account);
      }
      else{
        $_SESSION['error'] = "Following errors occured during edition:";
        $_SESSION['error'] .= "<ul>";
        $_SESSION['error'] .= $error;
        $_SESSION['error'] .= "</ul>";
        return 0;
      }
    }
  }

  public static function editAsAdmin($id) {
    $error = "";
    $db = Database::getInstance();
    if($db == null){
      $_SESSION['error'] = "Connection with database cannot be established, try again later.";
      return 0;
    }
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
      $login = trim($_POST['login']);
      $firstName = trim($_POST['firstName']);
      $lastName = trim($_POST['lastName']);
      $email = trim($_POST['email']);
      $role = trim($_POST['role']);

      if(empty($login)){
        $error .= "<li>Please enter login.</li>";
      }
      if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $error .= "<li>Email address is incorrect.</li>";
      }

      if(empty($error)){
        $account = new Account();
        $account->setId($id);
        $account->setLogin($login);
        $account->setFirstName($firstName);
        $account->setLastName($lastName);
        $account->setEmail($email);
        $account->setRole($role);
        return $db::editUserAsAdmin($account);
      }
      else{
        $_SESSION['error'] = "Following errors occured during edition:";
        $_SESSION['error'] .= "<ul>";
        $_SESSION['error'] .= $error;
        $_SESSION['error'] .= "</ul>";
        return 0;
      }
    }
  }

  public static function deleteAsAdmin($id) {
    $error = "";
    $db = Database::getInstance();
    if($db == null) {
      $_SESSION['error'] = "Connection with database cannot be established, try again later.";
      return 0;
    }
    $user = $db::getUserById($id);
    if($user->getLogin() == $_SESSION['user']) {
      $_SESSION['error'] .= "Can't delete your own account!";
      return 0;
    }
    return $db::deleteUserById($id);
  }
}
?>
