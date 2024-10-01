<?php
  // Tenemos una variable $numero que tiene un número de 0 a 99. Mostrarlo escrito.
  // Por ejemplo, para 56 mostrar: cincuenta y seis.

  $decenas = [
    1 => [
      1 => "once",
      2 => "doce",
      3 => "trece",
      4 => "catorce",
      5 => "quince",
      6 => "dieci"
    ],
    2 => [
      0 => "veinte",
      1 => "veinti",
    ],
    3 => "treinta",
    4 => "cuarenta",
    5 => "cincuenta",
    6 => "sesenta",
    7 => "setenta",
    8 => "ochenta",
    9 => "noventa"
  ];

  $unidades = [
    0 => "cero",
    1 => "uno",
    2 => "dos",
    3 => "tres",
    4 => "cuatro",
    5 => "cinco",
    6 => "seis",
    7 => "siete",
    8 => "ocho",
    9 => "nueve"
  ];

  $numero = 13;

  $decenasNum = floor($numero / 10);
  $unidadesNum = $numero % 10;

  if ($numero < 10) {
    echo $unidades[$numero];
  } else if ($numero > 29) {
    if ($unidadesNum === 0) echo $decenas[$decenasNum];
    else echo $decenas[$decenasNum] . " y " . $unidades[$unidadesNum];
  } else if ($numero > 19) {
    if ($numero === 20) echo $decenas[$decenasNum][$unidadesNum];
    else echo $decenas[$decenasNum][1] . $unidades[$unidadesNum];
  } else {
    if ($numero > 15) echo $decenas[$decenasNum][6] . $unidades[$unidadesNum];
    else echo $decenas[$decenasNum][$unidadesNum];
  }
?>