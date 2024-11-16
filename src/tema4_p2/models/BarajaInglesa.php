<?php

namespace BlackJack\models;

class BarajaInglesa extends Baraja
{
  private static $palos = ["corazones", "diamantes, picas", "treboles"];
  private static $figuras = ["A", "2", "3", "4", "5", "6", "7", "8", "9", "J", "Q", "K"];

  public function __construct()
  {
    parent::__construct();
    $this->generarMazo();
    $this->barajar();
  }

  private function generarMazo()
  {
    foreach (self::$palos as $palo) {
      foreach (self::$figuras as $figura) {
        $this->mazo[] = new Carta($palo, $figura);
      }
    }
  }

  public function repartirCarta()
  {
    return array_shift($this->mazo);
  }
}