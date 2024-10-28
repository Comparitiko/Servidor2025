<?php
include_once "modelo.php";

$proyecto = getProyectoPorId($_GET["id"]);

include "cabecera.php";
?>

  <div id="layoutSidenav_content">
  <main>
    <div class="container-fluid px-4">
      <h1 class="mt-4">Editar proyecto</h1>
      <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item">Dashboard</li>
        <li class="breadcrumb-item active">Editar proyecto</li>
      </ol>
    </div>
  </main>

<?php
include "pie.php";
?>