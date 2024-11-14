<?php

namespace Coworking\models;

use \PDO;

class WorkRoomsModel
{
  /**
   * Get all workrooms of the database, if not db connection return null, if not workrooms in db return false
   * @return false|array|null
   */
  public static function getAll(): false|array|null
  {
    $connDB = new DBConnection();

    $conn = $connDB->getConnection();

    // Check if there is an error in the connection
    if (is_null($conn)) return null;

    $stmt = $conn->query("SELECT * FROM work_rooms");

    $stmt->setFetchMode(PDO::FETCH_CLASS | PDO::FETCH_PROPS_LATE, 'Coworking\models\WorkRoom');

    $connDB->closeConnection();

    return $stmt->fetchAll();
  }
}