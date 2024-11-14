<?php

namespace Coworking\views;

class NewReservationView {
  private static function getInfoMessage($info): array
  {
    return match ($info) {
      "cancel_server_error" => ["error", "Error al intentar cancelar la reserva, intente de nuevo mas tarde"],
    };
  }

  public static function render($woorkRooms, $info): void
  {
    include_once "./views/header.php";
    ?>

    <main class="container p-5">
      <div class="w-50 m-auto pt-4">
        <form class="w-50 m-auto" action="./index.php" method="POST">
          <div class="form-group mb-3">
            <label for="workroom">Sala de trabajo</label>
            <select class="form-select" name="workroom" id="workroom" required>
              <option value="error" selected>Seleccione una sala</option>
              <?php
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
                for($i = 0; $i < 24; $i++) {
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
              for($i = 0; $i < 24; $i++) {
                ?>
                <option value="<?= $i ?>"><?= $i ?></option>
                <?php
              }
              ?>
            </select>
          </div>
          <button name="new_reserva" type="submit" class="text-center btn btn-primary">Crear reserva</button>
        </form>
      </div>
    </main>
    <script src="./views/assets/js/newReservation.js"></script>
    <?php
    include_once "./views/footer.php";
  }
}