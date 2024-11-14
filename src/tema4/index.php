<?php

namespace Coworking;

use Coworking\controllers\ReservationsController;
use Coworking\controllers\UsersController;
use Coworking\controllers\WorkRoomsController;
use Coworking\enums\Status;
use Coworking\models\Reservation;
use Coworking\models\User;

session_start();

/**
 * AUTOLOAD
 */
spl_autoload_register(function ($class) {
  $path = substr($class, strpos($class, "\\") + 1);
  $path = str_replace("\\", "/", $path);
  include_once "./" . $path . ".php";
});

// Router | Controller
if ($_GET) {
  // Handle all GET requests

  // Handle show_register action
  if ($_GET["action"] && strcmp($_GET["action"], "show_register") == 0) {
    $info = $_GET["info"];
    UsersController::showRegisterForm($info);
  }

  // Handle show_login action
  if ($_GET["action"] && strcmp($_GET["action"], "show_login") == 0) {
    $info = $_GET["info"];
    UsersController::showLoginForm($info);
  }

  // Handle logout action
  if ($_GET["action"] && strcmp($_GET["action"], "logout") == 0) {
    UsersController::logout();
  }

  // Handle show_available_rooms action
  if ($_GET["action"] && strcmp($_GET["action"], "show_available_rooms") == 0) {
    WorkRoomsController::showAllWorkRooms();
  }

  // Handle show_reservations of a workroom
  if ($_GET["action"] && strcmp($_GET["action"], "show_reservations") == 0) {
    $roomName = $_GET["room_name"];
    ReservationsController::showFutureAndConfirmedReservationsByRoomName($roomName);
  }

  // Handle show_my_reservations of a workroom
  if ($_GET["action"] && strcmp($_GET["action"], "show_my_reservations") == 0) {
    $info = $_GET["info"];
    ReservationsController::showFutureAndConfirmedReservationsByUserId($info);
  }

  // Handle cancel_reservation of the logged user
  if ($_GET["action"] && strcmp($_GET["action"], "cancel_reservation") == 0) {
    $reservationId = $_GET["reservation_id"];
    ReservationsController::cancelReservationByUserIdAndReservationId($reservationId);
  }

  // Handle show_new_reservation
  if ($_GET["action"] && strcmp($_GET["action"], "show_new_reservation") == 0) {
    $info = $_GET["info"];
    ReservationsController::showNewReservation($info);
  }

} else if ($_POST) {
  // Handle all POST requests

  // Handle submit of the register form
  if (isset($_POST["register"])) {
    $username = $_POST["username"];
    $email = strtolower($_POST["email"]);
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm_password"];
    $phone = $_POST["phone"];
    $user = new User(0, $username, $email, $password, $phone);
    UsersController::register($user, $confirmPassword);
  }

  // Handle submit of the login form
  if (isset($_POST["login"])) {
    $email = strtolower($_POST["email"]);
    $password = $_POST["password"];
    UsersController::login($email, $password);
  }

  if (isset($_POST["new_reserva"])) {
    // Check if user is not logged in
    if (!$_SESSION["user"]) {
      header("Location: index.php");
      exit();
    }

    // Check if are coming default values from form
    if ($_POST["workroom"] === "error") {
      header("Location: index.php?action=show_new_reservation&info=no_room");
      exit();
    }

    if ($_POST["start_time"] === "error") {
      header("Location: index.php?action=show_new_reservation&info=no_start_time");
      exit();
    }

    if ($_POST["end_time"] === "error") {
      header("Location: index.php?action=show_new_reservation&info=no_end_time");
      exit();
    }

    // Check if end_time is grant than start_time
    $startHour = intval($_POST["start_time"]);
    $endHour = intval($_POST["end_time"]);
    if ($startHour > $endHour) {
      header("Location: index.php?action=show_new_reservation&info=start_gt_end");
    }

    $userId = $_SESSION["user"]["id"];
    $roomId = $_POST["workroom"];
    $reservationDate = $_POST["reservation_date"];
    $startTime = $_POST["start_time"] . ":00:00";
    $endTime = $_POST["end_time"] . ":00:00";
    $status = "confirmada";

    $reservation = new Reservation(0, "", "", $reservationDate, $startTime, $endTime);
    $reservation->setStatus($status);

    ReservationsController::createNewReservation($reservation, $userId, $roomId);
  }

} else if ($_SESSION["user"]) {
  // User logged in
  WorkRoomsController::showAllWorkRooms();
} else {
  // User not logged in
  UsersController::showLoginForm();
}