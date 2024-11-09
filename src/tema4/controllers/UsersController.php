<?php

namespace Coworking\controllers;

use Coworking\models\User;
use Coworking\models\UsersModel;
use Coworking\views\LoginView;
use Coworking\views\RegisterView;

class UsersController {
  public static function showLoginForm($error = "") {
    LoginView::render($error);
  }

  public static function showRegisterForm($error = "") {
    RegisterView::render($error);
  }

  public static function register(User $user, $confirmPassword) {
    // Check if password and confirm password are not equals
    if (strcmp($user->getPassword(), $confirmPassword) != 0) {
      header("Location: index.php?action=show_register&error=passwords");
      exit();
    }

    // Check if username or email exist
    $userExist = UsersModel::userExists($user->getUsername(), $user->getEmail());

    // Check if method fail
    if (is_null($userExist)) {
      header("Location: index.php?action=show_register&error=server_error");
      exit();
    }

    if ($userExist) {
      header("Location: index.php?action=show_register&error=user_exist");
      exit();
    }

    // Create the hashed password
    $hashedPass = password_hash($user->getPassword(), PASSWORD_DEFAULT);

    // Check if there is an error creating the hashed password
    if (!$hashedPass) {
      header("Location: index.php?action=show_register&error=server_error");
      exit();
    }

    // Change the user password for hashed password and register
    $user->setPassword($hashedPass);
    $id = UsersModel::register($user);

    // Check if database fail
    if (is_null($registerCompleted)) {
      header("Location: index.php?action=show_register&error=server_error");
      exit();
    }

    $_SESSION["user"] = ["username" => $user->getUsername(), "email" => $user->getEmail(), "id" => $user->getId()];

    header("Location: index.php?action=show_available_rooms");
  }

  public static function login($email, $password) {

  }
}