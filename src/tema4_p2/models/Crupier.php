<?php

namespace BlackJack\models;

class Crupier extends Jugador
{

  public function __construct()
  {
    parent::__construct();
  }

  /**
   * Comprobar si el crupier se plantara
   * @return bool
   */
  public function sePlanta(): bool
  {
    $this->estaPlantado = $this->valorMano() >= 17;
    return $this->estaPlantado;
  }
}