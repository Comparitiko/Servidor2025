<?php
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
      <a class="btn btn-primary" href="nuevo-proyecto.php" style="margin: 20px 0" role="button">Crear proyecto</a>
      <a class="btn btn-danger" href="controlador.php?accion=eliminar-todos" style="margin: 20px 0"
         role="button">Eliminar todos</a>
      <?php
      if (isset($_GET["error"]) && strcmp($_GET["error"], "deleting-project") == 0) {
        echo "<h4 class='text-danger'>Error al eliminar el proyecto seleccionado</h4>";
      }

      if (isset($_GET["info"]) && strcmp($_GET["info"], "success-delete-project") == 0) {
        echo "<h4 class='text-success'>Proyecto eliminado correctamente</h4>";
      }
      if (isset($_GET["info"]) && strcmp($_GET["info"], "success-delete-all-projects") == 0) {
        echo "<h4 class='text-success'>Proyectos eliminados correctamente</h4>";
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
              <th>Ver proyecto</th>
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
              <th>Ver proyecto</th>
              <th>Eliminar</th>
            </tr>
            </tfoot>
            <tbody>
            <?php
            foreach ($_SESSION["proyectos"] as $proyecto) {
              echo "<tr>";
              echo "<td>{$proyecto["nombre"]}</td>";
              echo "<td>{$proyecto["fecha_inicio"]}</td>";
              echo "<td>{$proyecto["fecha_fin_prevista"]}</td>";
              echo "<td>{$proyecto["dias_transcurridos"]}</td>";
              echo "<td>
                          <div class='progress' role='progressbar' aria-label='Default striped example' aria-valuenow='{$proyecto["porcentaje_completado"]}' aria-valuemin='0' aria-valuemax='100'>
                            <div class='progress-bar progress-bar-animated progress-bar-striped' style='width: {$proyecto["porcentaje_completado"]}%'>{$proyecto["porcentaje_completado"]}%</div>
                          </div>
                        </td>";
              echo "<td>{$proyecto["importancia"]}</td>";
              echo "<td>
                          <a href='ver-proyecto.php?id={$proyecto["id"]}'>
                            <i class='fa-solid fa-eye'></i>
                          </a>
                        </td>";
              echo "<td>
                          <a href='controlador.php?accion=delete-project&id={$proyecto["id"]}'>
                            <i class='fa-solid fa-trash text-center text-danger'></i>
                          </a>
                        </td>";
              echo "</tr>";
            }
            ?>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </main>
<?php
include "pie.php"
?>