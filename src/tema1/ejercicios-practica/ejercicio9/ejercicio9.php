<?php
/* 9. Realiza un programa que pinte 5 círculos en horizontal cada uno de un color
diferente aleatorio.
Puedes usar la función SVG circle para dibujar los círculos. */
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Ejercicio9 practica</title>
</head>
<body>
<div class="container">
  <?php
  function generarSVG($color)
  {
    echo "<svg height='100' width='100' ><circle cx='50' r='40' cy='50' stroke='black' stroke-width='3' fill='{$color}' /> </svg>";
  }

  for ($i = 0; $i < 5; $i++) {
    $red = rand(0, 255);
    $green = rand(0, 255);
    $blue = rand(0, 255);
    $rgb = "rgb({$red}, {$green}, $blue)";
    generarSVG($rgb);
  }
  ?>
</div>
</body>
</html>
