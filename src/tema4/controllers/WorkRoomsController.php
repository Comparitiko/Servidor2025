<?php

namespace Coworking\controllers;

use Coworking\models\WorkRoomsModel;
use Coworking\views\WorkRoomsView;

class WorkRoomsController {
  public static function showAllWorkRooms(): void
  {
    // Check if user is logged in
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $workRooms = WorkRoomsModel::getAll();

    WorkRoomsView::render($workRooms);
  }
}