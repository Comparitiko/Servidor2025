<?php

namespace Coworking\models;

use PDO;
use Coworking\models\User;

class UsersModel {
  /**
   * Create user in database with his data, return null if there is an error with database, if is inserted correctly
   * return true if not return false
   * @param $user User
   * @return bool|null
   */
  public static function register(User $user): bool|null
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("
        INSERT INTO users (username, email, password, phone) VALUES
        (:username, :email, :password, :phone)
    ");

    $stmt->bindValue(":username", $user->getUsername());
    $stmt->bindValue(":email", $user->getEmail());
    $stmt->bindValue(":password", $user->getPassword());
    $stmt->bindValue(":phone", $user->getPhone());

    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->rowCount() > 0;
  }

  /**
   * Check if the username and email exists in database, if exist return true, if not return false and if database fail
   * return null
   * @param $username
   * @param $email
   * @return bool|null
   */
  public static function userExists($username, $email): bool|null
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("
        SELECT 1 
        FROM users 
        WHERE username = :username 
        OR email = :email
    ");

    $stmt->bindValue(":username", $username);
    $stmt->bindValue(":email", $email);

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Coworking\models\User');
    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->rowCount() > 0;
  }
}