<?php

namespace ChatGPTBlogs\models;

use MongoDB\BSON\Document;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Persistable;
use stdClass;

class User implements Persistable
{
  private ObjectId $id;
  private string $name;

  private string $email;

  private string $password;

  /**
   * @param string $name
   * @param string $email
   * @param string $password
   */
  public function __construct(string $name, string $email, string $password)
  {
    $this->id = new ObjectId();
    $this->name = $name;
    $this->email = $email;
    $this->password = $password;
  }

  public function getId(): ObjectId
  {
    return $this->id;
  }

  public function setId(ObjectId $id): void
  {
    $this->id = $id;
  }

  public function getName(): string
  {
    return $this->name;
  }

  public function setName(string $name): void
  {
    $this->name = $name;
  }

  public function getEmail(): string
  {
    return $this->email;
  }

  public function setEmail(string $email): void
  {
    $this->email = $email;
  }

  public function getPassword(): string
  {
    return $this->password;
  }

  public function setPassword(string $password): void
  {
    $this->password = $password;
  }

  public function bsonSerialize(): array|stdClass|Document
  {
    return [
      '_id' => $this->id,
      'name' => $this->name,
      'email' => $this->email,
      'password' => $this->password,
    ];
  }

  public function bsonUnserialize(array $data)
  {
    $this->id = $data['_id'];
    $this->name = $data['name'];
    $this->email = $data['email'];
    $this->password = $data['password'];
  }
}