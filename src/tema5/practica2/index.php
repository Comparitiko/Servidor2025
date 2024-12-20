<?php

namespace DragonBallApp;

use DragonBallApp\controllers\CharactersController;

session_start();

/**
 * AUTOLOAD
 */
spl_autoload_register(function ($class) {
  $path = substr($class, strpos($class, "\\") + 1);
  $path = str_replace("\\", "/", $path);
  include_once "./" . $path . ".php";
});

if ($_GET) {
  if ($_GET["action"] === "show_character") {
    $characterId = $_GET["character_id"];
    CharactersController::showCharacterInfo($characterId);
  } else {
    CharactersController::showAllCharacters();
  }
} else {
  CharactersController::showAllCharacters();
}
