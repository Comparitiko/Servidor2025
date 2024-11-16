<?php

namespace BlackJack;

use BlackJack\controller\PartidaController;

session_start();
//session_destroy();

/**
 * AUTOLOAD
 */
spl_autoload_register(function ($class) {
  $path = substr($class, strpos($class, "\\") + 1);
  $path = str_replace("\\", "/", $path);
  include_once "./" . $path . ".php";
});


if ($_GET) {
  // Resetear la partida
  if ($_GET["accion"] === "resetear") {
    session_destroy();
    header("Location: index.php");
    exit();
  }
} else {
  PartidaController::empezarPartida();
}