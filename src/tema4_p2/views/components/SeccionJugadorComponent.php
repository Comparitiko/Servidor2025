<?php

namespace BlackJack\views\components;

class SeccionJugadorComponent
{
  // Pintar la seccion del jugador con su nombre (Jugador, Crupier) y las cartas de su mano
  public static function render($nomJugador, $cartas): void
  {
    ?>
    <section>
      <h4 class="m-auto text-center bg-black section-title text-white fs-2"><?= $nomJugador ?></h4>
      <div class="d-flex flex-wrap w-50 m-auto">
        <?php
        if ($nomJugador === "Crupier" && count($cartas) === 1) {
          ?>
          <img width="113px" height="142px" src="./views/assets/images/dorso-rojo.svg" alt="">
          <?php
        }
        foreach ($cartas as $carta) {
          echo $carta;
        }
        ?>
      </div>
    </section>
    <?php
  }
}