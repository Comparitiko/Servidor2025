<?php

namespace Coworking\controllers;

use Coworking\models\ReservationModel;
use Coworking\views\MyReservationsView;
use Coworking\views\ReservationsView;

class ReservationsController
{
  public static function showFutureAndConfirmedReservationsByRoomName($roomName): void
  {

    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }
    $reservations = ReservationModel::getFutureAndConfirmedReservationsByRoomName($roomName);
    ReservationsView::render($reservations);
  }

  public static function showFutureAndConfirmedReservationsByUserId($info = ""): void
  {
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $reservations = ReservationModel::getFutureAndConfirmedReservationsByUserId($_SESSION["user"]["id"]);
    MyReservationsView::render($reservations, $info);
  }

  public static function cancelReservationByUserIdAndReservationId($reservationId): void
  {
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $modifiedCorrectly = ReservationModel::cancelReservationByUserIdAndReservationId($_SESSION["user"]["id"],
      $reservationId);

    if (is_null($modifiedCorrectly)) {
      header("Location: index.php?action=show_my_reservations&info=cancel_server_error");
      exit();
    }

    if (!$modifiedCorrectly) {
      header("Location: index.php?action=show_my_reservations&info=cancel_error");
      exit();
    }

    header("Location: index.php?action=show_my_reservations&info=cancelled_correctly");
    exit();
  }
}