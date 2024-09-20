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
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		min-height: 100dvh;
		color: #ccc;
		background: linear-gradient(90deg, rgba(2, 0, 36, 1) 0%, rgba(22, 22, 48, 1) 34%, rgba(46, 130, 147, 1) 64%, rgba(13, 51, 59, 1) 82%);
	}

	a {
		text-decoration: none;
		color: #ccc;

		&:hover {
			color: red;
		}
	}
</style>

<body>
	<?php
	echo "<h2>NGINX y PHP funcionan correctamente</h2>";
	?>
</body>

</html>