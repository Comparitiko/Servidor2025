<?php

namespace CoworkingMongo\models;

class User
{
  private $id;
  private $username;
  private $email;
  private $password;
  private $phone;
  private $created_at;

  /**
   * @param $id
   * @param $username
   * @param $email
   * @param $password
   * @param $phone
   * @param $created_at
   */
  public function __construct($id = "", $username = "", $email = "", $password = "", $phone = "", $created_at = "")
  {
    $this->id = $id;
    $this->username = $username;
    $this->email = $email;
    $this->password = $password;
    $this->phone = $phone;
    $this->created_at = $created_at;
  }

  public function getId(): mixed
  {
    return $this->id;
  }

  public function setId(mixed $id): void
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

  public function getCreatedAt(): mixed
  {
    return $this->created_at;
  }

  public function setCreatedAt(mixed $created_at): void
  {
    $this->created_at = $created_at;
  }
}