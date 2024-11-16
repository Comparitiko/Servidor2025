<?php

namespace BlackJack\models;

class Partida
{
  private Crupier $crupier;
  private Jugador $jugador;
  private BarajaInglesa $baraja;

  private $victoriasJugador;
  private $empatesJugador;
  private $derrotasJugador;

  public function __construct()
  {
    $this->crupier = new Crupier();
    $this->jugador = new Jugador();
    $this->baraja = new BarajaInglesa();
    $this->victoriasJugador = 0;
    $this->empatesJugador = 0;
    $this->derrotasJugador = 0;
    $this->sacarPrimerasCartas();
  }

  private function sacarPrimerasCartas()
  {
    $this->pedirCartaCrupier();
    $this->pedirCartaJugador();
  }

  public function pedirCartaCrupier()
  {
    $carta = $this->baraja->repartirCarta();
    $this->crupier->nuevaCarta($carta);
  }

  public function pedirCartaJugador()
  {
    $carta = $this->baraja->repartirCarta();
    $this->jugador->nuevaCarta($carta);
  }

  public function getVictoriasJugador(): int
  {
    return $this->victoriasJugador;
  }

  public function setVictoriasJugador(int $victoriasJugador): void
  {
    $this->victoriasJugador = $victoriasJugador;
  }

  public function getEmpatesJugador(): int
  {
    return $this->empatesJugador;
  }

  public function setEmpatesJugador(int $empatesJugador): void
  {
    $this->empatesJugador = $empatesJugador;
  }

  public function getDerrotasJugador(): int
  {
    return $this->derrotasJugador;
  }

  public function setDerrotasJugador(int $derrotasJugador): void
  {
    $this->derrotasJugador = $derrotasJugador;
  }

  public function getCrupier(): Crupier
  {
    return $this->crupier;
  }

  public function getJugador(): Jugador
  {
    return $this->jugador;
  }

  public function hayGanador()
  {
    // Comprobar si el jugador y el crupier estan plantados
    if (!$this->jugador->getEstaPlantado() || !$this->crupier->getEstaPlantado()) return;

    // Hacer las comprobaciones necesarias para saber quien ha ganado la partida y sumar victoria, empate o derrota
    if ($this->jugador->valorMano() > 21 && $this->crupier->valorMano() > 21) $this->empatesJugador++;
    else if ($this->jugador->valorMano() > 21) $this->derrotasJugador++;
    else if ($this->crupier->valorMano() > 21) $this->victoriasJugador++;
    else if ($this->jugador->valorMano() == $this->crupier->valorMano()) $this->empatesJugador++;
    else if ($this->jugador->valorMano() > $this->crupier->valorMano()) $this->victoriasJugador++;
    else $this->derrotasJugador++;
  }

}