<?php

namespace Coworking\controllers;

use Coworking\enums\Status;
use Coworking\models\Reservation;
use Coworking\models\ReservationModel;
use Coworking\views\ReservationsView;

class ReservationsController {
  public static function showFutureAndConfirmedReservationsByRoomId($roomId): void
  {

    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }
    $reservations = ReservationModel::getFutureAndConfirmedReservationsByRoomId($roomId);
    ReservationsView::render($reservations);
  }
}