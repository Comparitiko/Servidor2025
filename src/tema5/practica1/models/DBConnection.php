<?php

namespace CoworkingMongo\models;

use MongoDB\Driver\Manager;

class DBConnection
{
  private $client;

  public function __construct()
  {
    $mongoUri = 'mongodb://gabriel:gabriel123@mongodb:27017'; // Uri to connect to mongo database

    $this->client = new Manager($mongoUri);
  }

  public function getClient()
  {
    return $this->client;
  }
}