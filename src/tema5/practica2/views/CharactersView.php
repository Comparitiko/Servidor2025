<?php

namespace DragonBallApp\views;

class CharactersView
{
  public static function render()
  {
    include_once "cabecera.php";
    ?>
    <section id="characters"></section>
    <?php
    include_once "pie.php";
  }
}