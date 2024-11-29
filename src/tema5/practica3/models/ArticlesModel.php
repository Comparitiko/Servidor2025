<?php

namespace ChatGPTBlogs\models;

use ChatGPTBlogs\enums\Collections;

class ArticlesModel
{
  /**
   * Get all articles from database
   * @return array
   */
  public static function getArticles(): array|null
  {
    $conn = new DBConnection();

    $articlesCollection = $conn->getCollection(Collections::ARTICLES);

    if (is_null($articlesCollection)) return null;

    $articles = $articlesCollection->find([], [
      'sort' => [
        'date' => 1
      ],
      'typeMap' => [
        'root' => Article::class, // Devuelve los documentos como objetos
      ],
    ])->toArray();

    $conn->closeConnection();

    return $articles;
  }

  public static function insertArticle(Article $article): ?bool
  {
    $conn = new DBConnection();

    $articlesCollection = $conn->getCollection(Collections::ARTICLES);

    if (is_null($articlesCollection)) return null;

    $articleInserted = $articlesCollection->insertOne($article);

    $conn->closeConnection();

    return $articleInserted->getInsertedId() === 1;
  }
}