<?php

namespace ChatGPTBlogs\controllers;

use ChatGPTBlogs\models\Article;
use ChatGPTBlogs\models\ArticlesModel;
use ChatGPTBlogs\views\ArticlesView;
use Ramsey\Uuid\Uuid;

class ArticlesController
{
  public static function showArticles($info = ""): void
  {
    $articles = ArticlesModel::getArticles();

    // Check if the database connection failed
    if (is_null($articles)) {
      header("Location: index.php?info=server_error");
      exit();
    }

    ArticlesView::render($articles, $info);
  }

  public static function insertArticle(string $title, string $content, string $imageUrl): void
  {
    // Check if title content or imageUrl not coming in the request
    if (strcmp($title, "") === 0 || strcmp($content, "") === 0 || strcmp($imageUrl, "") === 0) {
      echo json_encode([
        "ok" => false,
        "info" => "El título, el contenido y la imagen no puede estar vacíos"
      ]);
      exit();
    }

    // Download image from $_POST["image"] with file_get_contents
    $imageContent = file_get_contents($imageUrl);

    $imagesPath = "./views/assets/images/articles";

    // Save image to the file system with file_put_contents
    $imagePath = $imagesPath . "/" . Uuid::uuid4()->toString() . ".jpg";
    if (!file_put_contents($imagePath, $imageContent)) {
      json_encode([
        "ok" => false,
        "info" => "Error interno del servidor, pruebe de nuevo mas tarde"
      ]);
      exit();
    }

    $article = new Article($title, $content, $imagePath);

    $isInserted = ArticlesModel::insertArticle($article);

    if (is_null($isInserted)) {
      echo json_encode([
        "ok" => false,
        "info" => "Error interno del servidor"
      ]);
      exit();
    }

    if (!$isInserted) {
      echo json_encode([
        "ok" => false,
        "info" => "No se pudo insertar el artículo, intente de nuevo mas tarde"
      ]);
      exit();
    }

    echo json_encode([
      "ok" => true,
      "info" => "El artículo ha sido insertado correctamente"
    ]);
  }
}