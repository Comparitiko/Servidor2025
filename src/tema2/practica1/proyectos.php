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
        <div class="card mb-4">
          <div class="card-header">
            <i class="fas fa-table me-1"></i>
            DataTable Example
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
                foreach ($_SESSION["proyectos"] as $proyecto) {
                  echo "<tr>";
                  echo "<td>{$proyecto["nombre"]}</td>";
                  echo "<td>{$proyecto["fecha_inicio"]}</td>";
                  echo "<td>{$proyecto["fecha_fin_prevista"]}</td>";
                  echo "<td>{$proyecto["dias_transcurridos"]}</td>";
                  echo "<td>{$proyecto["porcentaje_completado"]}</td>";
                  echo "<td>{$proyecto["importancia"]}</td>";
                  echo "<td>
                          <a href='controlador.php?accion=delete_project&id={$proyecto["id"]}'>
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