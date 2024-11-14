<?php

namespace Coworking\views;

use Coworking\models\WorkRoom;

class WorkRoomsView
{

  private static function getInfoMessage($info) {
    return match ($info) {
      "server_error" => ["error", "Ha ocurrido un al recuperar las salas, intentelo de nuevo mas tarde."],
    };
  }

  public static function render($workRooms, $info)
  {
    include_once "./views/header.php";
    ?>

    <main class="container p-3">
      <h2 class="text-center m-5">Salas disponibles</h2>
      <?php

      if (strlen($info) > 0) {
        $infoMessage = self::getInfoMessage($info);
        if ($infoMessage[0] == "error") echo "<h3 class='text-danger text-center m-4'>" . $infoMessage[1] . "</h3>";
      }

      if (count($workRooms) == 0) {
        echo "<h3>No hay ninguna sala</h3>";
      } else {
        ?>
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
        <?php
      }
      ?>
    </main>

    <?php
    include_once "./views/footer.php";
  }
}