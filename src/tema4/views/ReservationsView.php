<?php

namespace Coworking\views;

class ReservationsView {
  public static function render($reservations) {
    include_once "./views/header.php";
    ?>

    <main class="container p-3">
      <table class="table table-hover w-75 m-auto">
        <thead>
        <th>Nombre</th>
        <th class="text-center">Capacidad</th>
        <th class="text-center">Localización</th>
        </thead>
        <tbody>
        <?php
        foreach ($reservations as $reservation) {
          ?>
          <tr>
            <td><?=$reservation->getUserName()?></td>
            <td class="text-center"><?=$reservation->getRoomName()?></td>
            <td class="text-center"><?=$reservation->getStatus()->value?></td>
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