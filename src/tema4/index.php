<?php

  namespace Coworking;

  use Coworking\controllers\UsersController;
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
  if (!isset($_SESSION["user"]) && strcmp($_GET["action"], "show_register") != 0) {
    // User is not logged in and not request the register form view
    UsersController::showLoginForm();
  } else if ($_GET) {
    // Handle GET requests

    // Handle action show_register
    if ($_GET["action"] && strcmp($_GET["action"], "show_register") == 0) {
      $error = $_GET["error"];
      UsersController::showRegisterForm($error);
    }

    // Handle action show_login
    if ($_GET["action"] && strcmp($_GET["action"], "show_login") == 0) {
      $error = $_GET["error"];
      UsersController::showLoginForm();
    }

  } else if ($_POST) {
    // Handle POST requests

    // Handle submit of the register form
    if (isset($_POST["register"])) {
      $username = $_POST["username"];
      $email = $_POST["email"];
      $password = $_POST["password"];
      $confirmPassword = $_POST["confirm_password"];
      $phone = $_POST["phone"];
      $user = new User(0, $username, $email, $password, $phone);
      UsersController::register($user, $confirmPassword);
    }

  }