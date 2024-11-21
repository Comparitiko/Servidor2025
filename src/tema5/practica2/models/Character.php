<?php

namespace DragonBallApp\models;

class Character
{
  private $name;
  private $image;
  private $ki;
  private $race;
  private $description;

  /**
   * @param $name
   * @param $image
   * @param $ki
   * @param $race
   * @param $description
   */
  public function __construct($name, $image, $ki, $race, $description)
  {
    $this->name = $name;
    $this->image = $image;
    if (strtolower($ki) !== "unknown") {
      $this->ki = $ki;
    } else {
      $this->ki = "Desconocido";
    }
    if (strtolower($race) !== "unknown") {
      $this->race = $race;
    } else {
      $this->race = "Zeno Sama";
    }
    $this->description = $description;
  }

  /**
   * @return mixed
   */
  public function getName()
  {
    return $this->name;
  }

  /**
   * @return mixed
   */
  public function getImage()
  {
    return $this->image;
  }

  /**
   * @return mixed
   */
  public function getKi()
  {
    return $this->ki;
  }

  /**
   * @return mixed
   */
  public function getRace()
  {
    return $this->race;
  }

  /**
   * @return mixed
   */
  public function getDescription()
  {
    return $this->description;
  }
}