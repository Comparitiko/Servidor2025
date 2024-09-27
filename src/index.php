<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NGINX y PHP</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-slate-900 color-white flex flex-col gap-4">
<?php
  function pintarAnchor($filePath) {
    if (str_contains($filePath, "index.php")) return;

    $urlPath = explode("html", $filePath);

    $indexUrl = "http://localhost:8080{$urlPath[1]}";
    echo "<div class='text-white text-2xl m-auto'>";
    echo "<a class='hover:text-red-800' href='{$indexUrl}'>{$urlPath[1]}</a>";
    echo "</div>";
  }

  function scanDirectory($path) {
    $dir = scandir($path);

    if (!$dir) return;

    foreach($dir as $file) {
      if ($file === "." || $file === "..") continue;

      $filePath = "{$path}/{$file}";

      if (str_contains($filePath, ".php")) {
        pintarAnchor($filePath);
        continue;
      }

      if (!is_dir($filePath)) {
        continue;
      };

      scanDirectory($filePath);
    }
  }

  $rootPath = realpath($_SERVER["DOCUMENT_ROOT"]);
  scanDirectory($rootPath);
?>
</body>

</html>