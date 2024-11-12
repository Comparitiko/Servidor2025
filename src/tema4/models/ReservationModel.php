<?php

namespace Coworking\models;

use \PDO;
use Coworking\models\Reservation;

class ReservationModel {
  /**
   * Get all future and confirmed reservations by room id, if not db connection return null, if none is found return
   * false
   * @param $roomId
   * @return false|array|null
   */
  public static function getFutureAndConfirmedReservationsByRoomId($roomId): false|array|null
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->query("
      SELECT r.id, u.username as userName, wr.name as roomName, r.reservation_date as reservationDate, r.start_time as startTime, r.end_time as endTime, r.status
      FROM reservations r
      JOIN users u ON r.user_id = u.id
      JOIN work_rooms wr ON r.room_id = wr.id
      WHERE r.reservation_date > NOW()
      AND status LIKE 'confirmada'
      ");

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Coworking\models\Reservation');

    $connDB->closeConnection();

    return $stmt->fetchAll();
  }
}