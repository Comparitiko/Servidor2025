<?php
/**
 * @param $fecha_inicio_string string fecha de inicio del proyecto
 * @return string con el numero de dias que lleva el proyecto en marcha
 * @throws DateMalformedStringException
 */
function calcularDiasTranscurridos($fecha_inicio_string)
{

  $fecha_inicio = new DateTime($fecha_inicio_string);

  return $fecha_inicio->diff(new DateTime("now"))->format("%a días");
}

?>