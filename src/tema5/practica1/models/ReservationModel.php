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
          'reservation_date' => 1
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
          'reservation_date' => 1
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

    $reservations = $reservationCollection->countDocuments([
      'room_name' => $room_name,
      'reservation_date' => $reservation->getReservationDate(),
      'status' => ReservationStatus::CONFIRMED->value,
      '$or' => [
        // Caso 1: El inicio del nuevo rango cae dentro de un rango existente
        [
          '$and' => [
            ['start_time' => ['$gte' => $reservation->getStartTime()]],
            ['start_time' => ['$lte' => $reservation->getEndTime()]]
          ]
        ],
        // Caso 2: El fin del nuevo rango cae dentro de un rango existente
        [
          '$and' => [
            ['end_time' => ['$gte' => $reservation->getStartTime()]],
            ['end_time' => ['$lte' => $reservation->getEndTime()]]
          ]
        ],
        // Caso 3: El nuevo rango engloba completamente un rango existente
        [
          '$and' => [
            ['start_time' => ['$lte' => $reservation->getStartTime()]],
            ['end_time' => ['$gte' => $reservation->getEndTime()]]
          ]
        ]
      ]
    ]);

    $conn->closeConnection();



    return $reservations === 0;
  }

  /**
   * Insert one reservation and return true if no error, if not db connection return null,
   * if none is inserted
   * return false
   * @param Reservation $reservation
   * @param $username
   * @param $room_name
   * @return bool|null
   */
  public static function newReservation(Reservation $reservation, $username, $room_name): ?bool
  {
    $conn = new DBConnection();

    $reservationCollection = $conn->getCollection(Collections::RESERVATIONS);

    // Check if there is an error in the connection
    if (is_null($reservationCollection)) return null;

    // Save in the reservation instance the username and room name
    $reservation->setUsername($username);
    $reservation->setRoomName($room_name);

    // Insert reservation in the database
    $numInserts = $reservationCollection->insertOne($reservation)->getInsertedCount();

    $conn->closeConnection();

    return $numInserts > 0;
  }
}