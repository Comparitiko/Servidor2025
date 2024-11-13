<?php

namespace Coworking\models;

use \PDO;
use \PDOException;

class DBConnection
{
  private PDO|null $conn;

  public function __construct()
  {
    $host = 'mariadb:3306'; // Ip of the docker container and the internal port

    try {

      $this->conn = new PDO("mysql:host=" . $host . ";dbname=" . "salas_coworking_gabriel", "gabriel", "gabriel123");
      $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $this->conn->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);


    } catch (PDOException $e) {
      $this->conn = null;
    }
  }

  public function getConnection()
  {
    return $this->conn;
  }

  public function closeConnection()
  {
    unset($this->conn);
  }


}