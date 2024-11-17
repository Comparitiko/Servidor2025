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

  public function nuevaCarta(Carta $carta): void
  {
    $this->mano[] = $carta;
    $this->sePlanta();
  }

  public function __toString(): string
  {
    $str = "";
    foreach ($this->mano as $carta) {
      $str .= "{$carta} \n";
    }

    return $str;
  }

  protected function sePlanta(): void
  {
    $this->estaPlantado = $this->valorMano() >= 21;
  }

  // Calcular el valor de la mano
  public function valorMano(): int
  {
    $suma = 0;

    foreach ($this->mano as $carta) {
      $suma += $carta->getValor();
    }
    return $suma;
  }

}