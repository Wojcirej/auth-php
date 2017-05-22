<?php
include $root.'/app/Database.class.php';
include $root.'/model/Account.class.php';
class AccountController {

  public static function isUserLoginAlreadyExists($login) {
    $user = Database::getUserByLogin($login);
    return !empty($user);
  }

  public static function isEmailAlreadyExists($email) {
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
}
?>
