<?php

namespace CoworkingMongo\views;

class ReservationsView
{

  private static function getInfoMessage($info)
  {
    return match ($info) {
      "server_error" => ["error", "Ha ocurrido un al recuperar las salas, intentelo de nuevo mas tarde."],
    };
  }

  public static function render($reservations, $info)
  {
    include_once "./views/header.php";
    ?>

    <main class="container p-3">
      <h2 class="text-center m-4">Reservas confirmadas de la sala: <?= $_GET["room_name"] ?></h2>

      <?php
      if (strlen($info) > 0) {
        $infoMessage = self::getInfoMessage($info);
        if ($infoMessage[0] == "error") echo "<h3 class='text-danger text-center m-4'>" . $infoMessage[1] . "</h3>";
      }

      if (count($reservations) == 0) {
        echo "<h4 class='text-center m-4'>No hay ninguna reserva para esta sala</h4>";
      } else {
        ?>

        <table class="table table-hover w-75 m-auto">
          <thead>
          <th>Nombre de usuario</th>
          <th class="text-center">Fecha de reserva</th>
          <th class="text-center">Hora inicio reserva</th>
          <th class="text-center">Hora fin reserva</th>
          </thead>
          <tbody>
          <?php
          foreach ($reservations as $reservation) {
            ?>
            <tr>
              <td><?= $reservation->getUserName() ?></td>
              <td class="text-center"><?= $reservation->getReservationDate() ?></td>
              <td class="text-center"><?= $reservation->getStartTime() ?></td>
              <td class="text-center"><?= $reservation->getEndTime() ?></td>
            </tr>
            <?php
          }
          ?>
          </tbody>
        </table>
        <?php
      }
      ?>
    </main>

    <?php
    include_once "./views/footer.php";
  }
}