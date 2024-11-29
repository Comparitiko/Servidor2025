<?php

namespace ChatGPTBlogs\views\components;

class Header
{
  public static function render(string $title): void
  {
    ?>
    <!doctype html>
    <html lang="es">
    <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet"/>
      <script src="https://cdn.tailwindcss.com"></script>
      <title><?= $title ?></title>
    </head>
    <body>
    <?php
  }
}