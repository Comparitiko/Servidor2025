<?php
session_start();

include "lib.php";

if (!isset($_SESSION["baraja"])) $_SESSION["baraja"] = crearBarajaCartas();
if (!isset($_SESSION["cartas-sacadas"])) $_SESSION["cartas-sacadas"] = [];

if ($_GET && $_GET["accion"]) {
  if (strcmp($_GET["accion"], "nueva-carta") == 0) {
    // Pedir una carta y meterla en cartas sacadas de la sesion
    $carta = pedirCarta($_SESSION["baraja"]);
    $_SESSION["cartas-sacadas"][] = $carta;
    ganadorDeLaPartida($_SESSION["cartas-sacadas"]);
  }

  if (strcmp($_GET["accion"], "reset") == 0) {
    // Resetear la partida
    resetPartida($_SESSION["baraja"], $_SESSION["cartas-sacadas"]);
    volverAIndex("?partida-reset=success");
  }
}
