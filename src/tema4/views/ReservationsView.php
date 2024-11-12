<?php

namespace Coworking\views;

class ReservationsView {
  public static function render($reservations) {
    include_once "./views/header.php";
    ?>

    <main class="container p-3">
      <h2 class="text-center m-4">Reservas confirmadas de la sala: <?=$reservations[0]->getRoomName()?></h2>
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
            <td><?=$reservation->getUserName()?></td>
            <td class="text-center"><?=$reservation->getReservationDate()?></td>
            <td class="text-center"><?=$reservation->getStartTime()?></td>
            <td class="text-center"><?=$reservation->getEndTime()?></td>
          </tr>
          <?php
        }
        ?>
        </tbody>
      </table>
    </main>

    <?php
    include_once "./views/footer.php";
  }
}