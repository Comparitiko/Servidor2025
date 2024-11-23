<?php

namespace CoworkingMongo\models;

use PDO;

class UsersModel
{
  /**
   * Create user in database with his data, return null if there is an error with database, if is inserted correctly
   * return true if not return false
   * @param $user User
   * @return int|null
   */
  public static function register(User $user): int|null
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

    $id = $conn->lastInsertId();

    $connDB->closeConnection();

    return $id;
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

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'CoworkingMongo\models\User');
    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->rowCount() > 0;
  }

  /**
   * Get the user information by email, if return null, database failed, if return false, user does not exist
   * @param $email
   * @return User|false|null
   */
  public static function getUserByEmail($email): false|User|null
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("
        SELECT * 
        FROM users 
        WHERE email = :email
    ");

    $stmt->bindValue(":email", $email);

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'CoworkingMongo\models\User');
    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->fetch();
  }
}