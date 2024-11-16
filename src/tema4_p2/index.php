<?php

namespace BlackJack;

use BlackJack\controller\PartidaController;

session_start();

/**
 * AUTOLOAD
 */
spl_autoload_register(function ($class) {
  $path = substr($class, strpos($class, "\\") + 1);
  $path = str_replace("\\", "/", $path);
  include_once "./" . $path . ".php";
});


if ($_GET) {
  if ($_GET["accion"] === "nueva_partida") {
    // // Resetear la partida
    PartidaController::nuevaPartida();
  } else if ($_GET["accion"] === "pedir_carta") {
    // Pedir una nueva carta
    PartidaController::pedirCarta();
  } else if ($_GET["accion"] === "plantarse") {
    // Plantarse
    PartidaController::plantarse();
  } else if ($_GET["accion"] === "victoria") {
    // Mostrar resultado de victoria
    PartidaController::mostrarResultado("V");
  } else if ($_GET["accion"] === "empate") {
    // Mostrar resultado de empate
    PartidaController::mostrarResultado("E");
  } else if ($_GET["accion"] === "derrota") {
    // Mostrar resultado de derrota
    PartidaController::mostrarResultado("D");
  } else {
    // Empezar a jugar
    PartidaController::empezarPartida();
  }
} else {
  PartidaController::empezarPartida();
}