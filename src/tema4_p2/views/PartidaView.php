<?php

namespace BlackJack\views;

use BlackJack\models\Partida;
use BlackJack\views\components\SeccionJugadorComponent;

class PartidaView
{
  public static function render(Partida $partida, $resultado = ""): void
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
          background-image: url("./views/assets/images/tablero-blackjack.webp");
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

        .resultado {
          opacity: 85%;
          width: fit-content;
          margin: 1rem auto;
          padding: 5px 10px;
        }
      </style>
    </head>
    <body class="min-vh-100">
    <header
      class="w-100 d-flex justify-content-center align-items-center p-3 text-white bg-black">
      <h1>BlackJack</h1>
    </header>
    <main>
      <div class="pt-1 d-flex flex-column gap-5">
        <!--Pintar la seccion del jugador y el crupier-->
        <?php
        SeccionJugadorComponent::render("Crupier", $partida->getCrupier());
        SeccionJugadorComponent::render("Jugador", $partida->getJugador());
        ?>
      </div>
      <div class="d-flex gap-5 justify-content-center pt-3 mt-3 flex-wrap">
        <a class="btn btn-primary <?= strlen($resultado) > 0 ? "disabled" : "" ?>" href="index.php?accion=pedir_carta">Pedir
          carta</a>
        <a class="btn btn-dark <?= strlen($resultado) > 0 ? "disabled" : "" ?>" href="index.php?accion=plantarse">Plantarse</a>
        <a class="btn btn-danger" href="index.php?accion=nueva_partida">Nueva partida</a>
      </div>
    </main>
    <?php
    if (strlen($resultado) > 0) {
      ?>
      <div class="resultado bg-black text-white">
        <?php if ($resultado == "V") { ?>
          <h2>Has ganado enhorabuena</h2>
        <?php } else if ($resultado == "E") { ?>
          <h2>Has empatado</h2>
        <?php } else { ?>
          <h2>Has perdido sigue intentandolo</h2>
        <?php } ?>
      </div>
      <?php
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
            crossorigin="anonymous"></script>
    </body>
    </html>
    <?php
  }
}