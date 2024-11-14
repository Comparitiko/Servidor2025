<?php

namespace BlackJack\models;

class Carta
{
  private $palo;
  private $figura;

  /**
   * @param $palo
   * @param $figura
   */
  public function __construct($palo, $figura)
  {
    $this->palo = $palo;
    $this->figura = $figura;
  }

  /**
   * @return mixed
   */
  public function getPalo()
  {
    return $this->palo;
  }

  /**
   * @param mixed $palo
   */
  public function setPalo($palo): void
  {
    $this->palo = $palo;
  }

  /**
   * @return mixed
   */
  public function getFigura()
  {
    return $this->figura;
  }

  /**
   * @param mixed $figura
   */
  public function setFigura($figura): void
  {
    $this->figura = $figura;
  }

  public function __toString(): string
  {
    return "{$this->getPalo()} - {$this->getFigura()}";
  }

  public function getValor()
  {

  }

}