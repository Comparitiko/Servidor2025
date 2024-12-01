<?php

namespace ChatGPTBlogs\views\components;

class HeaderComponent
{
  public static function render(string $title): void
  {
    ?>
    <!doctype html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <script src="https://cdn.tailwindcss.com"></script>
      <title><?= $title ?></title>
    </head>
    <body>
    <?php
  }
}