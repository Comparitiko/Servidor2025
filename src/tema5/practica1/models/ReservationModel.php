<?php

namespace CoworkingMongo\models;

use CoworkingMongo\enums\Collections;
use CoworkingMongo\enums\ReservationStatus;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\UTCDateTime;
use PDO;

class ReservationModel
{
  /**
   * Get all future and confirmed reservations by room name, if not db connection return null, if none is found return
   * false
   * @param $room_name
   * @return false|array|null
   */
  public static function getFutureAndConfirmedReservationsByRoomName($room_name): false|array|null
  {
    $conn = new DBConnection();

    $reservationsCollection = $conn->getCollection(Collections::RESERVATIONS);

    // Check if there is an error in the connection
    if (is_null($reservationsCollection)) return null;

    $reservations = $reservationsCollection->find([
        'room_name' => $room_name,
        'reservation_date' => [
          '$gt' => date("Y-m-d")
        ],
        'status' => ReservationStatus::CONFIRMED->value,
      ],
      [
        'sort' => [
          'reservation_date' => -1
        ],
        'typeMap' => [
          'root' => Reservation::class, // Devuelve los documentos como objetos
        ],
      ]
    );

    $conn->closeConnection();

    $resArr = $reservations->toArray();

    if (count($resArr) === 0) return false;

    return $resArr;
  }

  /**
   * Get all future and confirmed reservations by username, if not db connection return null, if none is found return
   * false
   * @param $username
   * @return false|array|null
   */
  public static function getFutureAndConfirmedReservationsByUserName($username): false|array|null
  {
    $conn = new DBConnection();

    $reservationCollection = $conn->getCollection(Collections::RESERVATIONS);

    // Check if there is an error in the connection
    if (is_null($reservationCollection)) return null;

    $reservations = $reservationCollection->find([
      'username' => $username,
        'reservation_date' => [
          '$gt' => date("Y-m-d")
        ],
        'status' => ReservationStatus::CONFIRMED->value,
      ],
      [
        'sort' => [
          'reservation_date' => -1
        ],
        'typeMap' => [
          'root' => Reservation::class, // Devuelve los documentos como objetos
        ],
      ]);

    $resArr = $reservations->toArray();

    $conn->closeConnection();

    if (count($resArr) === 0) return false;

    return $resArr;
  }

  /**
   * Cancel one reservation by username and reservation id and return true if no error, if not db connection return
   * null,
   * if none is modified
   * return false
   * @param $userId
   * @param $reservationId
   * @return bool|null
   */
  public static function cancelReservationByUserNameAndReservationId($username, $reservation_id): bool|null
  {
    $conn = new DBConnection();

    $reservationCollection = $conn->getCollection(Collections::RESERVATIONS);

    // Check if there is an error in the connection
    if (is_null($reservationCollection)) return null;

    $reservationMod = $reservationCollection->updateOne(
      [
        '_id' => new ObjectId($reservation_id),
        'username' => $username,
      ],
      [
        '$set' => [
          'status' => ReservationStatus::CANCELLED->value,
        ]
      ],
    );

    $conn->closeConnection();

    return  $reservationMod->getModifiedCount() > 0;
  }

  /**
   * Check if there is no reservations at the same time and return true if it can be inserted, if not db connection
   * return null,
   * if none is inserted
   * return false
   * @param Reservation $reservation
   * @param $roomId
   * @return bool|null
   */
  public static function canBeInserted(Reservation $reservation, $room_name): ?bool
  {
    $conn = new DBConnection();

    $reservationCollection = $conn->getCollection(Collections::RESERVATIONS);

    // Check if there is an error in the connection
    if (is_null($reservationCollection)) return null;

    $reservations = $reservationCollection->find([
      'room_name' => $room_name,
      'reservation_date' => $reservation->getReservationDate(),
      'status' => ReservationStatus::CONFIRMED->value,
      '$or' => [
        [
          '$and' => [
            ['start_time' => ['$gte' => $reservation->getStartTime()]],
            ['start_time' => ['$lte' => $reservation->getEndTime()]]
          ],
        ],
        [
          '$and' => [
            ['end_time' => ['$gte' => $reservation->getStartTime()]],
            ['end_time' => ['$lte' => $reservation->getEndTime()]]
          ]
        ],
        [
          '$and' => [
            [
              ['start_time' => ['$gte' => $reservation->getStartTime()]],
              ['start_time' => ['$lte' => $reservation->getEndTime()]]
            ],
            [
              ['end_time' => ['$gte' => $reservation->getStartTime()]],
              ['end_time' => ['$lte' => $reservation->getEndTime()]]
            ]
          ]
        ]
      ]
    ]);

    var_dump($reservations->toArray());

    $conn->closeConnection();

    // return $reservations === 0;
  }

  /**
   * Insert one reservation and return true if no error, if not db connection return null,
   * if none is inserted
   * return false
   * @param \Coworking\models\Reservation $reservation
   * @param $userId
   * @param $roomId
   * @return bool|null
   */
  public static function newReservation(Reservation $reservation, $userName, $roomName): ?bool
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("
        INSERT INTO reservations (user_id, room_id, reservation_date, start_time, end_time, status) VALUES 
        (:userId, :roomId, :reservationDate, :startTime, :endTime, :status)
      ");

    $stmt->bindValue(":userId", $userId);
    $stmt->bindValue(":roomId", $roomId);
    $stmt->bindValue(":reservationDate", $reservation->getReservationDate());
    $stmt->bindValue(":startTime", $reservation->getStartTime());
    $stmt->bindValue(":endTime", $reservation->getEndTime());
    $stmt->bindValue(":status", $reservation->getStatus()->value);

    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->rowCount() > 0;
  }
}