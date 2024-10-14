<?php

/**
 * Comprobar si existe el array de proyectos en la session, si no existe se crea y se mete el
 * proyecto
 * @param $id int id del proyecto
 * @param $nombre string nombre del proyecto
 * @param $fecha_inicio string fecha de inicio del proyecto
 * @param $fecha_fin_prevista string fecha de finalización prevista
 * @param $porcentaje_completado int porcentaje del proyecto completado
 * @param $importancia int importancia del proyecto numero del 1 al 5
 * @return void
 */
  function crearProyecto($id, $nombre, $fecha_inicio, $fecha_fin_prevista, $dias_transcurridos,
                         $porcentaje_completado, $importancia) {
    if (!isset($_SESSION["proyectos"])) $_SESSION["proyectos"] = [];
    array_push($_SESSION["proyectos"], ["id" => $id, "nombre" => $nombre, "fecha_inicio" =>
      $fecha_inicio, "fecha_fin_prevista" => $fecha_fin_prevista, "dias_transcurridos" =>
      $dias_transcurridos, "porcentaje_completado" => $porcentaje_completado, "importancia" =>
      $importancia]);
  }

  function crearProyectosIniciales() {
    crearProyecto(1, "Proyecto 1", );
  }

  function login($email, $password) {
    if (strlen($password) < 8 || !preg_match("/.*[A-Z].*/", $password)) {
      return header("Location: login.php?error=bad_request");
    }
    $_SESSION["usuario"] = ["email" => $email];
    crearProyectosIniciales();
    header("Location: proyectos.php");
  }
?>