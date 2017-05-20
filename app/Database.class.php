<?php
class Database {
  private static $db;

  public static function getInstance() {
    if (!self::$db) {
      try {
        self::$db = new PDO('mysql:host=localhost;dbname=users-auth;charset=utf8','root','');
      }
      catch(PDOException $e){
        return null;
      }
      return new Database();
    }
  }

  public static function addUser($user) {
    try{
      $stmt = self::$db->prepare("INSERT INTO accounts (ID,LOGIN,PASSWORD,FIRST_NAME,LAST_NAME,EMAIL,ROLE) "
      . "VALUES(null,:login,:password,:firstName,:lastName,:email,:role)");
      $stmt->execute(array(
        ':firstName' => $user->getFirstName(),
        ':lastName' => $user->getLastName(),
        ':email' => $user->getEmail(),
        ':login' => $user->getLogin(),
        ':password' => sha1($user->getPassword()),
        ':role' => $user->getRole())
      );
    }
    catch(PDOException $e){
      $_SESSION['error'] .= $e->getMessage();
    }
    return $stmt->rowCount();
  }
}
?>
