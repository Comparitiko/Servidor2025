<?php

include "lib.php";

/**
 * Crear una conexion a la base de datos
 * @return PDO|null PDO conexión o null si no se pudo conectar
 */
function conectarDB() {
  try {
    $dsn = "mysql:host=mariadb:3306;dbname=practica1-db;charset=utf8mb4";
    $dbh = new PDO($dsn, "root", "mysql?");
    $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    return $dbh;
  } catch (PDOException $e){
    return null;
  }
}

/**
 * Registrar un usuario en la base de datos con sus datos, hashea la password para no guardarla en plano y
 * devuelveel id usuario si se registra correctamente si no se registra devuelve false
 *
 * @param $username string nombre de usuario
 * @param $email string email del usuario
 * @param $password string password del usuario en texto plano
 *
 * @return false|string
 */
function registroUsuario($username, $email, $password)
{
  $dbh = conectarDB();
  var_dump($dbh);
  if (!$dbh) return false;

  $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

  var_dump($hashedPassword);

  echo "asd$hashedPassword";

  $stmt = $dbh->prepare("INSERT INTO usuarios (username, email, password)
                        VALUES (:username, :email, :password)");

  $stmt->bindParam(":username", $username);
  $stmt->bindParam(":email", $email);
  $stmt->bindParam(":password", $hashedPassword);
  $stmt->execute();

  $id = $dbh->lastInsertId();

  $dbh = null;

  return $id;
}

function loginUsuario($email, $password) {
  $dbh = conectarDB();
  if (!$dbh) return false;

  $stmt = $dbh->prepare("SELECT id, username, email, password 
                        FROM usuarios 
                        WHERE email = :email");
  $stmt->bindParam(":email", $email);

  $stmt->setFetchMode(PDO::FETCH_ASSOC);

  $stmt->execute();

  $dbh = null;

  $usuario = $stmt->fetch();
  if (!$usuario) return false;

  if (!password_verify($password, $usuario["password"])) return false;

  return ["id" => $usuario["id"], "username" => $usuario["username"]];
}

/**
 * Comprobar si existe un usuario en la base de datos con el email o el nombre de usuario,
 * devuelve true si existe y false si no existe si no hay conexion con la base de datos devuelve null
 *
 * @param $email string email del usuario comprobar
 * @param $username string nombre de usuario del usuario comprobar
 *
 * @return bool|null
 */
function existeUsuario($email, $username) {
  $dbh = conectarDB();
  var_dump($dbh);
  if (is_null($dbh)) return null;

  $stmt = $dbh->prepare("SELECT id FROM usuarios WHERE email = :email OR username = :username");

  $stmt->bindParam(":email", $email);
  $stmt->bindParam(":username", $username);

  $stmt->execute();

  $dbh = null;

  return $stmt->rowCount() > 0;
}

/**
 * Inserta un nuevo proyecto en la base de datos con sus datos y el id del usuario que lo creo
 * devuelve true si se inserta correctamente, false si no se inserta
 * y null si no hay conexion con la base de datos
 *
 * @param $nombre string nombre del proyecto
 * @param $fechaInicio string fecha de inicio del proyecto
 * @param $fechaFin string fecha de fin del proyecto
 * @param $porcentajeCompletado int porcentaje completado del proyecto
 * @param $importancia int importancia del proyecto
 * @param $id_usuario int id del usuario que creo el proyecto
 *
 * @return bool|null
 */
function crearProyecto($nombre, $fechaInicio, $fechaFin, $porcentajeCompletado, $importancia, $id_usuario) {
  $dbh = conectarDB();

  if (is_null($dbh)) return null;

  $stmt = $dbh->prepare("INSERT INTO proyectos (
                       nombre, fecha_inicio, fecha_fin_prevista, porcentaje_completado, importancia, id_usuario
                       ) VALUES (
                        :nombre, :fecha_inicio, :fecha_fin, :porcentaje_completado, :importancia, :id_usuario
                       )
                       ");
  $stmt->bindParam(":nombre", $nombre);
  $stmt->bindParam(":fecha_inicio", $fechaInicio);
  $stmt->bindParam(":fecha_fin", $fechaFin);
  $stmt->bindParam(":porcentaje_completado", $porcentajeCompletado);
  $stmt->bindParam(":importancia", $importancia);
  $stmt->bindParam(":id_usuario", $id_usuario);
  $stmt->execute();

  $dbh = null;

  return $stmt->rowCount() > 0;
}

