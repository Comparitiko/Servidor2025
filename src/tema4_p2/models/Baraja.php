<?php

namespace BlackJack\models;

abstract class Baraja
{
  protected array $mazo;

  public function __construct()
  {
    $this->mazo = [];
  }


  public abstract function repartirCarta();

  public function barajar()
  {
    shuffle($this->mazo);
  }

  public function listar()
  {
    foreach ($this->mazo as $carta) {
      echo "{$carta} <br>";
    }
  }
}