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

  /**
   * Empezar la partida
   * @return void
   */
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

  /**
   * Reiniciar la partida
   * @return void
   */
  #[NoReturn] public static function nuevaPartida(): void
  {
    session_destroy();
    header("Location: index.php");
    exit();
  }

  /**
   * Plantar al jugador
   * @return void
   */
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

    if ($ganador === "V") $resultado = "victoria";
    else if ($ganador === "E") $resultado = "empate";
    else $resultado = "derrota";

    $_SESSION["partida"] = serialize($partida);

    header("Location: index.php?accion={$resultado}");
    exit();
  }

  /**
   * Pedir una carta para el jugador y comprobar si se ha pasado o esta en 21
   * @return void
   */
  #[NoReturn] public static function pedirCarta(): void
  {
    $partida = self::unserializePartida();

    // Pedir carta para el jugador
    $partida->pedirCartaJugador();

    // Comprobar si se ha pasado de 21 o es igual que 21 para no permitirle sacar mas y automaticamente se plante
    // Guardar la partida serializada
    $_SESSION["partida"] = serialize($partida);

    if ($partida->getJugador()->getEstaPlantado()) {
      header("Location: index.php?accion=plantarse");
      exit();
    }

    header("Location: index.php");
    exit();
  }

  public static function mostrarResultado($resultado)
  {
    $partida = self::unserializePartida();
    PartidaView::render($partida, $resultado);
  }
}