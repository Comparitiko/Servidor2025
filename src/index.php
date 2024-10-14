<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NGINX y PHP</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-900 text-white flex flex-col gap-4 p-4">
<?php

  $rootPath = realpath($_SERVER["DOCUMENT_ROOT"]);

  $filePathsArr = [];

  scanDirectory($filePathsArr, $rootPath);

  $temas = array_unique(array_map(fn($filePath) => explode("/", $filePath)[4], $filePathsArr));

  foreach ($temas as $tema) {
    pintarTemas($tema, $filePathsArr);
  }

  function firstLetterToUpperCase($string) {
    $string[0] = strtoupper($string[0]);
    return $string;
  }

  function filterByTema($tema, $filePaths) {
    $temaNum = intval(str_replace("tema", "", $tema));
    return array_filter($filePaths, fn($filePath) => explode("/", $filePath)[$temaNum]);
  };

/**
 * @param $tema int num tema a pintar
 * @param $filesPath string[] Array of filepaths
 * @return void
 */
  function pintarTemas($tema, $filesPaths) {
    $temaUpper = firstLetterToUpperCase($tema);
    $filesPathsOfTema = filterByTema($tema, $filesPaths);

    echo "<article class='text-center grid gap-4'>";
    echo "<h1 class='text-4xl text-red-500'>{$temaUpper}</h1>";
    echo "<section>";
    foreach ($filesPathsOfTema as $filePath) {
      echo "<section>";
      pintarAnchor($filePath);
      echo "</section>";
    }
    echo "</section>";
    echo "</article>";
  }

  function pintarAnchor($filePath) {
    // Quitar la parte de la carpeta /var/www/html
    $urlPath = explode("html", $filePath)[1];

    $messageArr = explode("/", $filePath);



    $indexUrl = "./{$urlPath}";
    echo "<div class='text-white text-xl'>";
    echo "<a class='hover:text-red-800 group' href='{$indexUrl}'>" . firstLetterToUpperCase
      ($messageArr[5]) . " <span class='text-yellow-500 group-hover:text-red-600'>" .
      firstLetterToUpperCase
      ($messageArr[6]) . "</span>" . "</a>";
    echo "</div>";
  }


/**
 * Scan all the server dirs
 * @param $filePaths array Array to save the filepaths
 * @param $path string Path to search all the .php files except tme.php
 * @return void
 */
  function scanDirectory(&$filePaths, $path) {
    $dir = scandir($path);

    if (!$dir) return;

    foreach($dir as $file) {
      if ($file === "." || $file === "..") continue;

      $filePath = "{$path}/{$file}";

      // Los archivos tme.php no se guardan
      if (str_contains($filePath, "tme.php")) continue;

      // Guardar los demás archivos .php
      if (str_contains($filePath, ".php")) {
        $filePaths[] = $filePath;
        continue;
      }

      // Lo que sea un archivo pero no sea .php no se guarda
      if (!is_dir($filePath)) {
        continue;
      };

      scanDirectory($filePaths, $filePath);
    }
  }

?>
</body>

</html>