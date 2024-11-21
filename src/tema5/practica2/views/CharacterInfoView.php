<?php

namespace DragonBallApp\views;

use DragonBallApp\models\Character;

class CharacterInfoView
{
  public static function render(Character $character): void
  {
    include_once "cabecera.php";
    ?>
    <article class="character-container">
    <section class="character-info">
      <h1 class="character-name"><?= $character->getName() ?></h1>
      <img src="<?= $character->getImage() ?>" alt="Imagen de <?= $character->getName() ?>" class="character-image">
      <h2 class="character-ki">Ki: <?= $character->getKi() ?></h2>
      <h2 class="character-race <?= strtolower($character->getRace()) ?>"><?= $character->getRace() ?></h2>
    </section>
    <section>
      <p class="character-description"><?= $character->getDescription() ?></p>
    </section>
    <?php
    include_once "pie.php";
  }
}