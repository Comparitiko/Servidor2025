<?php

namespace Coworking\models;

class WorkRoom
{
  private $id;
  private $name;
  private $capacity;
  private $location;

  /**
   * @param $id
   * @param $name
   * @param $capacity
   * @param $location
   */
  public function __construct($id = 0, $name = "", $capacity = "", $location = "")
  {
    $this->id = $id;
    $this->name = $name;
    $this->capacity = $capacity;
    $this->location = $location;
  }

  public function getId(): mixed
  {
    return $this->id;
  }

  public function setId(mixed $id): void
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


}