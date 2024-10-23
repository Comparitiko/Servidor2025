<?php

/**
 * Generar una baraja nueva con todas las cartas de la baraja
 * @return array[]
 */
function crearBarajaCartas() {
  // Ruta al directorio de las imagenes
  $directorioImagenes = "./images";
  $baraja = [
    ["palo" => "corazones", "carta" => "A", "imagen" => "{$directorioImagenes}/c1.svg"],
    ["palo" => "corazones", "carta" => "2", "imagen" => "{$directorioImagenes}/c2.svg"],
    ["palo" => "corazones", "carta" => "3", "imagen" => "{$directorioImagenes}/c3.svg"],
    ["palo" => "corazones", "carta" => "4", "imagen" => "{$directorioImagenes}/c4.svg"],
    ["palo" => "corazones", "carta" => "5", "imagen" => "{$directorioImagenes}/c5.svg"],
    ["palo" => "corazones", "carta" => "6", "imagen" => "{$directorioImagenes}/c6.svg"],
    ["palo" => "corazones", "carta" => "7", "imagen" => "{$directorioImagenes}/c7.svg"],
    ["palo" => "corazones", "carta" => "8", "imagen" => "{$directorioImagenes}/c8.svg"],
    ["palo" => "corazones", "carta" => "9", "imagen" => "{$directorioImagenes}/c9.svg"],
    ["palo" => "corazones", "carta" => "10", "imagen" => "{$directorioImagenes}/c10.svg"],
    ["palo" => "corazones", "carta" => "J", "imagen" => "{$directorioImagenes}/c11.svg"],
    ["palo" => "corazones", "carta" => "Q", "imagen" => "{$directorioImagenes}/c12.svg"],
    ["palo" => "corazones", "carta" => "K", "imagen" => "{$directorioImagenes}/c13.svg"],

    ["palo" => "diamantes", "carta" => "A", "imagen" => "{$directorioImagenes}/d1.svg"],
    ["palo" => "diamantes", "carta" => "2", "imagen" => "{$directorioImagenes}/d2.svg"],
    ["palo" => "diamantes", "carta" => "3", "imagen" => "{$directorioImagenes}/d3.svg"],
    ["palo" => "diamantes", "carta" => "4", "imagen" => "{$directorioImagenes}/d4.svg"],
    ["palo" => "diamantes", "carta" => "5", "imagen" => "{$directorioImagenes}/d5.svg"],
    ["palo" => "diamantes", "carta" => "6", "imagen" => "{$directorioImagenes}/d6.svg"],
    ["palo" => "diamantes", "carta" => "7", "imagen" => "{$directorioImagenes}/d7.svg"],
    ["palo" => "diamantes", "carta" => "8", "imagen" => "{$directorioImagenes}/d8.svg"],
    ["palo" => "diamantes", "carta" => "9", "imagen" => "{$directorioImagenes}/d9.svg"],
    ["palo" => "diamantes", "carta" => "10", "imagen" => "{$directorioImagenes}/d10.svg"],
    ["palo" => "diamantes", "carta" => "J", "imagen" => "{$directorioImagenes}/d11.svg"],
    ["palo" => "diamantes", "carta" => "Q", "imagen" => "{$directorioImagenes}/d12.svg"],
    ["palo" => "diamantes", "carta" => "K", "imagen" => "{$directorioImagenes}/d13.svg"],

    ["palo" => "picas", "carta" => "A", "imagen" => "{$directorioImagenes}/p1.svg"],
    ["palo" => "picas", "carta" => "2", "imagen" => "{$directorioImagenes}/p2.svg"],
    ["palo" => "picas", "carta" => "3", "imagen" => "{$directorioImagenes}/p3.svg"],
    ["palo" => "picas", "carta" => "4", "imagen" => "{$directorioImagenes}/p4.svg"],
    ["palo" => "picas", "carta" => "5", "imagen" => "{$directorioImagenes}/p5.svg"],
    ["palo" => "picas", "carta" => "6", "imagen" => "{$directorioImagenes}/p6.svg"],
    ["palo" => "picas", "carta" => "7", "imagen" => "{$directorioImagenes}/p7.svg"],
    ["palo" => "picas", "carta" => "8", "imagen" => "{$directorioImagenes}/p8.svg"],
    ["palo" => "picas", "carta" => "9", "imagen" => "{$directorioImagenes}/p9.svg"],
    ["palo" => "picas", "carta" => "10", "imagen" => "{$directorioImagenes}/p10.svg"],
    ["palo" => "picas", "carta" => "J", "imagen" => "{$directorioImagenes}/p11.svg"],
    ["palo" => "picas", "carta" => "Q", "imagen" => "{$directorioImagenes}/p12.svg"],
    ["palo" => "picas", "carta" => "K", "imagen" => "{$directorioImagenes}/p13.svg"],

    ["palo" => "treboles", "carta" => "A", "imagen" => "{$directorioImagenes}/t1.svg"],
    ["palo" => "treboles", "carta" => "2", "imagen" => "{$directorioImagenes}/t2.svg"],
    ["palo" => "treboles", "carta" => "3", "imagen" => "{$directorioImagenes}/t3.svg"],
    ["palo" => "treboles", "carta" => "4", "imagen" => "{$directorioImagenes}/t4.svg"],
    ["palo" => "treboles", "carta" => "5", "imagen" => "{$directorioImagenes}/t5.svg"],
    ["palo" => "treboles", "carta" => "6", "imagen" => "{$directorioImagenes}/t6.svg"],
    ["palo" => "treboles", "carta" => "7", "imagen" => "{$directorioImagenes}/t7.svg"],
    ["palo" => "treboles", "carta" => "8", "imagen" => "{$directorioImagenes}/t8.svg"],
    ["palo" => "treboles", "carta" => "9", "imagen" => "{$directorioImagenes}/t9.svg"],
    ["palo" => "treboles", "carta" => "10", "imagen" => "{$directorioImagenes}/t10.svg"],
    ["palo" => "treboles", "carta" => "J", "imagen" => "{$directorioImagenes}/t11.svg"],
    ["palo" => "treboles", "carta" => "Q", "imagen" => "{$directorioImagenes}/t12.svg"],
    ["palo" => "treboles", "carta" => "K", "imagen" => "{$directorioImagenes}/t13.svg"],
  ];
  // Eliminar cartas sobrantes y barajar la baraja
  eliminarCartasSobrantes($baraja);
  shuffle($baraja);

  return $baraja;
}

