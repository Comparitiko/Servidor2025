<?php

namespace CoworkingMongo\views;

class NewReservationView
{
  public static function render($woorkRooms, $info): void
  {
    include_once "./views/header.php";
    ?>

    <main class="container p-5">
      <div class="w-50 m-auto pt-4">
        <?php
        if (strlen($info) > 0) {
          $infoMessage = self::getInfoMessage($info);

          if ($infoMessage[0] === "error") echo "<h6 class='text-danger text-center m-4'>" . $infoMessage[1] . "</h6>";
        }
        ?>
        <form class="w-50 m-auto" action="./index.php" method="POST">
          <div class="form-group mb-3">
            <label for="workroom">Sala de trabajo</label>
            <select class="form-select" name="workroom" id="workroom" required>
              <option value="error" selected>Seleccione una sala</option>
              <?php
              if (!$woorkRooms) {
                echo "<h4>Ha surgido un error al recuperar las salas de trabajo que se pueden reservar intentelo de nuevo mas tarde</h4>";
              } else {
              foreach ($woorkRooms as $woorkRoom) {
                ?>
                <option value="<?= $woorkRoom->getId() ?>"><?= $woorkRoom->getName() ?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group mb-3">
            <label for="reservationDate">Fecha de reserva</label>
            <input name="reservation_date" type="date" class="form-control" id="reservationDate" required>
          </div>
          <div class="form-group mb-3">
            <label for="startHour">Hora de inicio</label>
            <select class="form-select" name="start_time" id="startHour" required>
              <option value="error" selected>Seleccione hora de inicio</option>
              <?php
              for ($i = 0; $i < 24; $i++) {
                ?>
                <option value="<?= $i ?>"><?= $i ?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <div class="form-group mb-4">
            <label for="endHour">Hora de fin</label>
            <select class="form-select" name="end_time" id="endHour" required>
              <option value="error" selected>Seleccione hora de fin</option>
              <?php
              for ($i = 0; $i < 24; $i++) {
                ?>
                <option value="<?= $i ?>"><?= $i ?></option>
                <?php
              }
              }
              ?>
            </select>
          </div>
          <button name="new_reservation" type="submit" class="text-center btn btn-primary">Crear reserva</button>
        </form>
      </div>
    </main>
    <script src="./views/assets/js/newReservation.js"></script>
    <?php
    include_once "./views/footer.php";
  }

  private static function getInfoMessage($info): array
  {
    return match ($info) {
      "no_room" => ["error", "Debes de especificar la sala que deseas reservar"],
      "no_start_time" => ["error", "Debes de especificar una hora de inicio de reserva"],
      "no_end_time" => ["error", "Debes de especificar una hora de fin de reserva"],
      "start_gt_end" => ["error", "La hora de inicio de la reserva no puede ser mayor que la hora de fin"],
      "server_error" => ["error", "Ha surgido un error al intentar realizar la reserva, intentelo de nuevo mas tarde"],
      "cant_reservate" => ["error", "Existe una reserva en esa sala a esas horas el mismo dia"]
    };
  }
}