<!doctype html>
<html lang="es">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
	<title>Práctica 1 Ejercicio 1</title>
</head>

<body>
	<div class="vw-100 vh-100 d-flex flex-column justify-content-center align-items-center">
		<?php
		$carrito = [
			["id" => 1234, "nombre" => "PS4", "precio" => 349.95, "cant" => 2, "iva_r" => 0],
			["id" => 1235, "nombre" => "iPhone XS", "precio" => 1249.95, "cant" => 1, "iva_r" => 0],
			["id" => 1236, "nombre" => "Chocolate", "precio" => 9.95, "cant" => 5, "iva_r" => 1],
      ["id" => 1237, "nombre" => "Portátil", "precio" => 329.99, "cant" => 10, "iva_r" => 0],
      ["id" => 1238, "nombre" => "Smart TV", "precio" => 1199.99, "cant" => 1, "iva_r" => 1]
		];

		function subTotal($lineaPedido)
		{
			$subtotal = $lineaPedido["precio"] * $lineaPedido["cant"];

			$iva_r = $lineaPedido["iva_r"];

      $subtotal += $iva_r === 0 ? $subtotal * 0.21 : $subtotal * 0.1;

      return $subtotal;
		}
		?>
    <h1>Carro de la compra</h1>
		<table class="table table-bordered w-75 table-hover">
			<thead class="table-dark">
				<th class='text-center'>#</th>
				<th class='text-center'>Nombre</th>
				<th class='text-center'>Precio</th>
				<th class='text-center'>Cantidad</th>
				<th class='text-center'>IVA</th>
				<th class='text-center'>Subtotal</th>
			</thead>
			<tbody class="table">
				<?php
        $total = 0;
				foreach ($carrito as $producto) {
					echo "<tr>";
          echo "<td class='text-center'>{$producto["id"]}</td>";
					echo "<td class='text-center'>{$producto["nombre"]}</td>";
          echo "<td class='text-center'>{$producto["precio"]}</td>";
          echo "<td class='text-center'>{$producto["cant"]}</td>";
          echo "<td class='text-center'>{$producto["iva_r"]}</td>";
          $subtotal = subTotal($producto);
          $total += $subtotal;
          echo "<td class='text-center'>{$subtotal}</td>";
          echo "</tr>";
				}
        echo "<tr>";
        echo "<td colspan='5' class='text-center'>Total</td>";
        echo "<td class='text-center'>{$total}</td>";
        echo "</tr>";
				?>
			</tbody>
		</table>
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>