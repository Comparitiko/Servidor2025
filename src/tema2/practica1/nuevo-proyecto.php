  <?php
  $title = "Create a new project";
  include( "cabecera.php")
  ?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item">Dashboard</li>
          <li class="breadcrumb-item active">Nuevo proyecto</li>
        </ol>
        <div class="container w-50">
          <form action="controlador.php" method="post">
            <h2>Crear un proyecto</h2>
            <div class="mb-3">
              <label for="nombre" class="form-label">Nombre proyecto</label>
              <input type="text" class="form-control" id="nombre" name="nombre" required>
            </div>
            <div class="mb-3">
              <label for="fecha-inicio" class="form-label">Fecha inicio</label>
              <input type="date" class="form-control" id="fecha-inicio" name="fecha-inicio" required >
            </div>
            <div class="mb-3">
              <label for="fecha-fin" class="form-label">Fecha fin</label>
              <input type="date" class="form-control" id="fecha-fin" name="fecha-fin" required>
            </div>
            <div class="mb-3">
              <label for="porcentaje-completado" class="form-label">Porcentaje completado</label>
              <input type="number" class="form-control" id="porcentaje-completado" name="porcentaje-completado"
                     required min="0" max="100">
            </div>
            <div class="mb-3">
              <label for="importancia" class="form-label">Importancia</label>
              <input type="number" class="form-control" id="importancia" name="importancia" required min="1" max="5">
            </div>
            <button type="submit" class="btn btn-primary" name="nuevo-proyecto">Submit</button>
          </form>
        </div>
      </div>
    </main>
    <?php
    include "pie.php"
    ?>
