<?php

namespace CoworkingMongo\controllers;

use CoworkingMongo\models\Reservation;
use CoworkingMongo\models\ReservationModel;
use CoworkingMongo\models\WorkRoomsModel;
use CoworkingMongo\views\MyReservationsView;
use CoworkingMongo\views\NewReservationView;
use CoworkingMongo\views\ReservationsView;

class ReservationsController
{
  public static function showFutureAndConfirmedReservationsByRoomName($roomName, $info = ""): void
  {
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $reservations = ReservationModel::getFutureAndConfirmedReservationsByRoomName($roomName);

    if (is_null($reservations)) {
      header("Location: index.php?action=show_reservations&room_name=$roomName&info=server_error");
      exit();
    }

    ReservationsView::render($reservations, $info);
  }

  public static function showFutureAndConfirmedReservationsByUserId($info = ""): void
  {
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $reservations = ReservationModel::getFutureAndConfirmedReservationsByUserName($_SESSION["user"]["username"]);
    MyReservationsView::render($reservations, $info);
  }

  public static function cancelReservationByUserIdAndReservationId($reservationId): void
  {
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $modifiedCorrectly = ReservationModel::cancelReservationByUserNameAndReservationId($_SESSION["user"]["username"],
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

  public static function showNewReservation($info = ""): void
  {
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    $woorkRooms = WorkRoomsModel::getAll();

    NewReservationView::render($woorkRooms, $info);
  }

  public static function createNewReservation(Reservation $reservation, $username, $room_name): void
  {
    $canInsert = ReservationModel::canBeInserted($reservation, $room_name);

    if (is_null($canInsert)) {
      header("Location: index.php?action=show_new_reservation&info=server_error");
      exit();
    }

    if (!$canInsert) {
      header("Location: index.php?action=show_new_reservation&info=cant_reservate");
      exit();
    }

    $isInserted = ReservationModel::newReservation($reservation, $username, $room_name);

    if (!$isInserted) {
      header("Location: index.php?action=show_new_reservation&info=server_error");
      exit();
    }

    header("Location: index.php?action=show_my_reservations&info=reserved_success");
  }
}