<?php

namespace Coworking;

use Coworking\controllers\ReservationsController;
use Coworking\controllers\UsersController;
use Coworking\controllers\WorkRoomsController;
use Coworking\models\User;

session_start();

/**
 * AUTOLOAD
 */
spl_autoload_register(function ($class) {
  $path = substr($class, strpos($class,"\\")+1);
  $path = str_replace("\\", "/", $path);
  include_once "./" . $path . ".php";
});

// Router | Controller
if ($_GET) {
  // Handle all GET requests

  // Handle show_register action
  if ($_GET["action"] && strcmp($_GET["action"], "show_register") == 0) {
    $error = $_GET["error"];
    UsersController::showRegisterForm($error);
  }

  // Handle show_login action
  if ($_GET["action"] && strcmp($_GET["action"], "show_login") == 0) {
    $error = $_GET["error"];
    UsersController::showLoginForm($error);
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
    $roomId = $_GET["room_id"];
    ReservationsController::showFutureAndConfirmedReservationsByRoomId($roomId);
  }

  // Handle show_my_reservations of a workroom
  if ($_GET["action"] && strcmp($_GET["action"], "show_my_reservations") == 0) {
    ReservationsController::showFutureAndConfirmedReservationsByUserId();
  }

  // Handle cancel_reservation of the logged user
  if ($_GET["action"] && strcmp($_GET["action"], "show_my_reservations") == 0) {
    $reservationId = $_GET["reservation_id"];
    ReservationsController::cancelReservationByUserIdAndReservationId($reservationId);
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

} else if ($_SESSION["user"]) {
  // User logged in
  WorkRoomsController::showAllWorkRooms();
} else {
  // User not logged in
  UsersController::showLoginForm();
}