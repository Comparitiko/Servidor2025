<?php

namespace CoworkingMongo\models;

use CoworkingMongo\enums\Collections;
use PDO;

class WorkRoomsModel
{
  /**
   * Get all workrooms of the database, if not db connection return null, if not workrooms in db return false
   * @return false|array|null
   */
  public static function getAll(): false|array|null
  {
    $conn = new DBConnection();

    $workRoomsCollection = $conn->getCollection(Collections::WORK_ROOMS);

    // Check if there is an error in the connection
    if (is_null($workRoomsCollection)) return null;

    // Convert documents in objects of type WorkRoom
    $workRooms = $workRoomsCollection->find([], [
      'typeMap' => [
        'root' => WorkRoom::class, // Devuelve los documentos como objetos
      ],
    ]);

    $conn->closeConnection();

    return $workRooms->toArray();
  }
}