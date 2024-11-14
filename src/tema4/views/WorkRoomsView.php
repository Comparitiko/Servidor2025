<?php

namespace Coworking\views;

use Coworking\models\WorkRoom;

class WorkRoomsView
{
  public static function render($workRooms)
  {
    include_once "./views/header.php";
    ?>

    <main class="container p-3">
      <h2 class="text-center m-5">Salas disponibles</h2>
      <table class="table table-hover w-75 m-auto">
        <thead>
        <th>Nombre</th>
        <th class="text-center">Capacidad</th>
        <th class="text-center">Localización</th>
        <th class="text-center">Acciones</th>
        </thead>
        <tbody>
        <?php
        foreach ($workRooms as $workRoom) {
          ?>
          <tr>
            <td><?= $workRoom->getName() ?></td>
            <td class="text-center"><?= $workRoom->getCapacity() ?></td>
            <td class="text-center"><?= $workRoom->getLocation() ?></td>
            <td class="text-center">
              <a href="./index.php?action=show_reservations&room_name=<?= $workRoom->getName() ?>" class="btn
              btn-outline-dark">Ver
                reservas</a>
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