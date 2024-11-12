<?php

namespace Coworking\models;

use Coworking\enums\Status;
use TypeError;
use ValueError;

class Reservation {
  private $id;
  private $userName;
  private $roomName;
  private $reservationDate;
  private $startTime;
  private $endTime;
  private Status $status;

  /**
   * @param $id
   * @param $userName
   * @param $roomName
   * @param $reservationDate
   * @param $startTime
   * @param $endTime
   * @param $status
   */
  public function __construct($id = "", $userName = "", $roomName = "", $reservationDate = "", $startTime = "",
                              $endTime = "")
  {
    $this->id = $id;
    $this->userName = $userName;
    $this->roomName = $roomName;
    $this->reservationDate = $reservationDate;
    $this->startTime = $startTime;
    $this->endTime = $endTime;
    unset($this->status);
  }

  public function getId(): mixed
  {
    return $this->id;
  }

  public function setId(mixed $id): void
  {
    $this->id = $id;
  }

  public function getUserName(): mixed
  {
    return $this->userName;
  }

  public function setUserName(mixed $userName): void
  {
    $this->userName = $userName;
  }

  public function getRoomName(): mixed
  {
    return $this->roomName;
  }

  public function setRoomName(mixed $roomName): void
  {
    $this->roomName = $roomName;
  }

  public function getReservationDate(): mixed
  {
    return $this->reservationDate;
  }

  public function setReservationDate(mixed $reservationDate): void
  {
    $this->reservationDate = $reservationDate;
  }

  public function getStartTime(): mixed
  {
    return $this->startTime;
  }

  public function setStartTime(mixed $startTime): void
  {
    $this->startTime = $startTime;
  }

  public function getEndTime(): mixed
  {
    return $this->endTime;
  }

  public function setEndTime(mixed $endTime): void
  {
    $this->endTime = $endTime;
  }

  public function getStatus(): Status
  {
    return $this->status;
  }

  public function setStatus(Status $status): void
  {
    $this->status = $status;
  }

  // Se necesita el metodo para que haga la conversion de string a enum y en el constructor poner unset de la propiedad
  public function __set($key, $value)
  {
    if ($key === 'status') {
      $this->status = Status::from($value);
    }
  }
}