<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>NGINX y PHP</title>
</head>

<style>
	*,
	*::before,
	*::after {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
	}

	body {
		background-color: #3f3f3f;
		color: white;
	}
</style>

<body>
	<?=
	"<h1>Generado con php</h1>";
	?>
	<?php
    if (isset($_GET['name'])) {
	$nombre = $_GET['name'];
	echo "<h2>Hola $nombre</h2>";
    }
    $precio = $_GET['price'];

	echo !empty($precio) ? "<h2>El precio es: $precio</h2>" : "<h2>No hay precio</h2>";

    $frutas = ['pera', 'manzana', 'limón'];

    foreach ($frutas as $fruta) {
	    echo "<h2>$fruta</h2>";
    }

	?>
</body>

</html>