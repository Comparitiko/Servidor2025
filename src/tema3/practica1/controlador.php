<?php
  session_start();
  include "modelo.php";

if ($_POST) {
  // Login form post
  if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    $login = loginUsuario($email, $password);

    if (is_null($login)) {
      header("Location: login.php?error=login_failed");
      exit();
    }

    if (!$login) {
      header("Location: login.php?error=bad_request");
      exit();
    }

    $_SESSION["usuario"] = $login;

    header("Location: proyectos.php");
    exit();
  }

  // Formulario de registro de usuario
  if (isset($_POST["register"])) {
    // Recuperar datos del formulario
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirm-password"];

    // Comprobar si las contraseñas coinciden
    if (strcmp($password, $confirmPassword) != 0) {
      header("Location: register.php?error=passwords_not_match");
      exit();
    }

    // Comprobar si el usuario ya existe en la base de datos
    $existeUsuario = existeUsuario($email, $username);

    if (is_null($existeUsuario)) {
      header("Location: register.php?error=register_failed");
      exit();
    }

    if ($existeUsuario) {
      header("Location: register.php?error=user_already_exists");
      exit();
    }

    // Registrar el usuario en la base de datos y recuperar su id
    $id = registroUsuario($username, $email, $password);

    if (!$id) {
      header("Location: register.php?error=register_failed");
      exit();
    }
    $_SESSION["usuario"] = ["id" => $id, "username" => $username, "email" => $email];
    header("Location: proyectos.php");
    exit();
  }

  // Formulario de añadir proyecto
  if (isset($_POST["nuevo-proyecto"])) {
    // Recuperar datos del formulario
    $nombre = $_POST["nombre"];
    $fechaInicio = $_POST["fecha-inicio"];
    $fechaFin = $_POST["fecha-fin"];
    $porcentajeCompletado = $_POST["porcentaje-completado"];
    $importancia = $_POST["importancia"];
    $idUsuario = $_SESSION["usuario"]["id"];
    $isCreated = crearProyecto($nombre, $fechaInicio, $fechaFin, $porcentajeCompletado, $importancia, $idUsuario);
    if (is_null($isCreated)) {
      header("Location: proyectos.php?error=create_project_failed");
      exit();
    } else if (!$isCreated) {
      header("Location: proyectos.php?error=create_project_failed");
      exit();
    } else {
      header("Location: proyectos.php");
      exit();
    }
  }

  // Formulario de edición de un proyecto
  if (isset($_POST["editar-proyecto"])) {
    // Recuperar datos del formulario
    $id = $_POST["id"];
    $nombre = $_POST["nombre"];
    $fechaInicio = $_POST["fecha-inicio"];
    $fechaFin = $_POST["fecha-fin"];
    $porcentaje = $_POST["porcentaje-completado"];
    $importancia = $_POST["importancia"];
    $isEdited = editarProyectoPorId($id, $nombre, $fechaInicio, $fechaFin, $porcentaje, $importancia);

    // Comprobar si se insertó correctamente
    if (!$isEdited) {
      header("Location: proyectos.php?error=update_project_failed");
      exit();
    }

    header("Location: proyectos.php");
    exit();
  }
};

if ($_GET) {
  // Cerrar sesión
  if (isset($_GET["accion"]) && strcmp($_GET["accion"], "logout") == 0) {
    session_destroy();
    header("Location: login.php");
    exit();
  }

  // Eliminar un proyecto
  if (isset($_GET["accion"]) && strcmp($_GET["accion"], "delete_project") == 0) {
    if (!isset($_GET["id"])) {
      header("Location: proyectos.php?error=deleting_project");
      exit();
    }
    // Eliminar el proyecto por su id
    $proyectoEliminado = EliminarProyectoPorId($_GET["id"]);

    // Comprobar si se eliminó correctamente
    if (!$proyectoEliminado) {
      header("Location: proyectos.php?error=deleting_project");
      exit();
    }

    header("Location: proyectos.php?info=success-delete-project");;
    exit();
  }

  // Eliminar todos los proyectos
  if (isset($_GET["accion"]) && strcmp($_GET["accion"], "delete_all_projects") == 0) {
    // Eliminar todos los proyectos de un usuario
    $proyectosEliminados = eliminarTodosProyectosDeUnUsuario($_SESSION["usuario"]["id"]);

    // Comprobar si se eliminaron correctamente
    if (is_null($proyectosEliminados)) {
      header("Location: proyectos.php?error=deleting_all_projects");
      exit();
    }

    // Redireccionar al proyectos y mostrar un mensaje de exito con el numero de proyectos eliminados
    header("Location: proyectos.php?info=success_delete_all_projects&num_proyectos={$proyectosEliminados}");
    exit();
  }
}