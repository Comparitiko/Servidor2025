<?php

namespace Coworking\views;

class MyReservationsView {
  public static function render($reservations) {
    include_once "./views/header.php";
    ?>

    <main class="container p-3">
      <h2 class="text-center m-4">Reservas confirmadas del usuario: <?=$reservations[0]->getUserName()?></h2>
      <table class="table table-hover w-75 m-auto">
        <thead>
        <th>Nombre de usuario</th>
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
            <td class="align-middle"><?=$reservation->getUserName()?></td>
            <td class="text-center align-middle"><?=$reservation->getReservationDate()?></td>
            <td class="text-center align-middle"><?=$reservation->getStartTime()?></td>
            <td class="text-center align-middle"><?=$reservation->getEndTime()?></td>
            <td class="text-center align-middle">
              <a
                class="btn btn-danger"
                href="./index.php?action=cancel_reservation&reservation_id=<?=$reservation->getId()?>">
                Cancelar
              </a>
            </td>
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