<?php

namespace Coworking\controllers;

use Coworking\models\User;
use Coworking\models\UsersModel;
use Coworking\views\LoginView;
use Coworking\views\RegisterView;

class UsersController {
  public static function showLoginForm($error = ""): void
  {
    // Check if user is logged, if is logged redirect to show_available_rooms
    if ($_SESSION["user"]) {
      header("Location: index.php?action=show_available_rooms");
      exit();
    }

    LoginView::render($error);
  }

  public static function showRegisterForm($error = ""): void
  {
    // Check if user is logged, if is logged redirect to show_available_rooms
    if ($_SESSION["user"]) {
      header("Location: index.php?action=show_available_rooms");
      exit();
    }

    RegisterView::render($error);
  }

  public static function register(User $user, $confirmPassword): void
  {
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
    if (!$id) {
      header("Location: index.php?action=show_register&error=server_error");
      exit();
    }

    // Change user id for the real id
    $user->setId($id);

    // Save in session the user data
    $_SESSION["user"] = ["username" => $user->getUsername(), "email" => $user->getEmail(), "id" => $user->getId()];

    header("Location: index.php?action=show_available_rooms");
  }

  public static function login($email, $password): void
  {
    $user = UsersModel::getUserByEmail($email);

    // Check if user is null
    if (is_null($user)) {
      header("Location: index.php?action=show_login&error=server_error");
      exit();
    }

    if (!$user || !password_verify($password, $user->getPassword())) {
      header("Location: index.php?action=show_login&error=login_fail");
      exit();
    }

    // Save user in session
    $_SESSION["user"] = ["username" => $user->getUsername(), "email" => $user->getEmail(), "id" => $user->getId()];

    header("Location: index.php?action=show_available_rooms");
  }

  public static function logout(): void
  {
    session_destroy();
    header("Location: index.php?action=show_login");
  }
}