<!DOCTYPE html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Ejercicio 1</title>
</head>

<body>
	<h1>Ejercicio 1</h1>
	<h3>Escribir un programa que pregunte al usuario su nombre, y luego lo salude.</h3>
</body>

<?php

if (!isset($_REQUEST['name'])) {
	echo '
		<form action="ejercicio1.php" method="get">
			<label for="manolo">
				<input type="text" name="name" id="manolo" placeholder="Escriba su nombre">
			</label>
			<input type="submit">
		</form>
	';
} else {
	$name = $_REQUEST['name'];

	if (strlen($name) < 1) {
		echo "<h1>No eres nadie</h1>";
		echo '<a href="/">Volver</a>';
	} else {
		echo "Tu nombre es {$name}";
		echo '<a href="/">Volver al formulario</a>';
	}
}

?>


</html>
