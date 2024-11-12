<?php

namespace Coworking\controllers;

use Coworking\models\ReservationModel;
use Coworking\views\MyReservationsView;
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

  public static function showFutureAndConfirmedReservationsByUserId(): void
  {
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $reservations = ReservationModel::getFutureAndConfirmedReservationsByUserId($_SESSION["user"]["id"]);
    MyReservationsView::render($reservations);
  }
}