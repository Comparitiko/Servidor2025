<?php

namespace CoworkingMongo\models;

use CoworkingMongo\enums\Status;
use MongoDB\BSON\Document;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Persistable;
use stdClass;

class Reservation implements Persistable
{
  private ObjectId $id;
  private array $user;
  private array $room;
  private string $reservation_date;
  private string $start_time;
  private string $end_time;
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
  public function __construct($user = [], $room = [], $reservation_date = "", $start_time = "",
                              $end_time = "")
  {
    $this->id = new ObjectId();
    $this->userName = $userName;
    $this->roomName = $roomName;
    $this->reservationDate = $reservationDate;
    $this->startTime = $startTime;
    $this->endTime = $endTime;
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

  public function setStatus(string $status): void
  {
    $this->status = Status::from($status);
  }

  public function bsonSerialize(): array|stdClass|Document
  {
    // TODO: Implement bsonSerialize() method.
  }

  public function bsonUnserialize(array $data)
  {
    // TODO: Implement bsonUnserialize() method.
  }
}