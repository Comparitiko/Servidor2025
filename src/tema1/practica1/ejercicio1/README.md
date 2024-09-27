1. Vamos a crear un programa que calcule el IVA de un carrito de la compra. El
   carrito será un array bidimensional asociativo de este tipo: (Puedes añadir más
   productos y más campos a tu elección)

   ```php
    $carrito = array(
      array(“id” => 1234, “nombre” => “PS4”, “precio” => 349.95, “cant” => 2, “iva_r” => 0),
      array(“id” => 1235, “nombre” => “iPhone XS”, “precio” => 1249.95, “cant” => 1, “iva_r” => 0),
      array(“id” => 1236, “nombre” => “Chocolate”, “precio” => 9.95, “cant” => 5, “iva_r” => 1)
    )
   ```
   Deberéis crear una función llamada subtotal($linea_pedido) que calcule el precio de
   cada línea de pedido, multiplicando el precio por la cantidad y aplicando el iva
   correspondiente, si iva_r es 0 será del 21% y si iva_r es 1 será del 10%.
   Mostrar en una tabla HTML el carrito de la compra (nombre, precio, cantidad y
   subtotal). En la última fila aparecerá el total del pedido a pagar.
   Se tendrá en cuenta la visualización y el estilo del carrito de la compra resultante.