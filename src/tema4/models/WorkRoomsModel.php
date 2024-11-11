<?php

namespace Coworking\models;

use \PDO;
use Coworking\models\WorkRoom;

class WorkRoomsModel {
  public static function getAll() {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->prepare("SELECT * FROM work_rooms");

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Coworking\models\WorkRoom');
    $stmt->execute();

    $connDB->closeConnection();

    return $stmt->fetchAll();
  }
}