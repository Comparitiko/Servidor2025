<?php
  session_start();
  include "lib.php";

  if (!isset($_GET["id"])) return header("Location: proyectos.php");

  $id = $_GET["id"];

  $proyecto = getProjectById($id);

  $title = "Proyecto {$proyecto["nombre"]}";
  include "cabecera.php"
?>
<div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Ver proyecto</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active">Dashboard</li>
        <li class="breadcrumb-item active">Ver proyecto</li>
      </ol>
      <div class="card mb-4">
        <div class="card-header">
          <i class="fa-solid fa-diagram-project"></i>
          Proyecto
        </div>
        <div class="card-body">
          <?php

          ?>
        </div>
      </div>
    </div>
  </main>
      <?php
      include "pie.php"
      ?>
  </body>
</html>
