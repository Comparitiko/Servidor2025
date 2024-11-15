<?php

namespace BlackJack\views;

use BlackJack\models\Partida;

class PartidaView
{
  public function render(Partida $partida)
  {
    ?>
    <!doctype html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
            integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
      <title>BlackJack</title>
    </head>
    <body>
    <header>
      <h1>BlackJack</h1>
      <div>
        <h3>Victorias <span><?= $partida->getVictoriasJugador() ?></span></h3>
        <h3>Empates <span><?= $partida->getEmpatesJugador() ?></span></h3>
        <h3>Derrotas <span><?= $partida->getDerrotasJugador() ?></span></h3>
      </div>
    </header>
    <main>

    </main>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
  }
}