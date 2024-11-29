<?php

namespace ChatGPTBlogs\controllers;

use ChatGPTBlogs\models\User;
use ChatGPTBlogs\models\UsersModel;
use ChatGPTBlogs\views\AdminDashboardView;
use ChatGPTBlogs\views\AdminLoginView;
use ChatGPTBlogs\views\AdminRegisterView;

class AdminController
{
  public static function showAdminRegister($info = ""): void
  {
    // Check if user is logged in
    if (isset($_SESSION["user"])) {
      header("Location: index.php?action=show_admin_dashboard");
      exit();
    }

    AdminRegisterView::render($info);
  }

  public static function logoutAdmin()
  {
    unset($_SESSION["user"]);
    header("Location: index.php?action=show_admin_login");
  }

  public static function showAdminLogin($info = ""): void
  {
    // Check if user is logged in
    if (isset($_SESSION["user"])) {
      header("Location: index.php?action=show_admin_dashboard");
      exit();
    }

    AdminLoginView::render($info);
  }

  public static function showAdminDashboard(): void
  {
    // Check if user is not logged in
    if (!isset($_SESSION["user"])) {
      header("Location: index.php?action=show_admin_login");
      exit();
    }

    AdminDashboardView::render();
  }

  public static function registerAdmin(User $user, string $confirmPass): void
  {
    // Check if password and confirm_password are equals
    if (strcmp($user->getPassword(), $confirmPass) !== 0) {
      header("Location: index.php?action=show_admin_register&info=passwords");
      exit();
    }

    $userExists = UsersModel::userExists($user->getEmail());

    // Check if database connection fail
    if (is_null($userExists)) {
      header("Location: index.php?action=show_admin_register&info=server_error");
      exit();
    }

    // Check if user already exists
    if ($userExists) {
      header("Location: index.php?action=show_admin_register&info=user_exists");
      exit();
    }

    $user->setPassword(password_hash($user->getPassword(), PASSWORD_DEFAULT));

    // If all is ok, create user
    $id = UsersModel::register($user);

    // Check if database connection fail
    if (is_null($id)) {
      header("Location: index.php?action=show_admin_register&info=server_error");
      exit();
    }

    // Check if user is inserted
    if (!$id) {
      header("Location: index.php?action=show_admin_register&info=server_error");
      exit();
    }

    // Save user in session
    $_SESSION["user"] = ["name" => $user->getName(), "email" => $user->getEmail(), "id" => $user->getId()];

    header("Location: index.php?action=show_admin_login");
    exit();
  }

  public static function loginAdmin($email, $password): void
  {
    $user = UsersModel::getUserByEmail($email);

    // Check if database connection fail
    if (is_null($user)) {
      header("Location: index.php?action=show_admin_login&info=server_error");
      exit();
    }

    // Check if user does not exist
    if (!$user) {
      header("Location: index.php?action=show_admin_login&info=invalid_login");
      exit();
    }

    // Check if password is correct
    if (!password_verify($password, $user->getPassword())) {
      header("Location: index.php?action=show_admin_login&info=invalid_login");
      exit();
    }

    // Save user in session
    $_SESSION["user"] = ["name" => $user->getName(), "email" => $user->getEmail(), "id" => $user->getId()];

    header("Location: index.php?action=show_admin_dashboard");
  }
}