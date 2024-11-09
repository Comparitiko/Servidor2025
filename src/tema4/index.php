<?php

  namespace Coworking;

  use Coworking\controllers\UsersController;
  use Coworking\models\User;
  use Coworking\views\LoginView;

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

    // Handle action show_register
    if ($_GET["action"] && strcmp($_GET["action"], "show_register") == 0) {
      $error = $_GET["error"];
      UsersController::showRegisterForm($error);
    }

    // Handle action show_login
    if ($_GET["action"] && strcmp($_GET["action"], "show_login") == 0) {
      $error = $_GET["error"];
      UsersController::showLoginForm($error);
    }

    // Handle GET request that need user logged in
    if ($_SESSION["user"]) {
      if ($_GET["action"] && strcmp($_GET["action"], "show_available_rooms") == 0) {
        var_dump($_SESSION["user"]);
      }
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

    // Handle POST request that need user logged in
    if ($_SESSION["user"]) {

    }

  } else if ($_SESSION["user"]) {
    // User logged in

  } else {
    // User not logged in
    UsersController::showLoginForm();
  }