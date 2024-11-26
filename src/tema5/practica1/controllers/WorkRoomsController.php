<?php

namespace CoworkingMongo\controllers;

use CoworkingMongo\models\WorkRoomsModel;
use CoworkingMongo\views\WorkRoomsView;

class WorkRoomsController
{
  public static function showAllWorkRooms($info = ""): void
  {
    // Check if user is logged in
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $workRooms = WorkRoomsModel::getAll();

    if (is_null($workRooms)) {
      header("Location: index.php?action=show_available_rooms&info=server_error");
      exit();
    }

    WorkRoomsView::render($workRooms, $info);
  }
}