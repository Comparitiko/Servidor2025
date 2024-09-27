<?php
 /* 8. Crea un generador aleatorio de apuesta de la Lotería Primitiva. Cada vez que
recargues la página aparecerá una combinación diferente.*/

  $nums = [];

  for($i = 0; $i < 6; $i++) {
    $isFilled = false;
    while(!$isFilled) {
      $num = rand(1, 49);
      if (array_search($num, $nums)) continue;

      $nums[$i] = $num;

      $isFilled = true;

    }
  }

  foreach ($nums as $num) {
    echo $num < 10 ? "0{$num} " : "{$num} " ;
  }
?>