<?php

namespace DragonBallApp\controllers;

use DragonBallApp\models\Character;
use DragonBallApp\views\CharacterInfoView;
use DragonBallApp\views\CharactersView;

class CharactersController
{
  public static function showAllCharacters(): void
  {
    CharactersView::render();
  }

  public static function showCharacterInfo($characterId): void
  {
    $uri = "https://dragonball-api.com/api/characters/$characterId";
    $reqPrefs['http']['method'] = 'GET';
    $stream_context = stream_context_create($reqPrefs);
    $response = file_get_contents($uri, false, $stream_context);
    if ($response) {
      $data = json_decode($response);
    }

    $character = new Character($data->name, $data->image, $data->ki, $data->race, $data->description);

    CharacterInfoView::render($character);
  }
}