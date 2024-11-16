<?php

namespace BlackJack\views;

use BlackJack\models\Partida;
use BlackJack\views\components\SeccionJugadorComponent;

class PartidaView
{
  public static function render(Partida $partida): void
  {
    ?>
    <!doctype html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <title>BlackJack Gabriel</title>
      <style>
        body {
          background-image: url("./views/assets/images/tablero-blackjack-2.webp");
          background-position: center;
        }

        header {
          opacity: 85%;
        }

        .section-title {
          width: fit-content;
          padding: 5px 10px;
          border-radius: 10px;
          opacity: 80%;
        }
      </style>
    </head>
    <body class="min-vh-100">
    <header
      class="position-absolute w-100 d-flex justify-content-between align-items-center p-3 text-white bg-black">
      <h1>BlackJack</h1>
      <div class="d-flex gap-5">
        <h3>Victorias: <span class="text-success"><?= $partida->getVictoriasJugador() ?></span></h3>
        <h3>Empates: <span class="text-warning"><?= $partida->getEmpatesJugador() ?></span></h3>
        <h3>Derrotas: <span class="text-danger"><?= $partida->getDerrotasJugador() ?></span></h3>
      </div>
    </header>
    <main class="pt-5">
      <div class="pt-5 d-flex flex-column gap-5">
        <!--Pintar la seccion del jugador y el crupier-->
        <?php
        SeccionJugadorComponent::render("Crupier", $partida->getCrupier()->getMano());
        SeccionJugadorComponent::render("Jugador", $partida->getJugador()->getMano());
        ?>
      </div>
      <div class="d-flex gap-5 justify-content-center pt-3 mt-3">
        <a class="btn btn-primary" href="index.php?accion=pedir_carta">Pedir carta</a>
        <a class="btn btn-dark" href="index.php?accion=plantarse">Plantarse</a>
        <a class="btn btn-danger" href="index.php?accion=resetear">Resetear</a>
      </div>
    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
  }
}