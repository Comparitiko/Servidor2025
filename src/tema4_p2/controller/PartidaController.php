<?php

namespace BlackJack\controller;

use BlackJack\models\Partida;

class PartidaController
{
  public static function empezarPartida()
  {
    // Comprobar que no haya una partida inicializada, si esta la partida no se inicializa de nuevo
    if (!isset($_SESSION["partida"])) $_SESSION["partida"] = new Partida();

    $partida = $_SESSION["partida"];


  }
}