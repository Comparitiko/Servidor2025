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
        <div class="card-body p-4">
          <?php
          echo "<h2 class='card-title text-center'>Proyecto {$proyecto["nombre"]}</h2>";
          echo "
              <div class='container'>
                <p class='card-text'>Fecha inicio: <span class='text-danger'>{$proyecto["fecha_inicio"]}</span></p>
                <p class='card-text'>Fecha fin prevista: <span class='text-danger'>{$proyecto["fecha_fin_prevista"]}</span></p>
                <p class='card-text'>Dias transcurridos: <span class='text-danger'>{$proyecto["dias_transcurridos"]}</span></p>
                <p>Porcentaje completado:</p>
                <div class='progress' role='progressbar' aria-label='Default striped example' aria-valuenow='{$proyecto["porcentaje_completado"]}' aria-valuemin='0' aria-valuemax='100'>
                  <div class='progress-bar progress-bar-animated progress-bar-striped' style='width: {$proyecto["porcentaje_completado"]}%'>{$proyecto["porcentaje_completado"]}%</div>
                </div>
                <p class='card-text'>Importancia: <span class='text-danger'>{$proyecto["importancia"]}</span></p>
              </div>
            ";
          ?>
        </div>
      </div>
    </div>
  </main>
  <?php
  include "pie.php"
  ?>
