<?php
session_start();
include_once "modelo.php";
$proyecto = getProyectoPorIdYPorUsuario($_GET["id"], $_SESSION["usuario"]["id"]);

include "cabecera.php";
?>

  <div id="layoutSidenav_content">
  <main>
    <!-- Breadcrumb-->
    <div class="container-fluid px-4">
      <h1 class="mt-4">Editar proyecto</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Editar proyecto</li>
      </ol>

      <?php
      if (is_null($proyecto)) {
        echo "<h4 class='text-danger'>Error al obtener el proyecto</h4>";
        echo "<a href='proyectos.php'>Volver</a>";
      } else if (!$proyecto) {
        echo "<h4 class='text-danger'>El proyecto no existe</h4>";
        echo "<a href='proyectos.php'>Volver</a>";
      } else { ?>
        <form method="post" action="controlador.php" name="editar-proyecto">
          <div class="form-group">
            <label for="nombre" class="form-label">Nombre</label>
            <input type="text" class="form-control" id="nombre" name="nombre" value="<?php echo $proyecto["nombre"]; ?>"
                   required>
          </div>
          <div class="form-group">
            <label for="fecha-inicio" class="form-label">Fecha inicio</label>
            <input type="date" class="form-control" id="fecha-inicio" name="fecha-inicio"
                   value="<?php echo $proyecto["fecha_inicio"]; ?>" required>
          </div>
          <div class="form-group">
            <label for="fecha-fin" class="form-label">Fecha fin</label>
            <input type="date" class="form-control" id="fecha-fin" name="fecha-fin"
                   value="<?php echo $proyecto["fecha_fin_prevista"]; ?>" required>
          </div>
          <div class="form-group">
            <label for="porcentaje-completado" class="form-label">Porcentaje completado</label>
            <input type="number" class="form-control" id="porcentaje-completado" name="porcentaje-completado"
                   value="<?php echo $proyecto["porcentaje_completado"]; ?>" required min="0" max="100">
          </div>
          <div class="form-group">
            <label for="importancia" class="form-label">Importancia</label>
            <input type="number" class="form-control" id="importancia" name="importancia"
                   value="<?php echo $proyecto["importancia"]; ?>" required min="1" max="5">
            <input type="hidden" name="id" value="<?php echo $proyecto["id"]; ?>">
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary" name="editar-proyecto">Guardar</button>
          </div>
        </form>
        <?php
      }
      ?>

    </div>
  </main>

<?php
include "pie.php";
?>