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
  function createProject($id, $nombre, $fecha_inicio, $fecha_fin_prevista,
                         $porcentaje_completado, $importancia) {
    if (!isset($_SESSION["proyectos"])) $_SESSION["proyectos"] = [];

    $dias_transcurridos = calcularDiasTranscurridos($fecha_inicio);

    $_SESSION["proyectos"][] = ["id" => $id, "nombre" => $nombre, "fecha_inicio" =>
      $fecha_inicio, "fecha_fin_prevista" => $fecha_fin_prevista, "dias_transcurridos" =>
      $dias_transcurridos, "porcentaje_completado" => $porcentaje_completado, "importancia" =>
      $importancia];
  }

/**
 * @param $fecha_inicio_string string fecha de inicio del proyecto
 * @return string con el numero de dias que lleva el proyecto en marcha
 * @throws DateMalformedStringException
 */
  function calcularDiasTranscurridos($fecha_inicio_string) {

    $fecha_inicio = new DateTime($fecha_inicio_string);

    return $fecha_inicio->diff(new DateTime("now"))->format("%a días");
  }

  function createInitialProjects() {
    createProject(1, "Innovación 1", "2023-01-15",
      "2024-01-30", 75, 4);
    createProject(2, "Expansión Regional", "2023-03-10",
      "2024-05-20", 40, 5);
    createProject(3, "Desarrollo de Plataforma Online", "2023-06-25",
      "2024-07-15", 30, 3);
    createProject(4, "Automatización de Procesos", "2022-11-05",
      "2023-12-20", 90, 5);
    createProject(5, "Mejora de Calidad Interna", "2023-02-14",
      "2024-03-30", 65, 4);
  }

  // Loguearse en el sistema si cumple ciertos requisitos
  function login($email, $password) {
    if (strlen($password) < 8 || !preg_match("/.*[A-Z].*/", $password)) {
      return header("Location: login.php?error=bad_request");
    }
    $_SESSION["usuario"] = ["email" => $email];
    createInitialProjects();
    return header("Location: proyectos.php");
  }

/**
 * Eliminar un proyecto comparando su id
 * @param $id int id del proyecto a eliminar
 * @return void
 */
  function removeProjectById($id) {
    foreach ($_SESSION["proyectos"] as $key => $proyecto) {
      if ($proyecto["id"] == $id) {
        $index = $key;
        break;
      };
    }
    unset($_SESSION["proyectos"][$index]);
  }

/**
 * Buscar un proyecto por su id devuelve el proyecto si lo encuentra
 * Devuelve null si no lo encuentra
 * @param $id int id del proyecto
 * @return mixed|null
 */
  function getProjectById($id) {
    foreach ($_SESSION["proyectos"] as $proyecto) {
      if ($proyecto["id"] == $id) {
        return $proyecto;
      };
    }
    return null;
  }
?>