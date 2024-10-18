<?php
  session_start();
  include "lib.php";

if ($_POST) {
  // Login form post
  if (isset($_POST["login"]) && isset($_POST["email"]) && isset($_POST["password"])) {
    return login($_POST["email"], $_POST["password"]);
  }
};

if ($_GET) {
  // Cerrar sesión
  if (isset($_GET["accion"]) && strcmp($_GET["accion"], "logout") == 0) {
    session_destroy();
    return header("Location: login.php");
  };
  // Eliminar un proyecto
  if (isset($_GET["accion"]) && strcmp($_GET["accion"], "delete-project") == 0) {
    if (!isset($_GET["id"])) return header("Location: proyectos.php?error=deleting-project");
    $id = $_GET["id"];
    removeProjectById($id);

    header("Location: proyectos.php?info=success-delete-project");
  }
}