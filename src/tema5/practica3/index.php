<?php

namespace ChatGPTBlogs;

require "./vendor/autoload.php";

/**
 * AUTOLOAD
 */
spl_autoload_register(function ($class) {
  $path = substr($class, strpos($class, "\\") + 1);
  $path = str_replace("\\", "/", $path);
  include_once "./" . $path . ".php";
});

use ChatGPTBlogs\controllers\AdminController;
use ChatGPTBlogs\controllers\ArticlesController;
use ChatGPTBlogs\models\User;

session_start();

if ($_GET) {
  if ($_GET["action"] === "show_admin_register") {
    AdminController::showAdminRegister($_GET["info"]);
  }

  if ($_GET["action"] === "show_admin_login") {
    AdminController::showAdminLogin($_GET["info"]);
  }

  if ($_GET["action"] === "admin_logout") {
    AdminController::logoutAdmin();
  }

  if ($_GET["action"] === "show_admin_dashboard") {
    AdminController::showAdminDashboard();
  }
} else if ($_POST) {
  if ($_POST["register_form"]) {
    // Handle register form
    $user = new User($_POST["name"], $_POST["email"], $_POST["password"]);
    AdminController::registerAdmin($user, $_POST["confirm_password"]);
  }

  if ($_POST["login_form"]) {
    // Handle login form
    AdminController::loginAdmin($_POST["email"], $_POST["password"]);
  }

  if ($_POST["new_article"]) {
    // Handle new article form
    ArticlesController::insertArticle($_POST["title"] ?? "", $_POST["content"] ?? "", $_POST["image"] ?? "");
  }

} else {
  ArticlesController::showArticles($_GET["info"]);
}
