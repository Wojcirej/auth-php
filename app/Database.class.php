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
    try {
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

  public static function getUserByLogin($login) {
    $stmt = self::$db->prepare('SELECT * FROM accounts WHERE LOGIN=?');
    $stmt->execute(array($login));
    if ($stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $result = $results[0];
      $user = new Account();
      $user->setId($result['ID']);
      $user->setFirstName($result['FIRST_NAME']);
      $user->setLastName($result['LAST_NAME']);
      $user->setEmail($result['EMAIL']);
      $user->setLogin($result['LOGIN']);
      $user->setPassword($result['PASSWORD']);
      $user->setRole($result['ROLE']);
      return $user;
    }
  }

  public static function getUserByEmail($email) {
    $stmt = self::$db->prepare('SELECT * FROM accounts WHERE EMAIL=?');
    $stmt->execute(array($email));
    if ($stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $result = $results[0];
      $user = new Account();
      $user->setId($result['ID']);
      $user->setFirstName($result['FIRST_NAME']);
      $user->setLastName($result['LAST_NAME']);
      $user->setEmail($result['EMAIL']);
      $user->setLogin($result['LOGIN']);
      $user->setPassword($result['PASSWORD']);
      $user->setRole($result['ROLE']);
      return $user;
    }
  }

  public static function getUserByLoginAndPassword($login, $password) {
    $stmt = self::$db->prepare('SELECT * FROM accounts WHERE LOGIN=? and PASSWORD=?');
    $stmt->execute(array($login, sha1($password)));
    if ($stmt->rowCount() > 0) {
      $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $result = $results[0];
      $user = new Account();
      $user->setId($result['ID']);
      $user->setFirstName($result['FIRST_NAME']);
      $user->setLastName($result['LAST_NAME']);
      $user->setEmail($result['EMAIL']);
      $user->setLogin($result['LOGIN']);
      $user->setPassword($result['PASSWORD']);
      $user->setRole($result['ROLE']);
      return $user;
    }
  }

  public static function editUser($user) {
    $stmt = self::$db->prepare("UPDATE accounts SET
      LOGIN = :login,
      PASSWORD = :password,
      FIRST_NAME = :firstName,
      LAST_NAME = :lastName,
      EMAIL = :email,
      ROLE = :role
      WHERE ID = :id");
    $stmt->execute(array(
      ':firstName' => $user->getFirstName(),
      ':lastName' => $user->getLastName(),
      ':email' => $user->getEmail(),
      ':login' => $user->getLogin(),
      ':password' => sha1($user->getPassword()),
      ':role' => $user->getRole(),
      ':id' => $user->getId())
    );
    return $stmt->rowCount();
  }
}
?>
