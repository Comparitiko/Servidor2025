<?php

namespace BlackJack\views\components;

use BlackJack\models\Jugador;

class SeccionJugadorComponent
{
  // Pintar la seccion del jugador con su nombre (Jugador, Crupier) y las cartas de su mano
  public static function render($nomJugador, Jugador $jugador): void
  {
    ?>
    <section class="d-grid gap-3">
      <h4 class="m-auto text-center bg-black section-title text-white fs-2"><?= $nomJugador ?></h4>
      <div class="d-flex flex-wrap w-50 m-auto gap-3">
        <?php
        if ($nomJugador === "Crupier" && count($jugador->getMano()) === 1) {
          ?>
          <img width="113px" height="142px" src="./views/assets/images/dorso-rojo.svg" alt="">
          <?php
        }
        echo $jugador;
        ?>
      </div>
    </section>
    <?php
  }
}