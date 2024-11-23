<?php

namespace CoworkingMongo\models;

use PDO;

class ReservationModel
{
  /**
   * Get all future and confirmed reservations by room id, if not db connection return null, if none is found return
   * false
   * @param $roomId
   * @return false|array|null
   */
  public static function getFutureAndConfirmedReservationsByRoomName($roomName): false|array|null
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("
      SELECT r.id, u.username as userName, wr.name as roomName, r.reservation_date as reservationDate, r.start_time as startTime, r.end_time as endTime, r.status
      FROM reservations r
      JOIN users u ON r.user_id = u.id
      JOIN work_rooms wr ON r.room_id = wr.id
      WHERE wr.name = :roomName
      AND r.reservation_date > NOW()
      AND status LIKE 'confirmada'
      ORDER BY r.reservation_date
      ");

    $stmt->bindValue(":roomName", $roomName);

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Coworking\models\Reservation');

    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->fetchAll();
  }

  /**
   * Get all future and confirmed reservations by user id, if not db connection return null, if none is found return
   * false
   * @param $roomId
   * @return false|array|null
   */
  public static function getFutureAndConfirmedReservationsByUserId($userId): false|array|null
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("
      SELECT r.id, u.username as userName, wr.name as roomName, r.reservation_date as reservationDate, r.start_time as startTime, r.end_time as endTime, r.status
      FROM reservations r
      JOIN users u ON r.user_id = u.id
      JOIN work_rooms wr ON r.room_id = wr.id
      WHERE r.reservation_date > NOW()
      AND status LIKE 'confirmada'
      AND u.id = :userId
      ");

    $stmt->bindValue(":userId", $userId);

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Coworking\models\Reservation');

    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->fetchAll();
  }

  /**
   * Cancel one reservation by user id and reservation id and return true if no error, if not db connection return null,
   * if none is modified
   * return false
   * @param $userId
   * @param $reservationId
   * @return bool|null
   */
  public static function cancelReservationByUserIdAndReservationId($userId, $reservationId): bool|null
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("
      UPDATE reservations
      SET status = 'cancelada'
      WHERE user_id = :userId
      AND id = :reservationId
      ");

    $stmt->bindValue(":userId", $userId);
    $stmt->bindValue(":reservationId", $reservationId);

    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->rowCount() > 0;
  }

  /**
   * Check if there is no reservations at the same time and return true if it can be inserted, if not db connection
   * return null,
   * if none is inserted
   * return false
   * @param \Coworking\models\Reservation $reservation
   * @param $roomId
   * @return bool|null
   */
  public static function canBeInserted(Reservation $reservation, $roomId): ?bool
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("
        SELECT 1
        FROM reservations
        WHERE room_id = :roomId
        AND reservation_date = :reservationDate
        AND status LIKE 'confirmada'
        AND (
            (:startTime BETWEEN start_time AND end_time)
            OR (:endTime BETWEEN start_time AND end_time)
            OR (start_time BETWEEN :startTime2 AND :endTime2)
            OR (end_time BETWEEN :startTime3 AND :endTime3)
        )
      ");

    $stmt->bindValue(":roomId", $roomId);
    $stmt->bindValue(":reservationDate", $reservation->getReservationDate());
    $stmt->bindValue(":startTime", $reservation->getStartTime());
    $stmt->bindValue(":endTime", $reservation->getEndTime());
    $stmt->bindValue(":startTime2", $reservation->getStartTime());
    $stmt->bindValue(":endTime2", $reservation->getEndTime());
    $stmt->bindValue(":startTime3", $reservation->getStartTime());
    $stmt->bindValue(":endTime3", $reservation->getEndTime());

    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->rowCount() === 0;
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
  public static function newReservation(Reservation $reservation, $userId, $roomId): ?bool
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