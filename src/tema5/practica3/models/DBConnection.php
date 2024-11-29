<?php

namespace ChatGPTBlogs\models;

use ChatGPTBlogs\enums\Collections;
use MongoDB\Client;
use MongoDB\Collection;
use MongoDB\Exception\Exception;

require "./vendor/autoload.php";

class DBConnection
{
  private Client|null $client;

  /**
   * Connect to database
   * @return void
   */
  public function __construct()
  {
    $mongoUri = 'mongodb://gabriel:gabriel123@mongodb:27017'; // Uri to connect to mongo database
    try {
      $this->client = new Client($mongoUri);
    } catch (Exception $e) {
      $this->client = null;
    }
  }

  /**
   * Get the collection that is passed from parameter
   * @param Collections $collection
   * @return Collection|null
   */
  public function getCollection(Collections $collection): Collection|null
  {
    if (is_null($this->client)) return null;

    return $this->client->selectCollection('gpt-blogs', $collection->value);
  }

  /**
   * Close connection of the database
   * @return void
   */
  public function closeConnection(): void
  {
    $this->client = null;
  }
}