<?php

namespace BlackJack\models;

class Jugador
{
  private $mano;

  public function __construct()
  {
    $this->mano = [];
  }

  public function nuevaCarta(Carta $carta) {
    $this->mano[] = $carta;
  }

  public function __toString(): string
  {
    $str = "";
    foreach ($this->mano as $carta) {
      $str .= "{$carta} <br>";
    }

    return $str;
  }

  // TODO hacer bien el metodo
  public function valorMano()
  {
    $suma = 0;

    foreach ($this->mano as $carta) {
      $suma += $carta->valor();
    }
    return $suma;
  }

}