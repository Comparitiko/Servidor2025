<?php

namespace BlackJack\controller;

use BlackJack\models\Partida;
use BlackJack\views\PartidaView;

class PartidaController
{
  public static function empezarPartida()
  {
    // Verificar si existe la partida en la sesión y, si no, crear una nueva instancia
    if (!isset($_SESSION["partida"])) {
      $partida = new Partida();
      // Serializar el objeto y guárdalo en la sesión
      $_SESSION["partida"] = serialize($partida);
    } else {
      // Deserializar el objeto para usarlo en esta instancia
      $partida = unserialize($_SESSION["partida"], ["allowed_classes" => true]);
    }

    PartidaView::render($partida);
  }
}