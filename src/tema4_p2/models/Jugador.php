<?php

namespace BlackJack\models;

class Jugador
{
  protected $mano;
  protected $estaPlantado;

  public function __construct()
  {
    $this->mano = [];
    $this->estaPlantado = false;
  }

  public function getMano(): array
  {
    return $this->mano;
  }

  public function getEstaPlantado(): bool
  {
    return $this->estaPlantado;
  }

  public function plantarse()
  {
    $this->estaPlantado = true;
  }

  public function nuevaCarta(Carta $carta)
  {
    $this->mano[] = $carta;
  }

  public function __toString(): string
  {
    $str = "";
    foreach ($this->mano as $carta) {
      $str .= "{$carta} \n";
    }

    return $str;
  }

  public function sePlanta(): bool
  {
    $this->estaPlantado = $this->valorMano() == 21;
    return $this->estaPlantado;
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