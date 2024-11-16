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
   * @return void
   */
  protected function sePlanta(): void
  {
    $this->estaPlantado = $this->valorMano() >= 17;
  }
}