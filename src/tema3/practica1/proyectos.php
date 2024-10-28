<?php
session_start();
include_once "modelo.php";
include_once "lib.php";

if (isset($_GET["search"])) $proyectos = buscarProyectoPorNombre($_GET["search"]);
else $proyectos = getProyectosPorUsuario($_SESSION["usuario"]["id"]);

$title = "Proyectos";
include "cabecera.php"
?>
  <div id="layoutSidenav_content">
    <main>
      <div class="container-fluid px-4">
        <h1 class="mt-4">Dashboard</h1>
        <ol class="breadcrumb mb-4">
          <li class="breadcrumb-item active">Dashboard</li>
        </ol>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalNuevoProyecto">
          Crear Proyecto
        </button>

        <a class="btn btn-danger" href="controlador.php?accion=delete_all_projects" style="margin: 20px 0"
           role="button">Eliminar todos</a>
        <form class="w-50" method="get" action="proyectos.php">
          <div class="input-group mb-3">
            <input type="search" class="form-control" name="search" placeholder="Buscar proyectos...">
            <button type="submit" class="btn btn-secondary">Buscar</button>
          </div>
        </form>
        <?php
        if (isset($_GET["info"]) && strcmp($_GET["info"], "success-delete-project") == 0) {
          echo "<h4 class='text-success'>Proyecto eliminado correctamente</h4>";
        }
        if (isset($_GET["info"]) && strcmp($_GET["info"], "success_delete_all_projects") == 0) {
          $proyectosEliminados = $_GET["num_proyectos"];
          $mensaje = $proyectosEliminados > 1 || $proyectosEliminados == 0
            ? "{$proyectosEliminados} proyectos eliminados"
            : "{$proyectosEliminados} proyecto eliminado";

          echo "<h4 class='text-success'>{$mensaje}</h4>";
        }
        if (isset($_GET["error"]) && strcmp($_GET["error"], "create_project_failed") == 0) {
          echo "<h4 class='text-danger'>Error al crear el proyecto intentelo de nuevo mas tarde</h4>";
        }
        if (isset($_GET["error"]) && strcmp($_GET["error"], "deleting_project") == 0) {
          echo "<h4 class='text-danger'>Error al eliminar el proyecto seleccionado</h4>";
        }
        if (isset($_GET["error"]) && strcmp($_GET["error"], "deleting_all_projects") == 0) {
          echo "<h4 class='text-danger'>Error al eliminar los proyectos</h4>";
        }
        if (is_null($proyectos)) {
          echo "<h4 class='text-danger'>Error al obtener los proyectos prueba mas tarde</h4>";
        }
        ?>
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-table me-1"></i>
            Tabla de proyectos
          </div>
          <div class="card-body">
            <table id="datatablesSimple">
              <thead>
              <tr>
                <th>Nombre</th>
                <th>Fecha de inicio</th>
                <th>Fecha fin prevista</th>
                <th>Dias transcurridos</th>
                <th>Portcentaje completado</th>
                <th>Importancia</th>
                <th>Eliminar</th>
              </tr>
              </thead>
              <tfoot>
              <tr>
                <th>Nombre</th>
                <th>Fecha de inicio</th>
                <th>Fecha fin prevista</th>
                <th>Dias transcurridos</th>
                <th>Portcentaje completado</th>
                <th>Importancia</th>
                <th>Eliminar</th>
              </tr>
              </tfoot>
              <tbody>
              <?php
              if (is_array($proyectos)) {
                foreach ($proyectos as $proyecto) {
                  $diasTranscurridos = calcularDiasTranscurridos($proyecto["fecha_inicio"]);
                  echo "<tr>";
                  echo "<td>{$proyecto["nombre"]}</td>";
                  echo "<td>{$proyecto["fecha_inicio"]}</td>";
                  echo "<td>{$proyecto["fecha_fin_prevista"]}</td>";
                  echo "<td>{$diasTranscurridos}</td>";
                  echo "<td>
                          <div class='progress' role='progressbar' aria-label='Default striped example' aria-valuenow='{$proyecto["porcentaje_completado"]}' aria-valuemin='0' aria-valuemax='100'>
                            <div class='progress-bar progress-bar-animated progress-bar-striped' style='width: {$proyecto["porcentaje_completado"]}%'>{$proyecto["porcentaje_completado"]}%</div>
                          </div>
                        </td>";
                  echo "<td>{$proyecto["importancia"]}</td>";
                  echo "<td>
                          <a href='controlador.php?accion=delete_project&id={$proyecto["id"]}'>
                            <i class='fa-solid fa-trash text-center text-danger'></i>
                          </a>
                        </td>";
                  echo "</tr>";
                }
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <!-- Modal -->
      <div class="modal fade" id="modalNuevoProyecto" tabindex="-1" role="dialog"
           aria-labelledby="exampleModalMessageTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">Nuevo Proyecto</h5>
              <button type="button" class="btn-close text-dark" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              <form method="post" action="controlador.php" id="nuevoProyecto">
                <div class="form-group">
                  <label for="nombre" class="form-label">Nombre proyecto</label>
                  <input type="text" class="form-control" id="nombre" name="nombre" required>
                </div>
                <div class="form-group">
                  <label for="fecha-inicio" class="form-label">Fecha inicio</label>
                  <input type="date" class="form-control" id="fecha-inicio" name="fecha-inicio" required >
                </div>
                <div class="form-group">
                  <label for="fecha-fin" class="form-label">Fecha fin</label>
                  <input type="date" class="form-control" id="fecha-fin" name="fecha-fin" required>
                </div>
                <div class="form-group">
                  <label for="porcentaje-completado" class="form-label">Porcentaje completado</label>
                  <input type="number" class="form-control" id="porcentaje-completado" name="porcentaje-completado"
                         required min="0" max="100">
                </div>
                <div class="form-group">
                  <label for="importancia" class="form-label">Importancia</label>
                  <input type="number" class="form-control" id="importancia" name="importancia" required min="1" max="5">
                </div>
              </form>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cerrar</button>
              <button type="submit" form="nuevoProyecto" name="nuevo-proyecto" class="btn
              btn-primary">Crear</button>
            </div>
          </div>
        </div>
      </div>
  </main>
<?php
include "pie.php"
?>