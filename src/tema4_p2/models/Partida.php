<?php

namespace BlackJack\models;

class Partida
{
  private Crupier $crupier;
  private Jugador $jugador;
  private BarajaInglesa $baraja;

  public function __construct()
  {
    $this->crupier = new Crupier();
    $this->jugador = new Jugador();
    $this->baraja = new BarajaInglesa();
    $this->sacarPrimerasCartas();
  }

  /**
   * Funcion para que crupier y jugador saquen una carta cada uno
   * @return void
   */
  private function sacarPrimerasCartas(): void
  {
    $this->pedirCartaCrupier();
    $this->pedirCartaJugador();
  }

  /**
   * Metodo para que el crupier reciba una carta de la baraja
   * @return void
   */
  public function pedirCartaCrupier(): void
  {
    $carta = $this->baraja->repartirCarta();
    $this->crupier->nuevaCarta($carta);
  }

  /**
   * Metodo para que el jugador reciba una carta de la baraja
   * @return void
   */
  public function pedirCartaJugador(): void
  {
    $carta = $this->baraja->repartirCarta();
    $this->jugador->nuevaCarta($carta);
  }

  public function getCrupier(): Crupier
  {
    return $this->crupier;
  }

  public function getJugador(): Jugador
  {
    return $this->jugador;
  }

  /**
   * Metodo para comprobar si hay un ganador, si lo hay devuelve si es victoria, empate o derrota del jugador
   * @return false|string
   */
  public function hayGanador()
  {
    // Comprobar si el jugador y el crupier estan plantados
    if (!$this->jugador->getEstaPlantado() || !$this->crupier->getEstaPlantado()) return false;

    // Hacer las comprobaciones necesarias para saber quien ha ganado la partida y sumar victoria, empate o derrota
    if ($this->jugador->valorMano() > 21 && $this->crupier->valorMano() > 21) return "E";
    else if ($this->jugador->valorMano() > 21) return "D";
    else if ($this->crupier->valorMano() > 21) return "V";
    else if ($this->jugador->valorMano() == $this->crupier->valorMano()) return "E";
    else if ($this->jugador->valorMano() > $this->crupier->valorMano()) return "V";
    else return "D";
  }

}