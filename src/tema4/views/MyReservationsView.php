<?php

namespace Coworking\views;

class MyReservationsView
{

  private static function getInfoMessage($info): array
  {
    return match ($info) {
      "cancel_server_error" => ["error", "Error al intentar cancelar la reserva, intente de nuevo mas tarde"],
      "cancel_error" => ["error", "Ha surgido un error al cancelar la reserva"],
      "cancelled_correctly" => ["success", "Reserva cancelada correctamente"],
      "reserved_success" => ["success", "Reservado correctamente"],
    };
  }

  public static function render($reservations, $info)
  {
    include_once "./views/header.php";
    ?>

    <main class="container p-3">
      <h2 class="text-center m-4">Reservas confirmadas del usuario: <?= $_SESSION["user"]["username"] ?></h2>
      <?php
      if (strlen($info) > 0) {
        $infoMessage = self::getInfoMessage($info);

        if ($infoMessage[0] === "error") echo "<h3 class='text-danger text-center m-4'>" . $infoMessage[1] . "</h3>";
        else if ($infoMessage[0] === "success") echo "<h3 class='text-success text-center m-4'>" . $infoMessage[1] . "</h3>";
      }
      ?>

      <?php
      if (count($reservations) == 0) {
        echo "<h4 class='text-center'>No tienes ninguna reserva confirmada</h4>";
      } else {
        ?>
        <!-- Reservation table -->
        <table class="table table-hover w-75 m-auto">
          <thead>
          <th>Nombre de sala</th>
          <th class="text-center">Fecha de reserva</th>
          <th class="text-center">Hora inicio reserva</th>
          <th class="text-center">Hora fin reserva</th>
          <th class="text-center">Acciones</th>
          </thead>
          <tbody>
          <?php
          foreach ($reservations as $reservation) {
            ?>
            <tr>
              <td class="align-middle"><?= $reservation->getRoomName() ?></td>
              <td class="text-center align-middle"><?= $reservation->getReservationDate() ?></td>
              <td class="text-center align-middle"><?= $reservation->getStartTime() ?></td>
              <td class="text-center align-middle"><?= $reservation->getEndTime() ?></td>
              <td class="text-center align-middle">
                <a
                  class="btn btn-danger"
                  href="./index.php?action=cancel_reservation&reservation_id=<?= $reservation->getId() ?>">
                  Cancelar
                </a>
              </td>
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