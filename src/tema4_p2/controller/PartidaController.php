<?php

namespace BlackJack\controller;

use BlackJack\models\Partida;
use BlackJack\views\PartidaView;
use JetBrains\PhpStorm\NoReturn;

class PartidaController
{
  // Desserializar la clase partida de la session
  private static function unserializePartida(): Partida
  {
    return unserialize($_SESSION["partida"], ["allowed_classes" => true]);
  }

  public static function empezarPartida(): void
  {
    // Verificar si existe la partida en la sesión y, si no, crear una nueva instancia
    if (!isset($_SESSION["partida"])) {
      // Serializar el objeto y guárdalo en la sesión
      $_SESSION["partida"] = serialize(new Partida());
    }
    // Deserializar el objeto para usarlo
    $partida = self::unserializePartida();

    PartidaView::render($partida);
  }

  #[NoReturn] public static function nuevaPartida(): void
  {
    session_destroy();
    header("Location: index.php");
    exit();
  }

  #[NoReturn] public static function plantarse(): void
  {
    $partida = self::unserializePartida();

    // Plantar al jugador
    $partida->getJugador()->plantarse();

    // Hacer que el crupier pida cartas hasta que este plantado
    while (!$partida->getCrupier()->getEstaPlantado()) {
      $partida->pedirCartaCrupier();
    }

    // Comprobar si hay un ganador, si lo hay ver si es victoria, empate o derrota del jugador
    $ganador = $partida->hayGanador();


    header("Location: index.php");
    exit();
  }

  #[NoReturn] public static function pedirCarta(): void
  {
    header("Location: index.php");
    exit();
  }

  public static function mostrarResultado($ganador)
  {
    $partida = self::unserializePartida();
    PartidaView::render($partida, $ganador);
  }
}