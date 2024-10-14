<?php
  session_start();
  include "lib.php";

if ($_POST) {
  // Login form post
  if (isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    login($_POST["email"], $_POST["password"]);
  }
};

if ($_GET) {
  // Cerrar sesión
  if (isset($_GET["accion"]) && strcmp($_GET["accion"], "logout") == 0) session_destroy();
}