/**
 * Reiniciar partida borrando los arrays de la sesion
 * @param $baraja
 * @param $cartasSacadas
 * @param $ganador
 * @return void
 */
function resetPartida(&$baraja, &$cartasSacadas) {
  $baraja = crearBarajaCartas();
  $cartasSacadas = [];
}

/**
 * Pedir una carta de la baraja que se pasa por parametro como referencia para modificarla
 * @param $baraja Baraja baraja de la que se sacara una carta
 * @return mixed|null Carta que se ha sacado
 */
function pedirCarta(&$baraja) {
  return array_pop($baraja);
}

/**
 * Eliminar las cartas que no se necesitan de la baraja
 * @param $baraja
 * @return void
 */
function eliminarCartasSobrantes(&$baraja) {
  // Guardar posiciones que se quieren eliminar recorriendo la baraja y comparando con cada carta sobrante
  $cartasSobrantes = ["8", "9", "10"];
  $posicionesABorrar = [];

  foreach ($baraja as $index => $carta) {
    foreach ($cartasSobrantes as $cartaSobrante) {
      if (strcmp($carta["carta"], $cartaSobrante) == 0) {
        $posicionesABorrar[] = $index;
        break;
      }
    }
  }

  // Recorrer las posiciones que se han guardado para borrar y ponerlo en null el valor en la baraja
  foreach ($posicionesABorrar as $posicion) {
    unset($baraja[$posicion]);
  }
}

/**
 * Funcion para volver a index.php pasandole una informacion en la url
 * @param $info
 * @return void
 */
function volverAIndex($info = "") {
  header("Location: index.php{$info}");
}

function devolverValorCarta($carta) {

  return match ($carta["carta"]) {
    "A" =>  1,
    "2" => 2,
    "3" => 3,
    "4" => 4,
    "5" => 5,
    "6" => 6,
    "7" => 7,
    "J", "Q", "K" => 0.5,
  };
}

function ganadorDeLaPartida(&$cartasSacadas) {
  $sumaCartas = 0;
  foreach ($cartasSacadas as $carta) {
    $sumaCartas += devolverValorCarta($carta);
  }

  if ($sumaCartas == 7.5) volverAIndex("?jugador=ganador");
  else if ($sumaCartas > 7.5) volverAIndex("?jugador=perdedor");
  else volverAIndex();
}
