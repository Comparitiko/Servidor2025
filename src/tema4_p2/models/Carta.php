<?php

namespace BlackJack\models;

class Carta
{
  private $palo;
  private $figura;
  private $image;

  /**
   * @param $palo
   * @param $figura
   */
  public function __construct($palo, $figura)
  {
    $this->palo = $palo;
    $this->figura = $figura;
    $this->image = $this->getImageUrl();
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
    return '<img src="' . $this->image . '" alt="' . $this->figura . ' de ' . $this->palo . '">';
  }

  // TODO hacer bien el metodo
  public function getValor()
  {
    return $this->palo;
  }

  private function getImageUrl(): string
  {
    $path = "./views/assets/images/cartas";
    $paloInicial = str_split($this->palo);
    $nombre = "{$this->figura}-" . strtoupper($paloInicial[0]) . ".png";
    return "{$path}/{$nombre}";
  }

}