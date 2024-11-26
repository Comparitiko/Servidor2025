<?php

namespace CoworkingMongo\models;

use Cassandra\Date;
use MongoDB\BSON\Document;
use MongoDB\BSON\Persistable;
use stdClass;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;

class User implements Persistable
{
  private ObjectId $id;
  private string $username;
  private string $email;
  private string $password;
  private string $phone;
  private string $created_at;

  /**
   * @param $username
   * @param $email
   * @param $password
   * @param $phone
   */
  public function __construct(string $username, string $email, string $password, string $phone)
  {
    $this->id = new ObjectId();
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->phone = $phone;
    $this->created_at = date('Y-m-d');
  }

  public function getId(): ObjectId
  {
    return $this->id;
  }

  public function setId(ObjectId $id): void
  {
    $this->id = $id;
  }

  public function getUsername(): mixed
  {
    return $this->username;
  }

  public function setUsername(mixed $username): void
  {
    $this->username = $username;
  }

  public function getEmail(): mixed
  {
    return $this->email;
  }

  public function setEmail(mixed $email): void
  {
    $this->email = $email;
  }

  public function getPassword(): mixed
  {
    return $this->password;
  }

  public function setPassword(mixed $password): void
  {
    $this->password = $password;
  }

  public function getPhone(): mixed
  {
    return $this->phone;
  }

  public function setPhone(mixed $phone): void
  {
    $this->phone = $phone;
  }

  public function getCreatedAt(): string
  {
    return $this->created_at;
  }

  public function setCreatedAt(string $created_at): void
  {
    $this->created_at = $created_at;
  }

  public function bsonSerialize(): array|stdClass|Document
  {
    return [
      "_id" => $this->id,
      "username" => $this->username,
      "email" => $this->email,
      "password" => $this->password,
      "phone" => $this->phone,
      'created_at' => $this->created_at,
    ];
  }

  public function bsonUnserialize(array $data): void
  {
    $this->id = $data["_id"];
    $this->username = $data["username"];
    $this->email = $data["email"];
    $this->password = $data["password"];
    $this->phone = $data["phone"];
    $this->created_at = $data["created_at"];
  }
}