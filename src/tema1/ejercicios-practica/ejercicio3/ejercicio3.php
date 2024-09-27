<?php
  /*
    3. Tenemos el radio de un circulo almacenado en la variable $radio obtenida de
    forma aleatoria, calcular y mostrar por pantalla el volumen de una esfera de ese
    radio.
  */

  $radio = rand(1, 10);

  $vol = 4 / 3 * pi() * pow($radio, 3);

  echo "El volumen del circulo con radio de {$radio} es {$vol}";
?>