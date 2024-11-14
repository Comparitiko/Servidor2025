<?php

namespace BlackJack\models;

class Partida
{
  private $crupier;
  private $jugador;
  private $baraja;

  /**
   * @param $jugadores
   * @param $baraja
   */
  public function __construct()
  {
    $this->crupier = new Jugador();
    $this->jugador = new Jugador();
    $this->baraja = new BarajaInglesa();
  }


}