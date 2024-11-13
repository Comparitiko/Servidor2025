<?php

namespace Coworking\models;

use \PDO;
use Coworking\models\Reservation;

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
}