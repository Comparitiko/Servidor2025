<?php

namespace CoworkingMongo\models;

use MongoDB\BSON\Document;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Persistable;
use stdClass;

class WorkRoom implements Persistable
{
  private ObjectId $id;
  private string $name;
  private int $capacity;
  private string $location;

  /**
   * @param $id
   * @param $name
   * @param $capacity
   * @param $location
   */
  public function __construct(string $name, int $capacity, string $location)
  {
    $this->id = new ObjectId();
    $this->name = $name;
    $this->capacity = $capacity;
    $this->location = $location;
  }

  public function getId(): ObjectId
  {
    return $this->id;
  }

  public function setId(ObjectId $id): void
  {
    $this->id = $id;
  }

  public function getName(): mixed
  {
    return $this->name;
  }

  public function setName(mixed $name): void
  {
    $this->name = $name;
  }

  public function getCapacity(): mixed
  {
    return $this->capacity;
  }

  public function setCapacity(mixed $capacity): void
  {
    $this->capacity = $capacity;
  }

  public function getLocation(): mixed
  {
    return $this->location;
  }

  public function setLocation(mixed $location): void
  {
    $this->location = $location;
  }


  public function bsonSerialize(): array|stdClass|Document
  {
    return [
      "_id" => $this->id,
      "name" => $this->name,
      "capacity" => $this->capacity,
      "location" => $this->location,
    ];
  }

  public function bsonUnserialize(array $data)
  {
    $this->id = $data["_id"];
    $this->name = $data["name"];
    $this->capacity = $data["capacity"];
    $this->location = $data["location"];
  }
}