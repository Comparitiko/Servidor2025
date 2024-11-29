<?php

namespace ChatGPTBlogs\models;

use MongoDB\BSON\Document;
use MongoDB\BSON\ObjectId;
use MongoDB\BSON\Persistable;
use stdClass;

class Article implements Persistable
{
  private ObjectId $id;
  private string $title;
  private string $content;

  private string $image;

  private string $date;

  /**
   * @param string $title
   * @param string $content
   * @param string $image
   */
  public function __construct(string $title, string $content, string $image)
  {
    $this->id = new ObjectId();
    $this->title = $title;
    $this->content = $content;
    $this->image = $image;
    $this->date = date('Y-m-d');
  }

  public function getId(): ObjectId
  {
    return $this->id;
  }

  public function setId(ObjectId $id): void
  {
    $this->id = $id;
  }

  public function getTitle(): string
  {
    return $this->title;
  }

  public function setTitle(string $title): void
  {
    $this->title = $title;
  }

  public function getContent(): string
  {
    return $this->content;
  }

  public function setContent(string $content): void
  {
    $this->content = $content;
  }

  public function getImage(): string
  {
    return $this->image;
  }

  public function setImage(string $image): void
  {
    $this->image = $image;
  }

  public function getDate(): string
  {
    return $this->date;
  }

  public function setDate(string $date): void
  {
    $this->date = $date;
  }

  public function bsonSerialize(): array|stdClass|Document
  {
    return [
      '_id' => $this->id,
      'title' => $this->title,
      'content' => $this->content,
      'image' => $this->image,
      'date' => $this->date,
    ];
  }

  public function bsonUnserialize(array $data)
  {
    $this->id = $data['_id'];
    $this->title = $data['title'];
    $this->content = $data['content'];
    $this->image = $data['image'];
    $this->date = $data['date'];
  }
}