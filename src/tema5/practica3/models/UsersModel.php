<?php

namespace ChatGPTBlogs\models;

use ChatGPTBlogs\enums\Collections;
use MongoDB\BSON\ObjectId;

class UsersModel
{
  /**
   * Create user in database with his data, return null if there is an error with database, if is inserted correctly
   * return true if not return false
   * @param $user User
   * @return ObjectId|false|null
   */
  public static function register(User $user): ObjectId|false|null
  {
    $conn = new DBConnection();

    $userCollection = $conn->getCollection(Collections::USERS);

    // Check if there is an error in the connection
    if (is_null($userCollection)) return null;

    $userInserted = $userCollection->insertOne($user);

    if (!isset($userInserted)) return false;

    $conn->closeConnection();

    return $user->getId();
  }

  /**
   * Check if the email exists in database, if exist return true, if not return false and if database fail
   * return null
   * @param $email
   * @return bool|null
   */
  public static function userExists($email): bool|null
  {
    $conn = new DBConnection();

    $userCollection = $conn->getCollection(Collections::USERS);

    // Check if there is an error in the connection
    if (is_null($userCollection)) return null;

    $documentsCount = $userCollection->countDocuments(["email" => $email]);

    $conn->closeConnection();

    return $documentsCount > 0;
  }

  /**
   * Get the user information by email, if return null, database failed, if return false, user does not exist
   * @param $email
   * @return object|false|null
   */
  public static function getUserByEmail($email): object|false|null
  {
    $conn = new DBConnection();

    $userCollection = $conn->getCollection(Collections::USERS);

    // Check if there is an error in the connection
    if (is_null($userCollection)) return null;

    $user = $userCollection->findOne([
      'email' => $email
    ],
      [
        'typeMap' => [
          'root' => User::class, // Devuelve los documentos como objetos
        ],
      ]
    );

    $conn->closeConnection();

    if (!isset($user)) return false;

    return $user;
  }
}