<?php

namespace CoworkingMongo\models;

use CoworkingMongo\enums\Collections;
use CoworkingMongo\enums\ReservationStatus;
use MongoDB\BSON\ObjectId;

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
   * @param $userId
   * @return false|array|null
   */
  public static function getFutureAndConfirmedReservationsByUserId($userId): false|array|null
  {
    $conn = new DBConnection();

    $reservationCollection = $conn->getCollection(Collections::RESERVATIONS);


    // Check if there is an error in the connection
    if (is_null($reservationCollection)) return null;

    $user = UsersModel::getUserById($userId);

    if (is_null($user)) return null;

    if (!$user->getId()) return null;

    $reservations = $reservationCollection->find([
      'username' => $user->getUsername(),
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
   * Cancel one reservation by user id and reservation id and return true if no error, if not db connection return
   * null,
   * if none is modified
   * return false
   * @param $userId
   * @param $reservationId
   * @return bool|null
   */
  public static function cancelReservationByUserIdAndReservationId($userId, $reservation_id): bool|null
  {
    $conn = new DBConnection();

    $reservationCollection = $conn->getCollection(Collections::RESERVATIONS);

    // Check if there is an error in the connection
    if (is_null($reservationCollection)) return null;

    $user = UsersModel::getUserById($userId);

    if (is_null($user)) return null;

    if (!$user) return false;

    $reservationMod = $reservationCollection->updateOne(
      [
        '_id' => new ObjectId($reservation_id),
        'username' => $user->getUsername(),
      ],
      [
        '$set' => [
          'status' => ReservationStatus::CANCELLED->value,
        ]
      ],
    );

    $conn->closeConnection();

    return $reservationMod->getModifiedCount() > 0;
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
  public static function canBeInserted(Reservation $reservation, $roomId): ?bool
  {
    $conn = new DBConnection();

    $reservationCollection = $conn->getCollection(Collections::RESERVATIONS);

    // Check if there is an error in the connection
    if (is_null($reservationCollection)) return null;

    $workRoom = WorkRoomsModel::getWorkRoomById($roomId);

    if (is_null($workRoom)) return null;

    if (!$workRoom) return false;

    $reservations = $reservationCollection->countDocuments([
      'room_name' => $workRoom->getName(),
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
   * @param $userId
   * @param $roomId
   * @return bool|null
   */
  public static function newReservation(Reservation $reservation, $userId, $roomId): ?bool
  {
    $conn = new DBConnection();

    $reservationCollection = $conn->getCollection(Collections::RESERVATIONS);

    // Check if there is an error in the connection
    if (is_null($reservationCollection)) return null;

    $user = UsersModel::getUserById($userId);
    $workRoom = WorkRoomsModel::getWorkRoomById($roomId);

    if (is_null($user) || is_null($workRoom)) return null;

    if (!$user || !$workRoom) return false;


    // Save in the reservation instance the username and room name
    $reservation->setUsername($user->getUsername());
    $reservation->setRoomName($workRoom->getName());

    // Insert reservation in the database
    $numInserts = $reservationCollection->insertOne($reservation)->getInsertedCount();

    $conn->closeConnection();

    return $numInserts > 0;
  }
}