<?php

namespace CoworkingMongo\models;

use CoworkingMongo\enums\ReservationStatus;
use MongoDB\BSON\Document;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Persistable;
use stdClass;

class Reservation implements Persistable
{
  private ObjectId $id;
  private string $username;
  private string $room_name;
  private string $reservation_date;
  private string $start_time;
  private string $end_time;
  private ReservationStatus $status;

  /**
   * @param $id
   * @param $userName
   * @param $roomName
   * @param $reservationDate
   * @param $startTime
   * @param $endTime
   * @param $status
   */
  public function __construct($username, $room_name, $reservation_date, $start_time, $end_time)
  {
    $this->id = new ObjectId();
    $this->username = $username;
    $this->room_name = $room_name;
    $this->reservation_date = $reservation_date;
    $this->start_time = $start_time;
    $this->end_time = $end_time;
  }

  public function getId(): ObjectId
  {
    return $this->id;
  }

  public function setId(ObjectId $id): void
  {
    $this->id = $id;
  }

  public function getUsername(): string
  {
    return $this->username;
  }

  public function setUsername(string $username): void
  {
    $this->username = $username;
  }

  public function getRoomName(): string
  {
    return $this->room_name;
  }

  public function setRoomName(string $room_name): void
  {
    $this->room_name = $room_name;
  }

  public function getReservationDate(): string
  {
    return $this->reservation_date;
  }

  public function setReservationDate(string $reservation_date): void
  {
    $this->reservation_date = $reservation_date;
  }

  public function getStartTime(): string
  {
    return $this->start_time;
  }

  public function setStartTime(string $start_time): void
  {
    $this->start_time = $start_time;
  }

  public function getEndTime(): string
  {
    return $this->end_time;
  }

  public function setEndTime(string $end_time): void
  {
    $this->end_time = $end_time;
  }

  public function getStatus(): ReservationStatus
  {
    return $this->status;
  }

  public function setStatus(string $status): void
  {
    $this->status = ReservationStatus::from($status);
  }

  public function bsonSerialize(): array|stdClass|Document
  {
    return [
      "_id" => $this->id,
      "username" => $this->username,
      "room_name" => $this->room_name,
      "reservation_date" => $this->reservation_date,
      "start_time" => $this->start_time,
      "end_time" => $this->end_time,
      "status" => $this->status->value,
    ];
  }

  public function bsonUnserialize(array $data): void
  {
    $this->id = $data["_id"];
    $this->username = $data["username"];
    $this->room_name = $data["room_name"];
    $this->reservation_date = $data["reservation_date"];
    $this->start_time = $data["start_time"];
    $this->end_time = $data["end_time"];
    $this->status = ReservationStatus::from($data["status"]);
  }
}