<?php
$imagesPath = "./images";

enum STATS: string
{
  case HP = "hp";
  case ATTACK = "attack";
  case DEFENSE = "defense";
  case SPECIAL_ATTACK = "special_attack";
  case SPECIAL_DEFENSE = "special_defense";
  case SPEED = "speed";
}

$pokemons = [
  [
    "name" => "Mewtwo",
    "image" => "{$imagesPath}/mewtwo.png",
    "types" => [
      "primary_type" => "psiquico"
    ],
    "stats" => [
      STATS::HP->value => 106,
      STATS::ATTACK->value => 110,
      STATS::DEFENSE->value => 90,
      STATS::SPECIAL_ATTACK->value => 154,
      STATS::SPECIAL_DEFENSE->value => 90,
      STATS::SPEED->value => 130,
    ],
  ],
  [
    "name" => "Raichu",
    "image" => "{$imagesPath}/raichu.png",
    "types" => [
      "primary_type" => "electrico"
    ],
    "stats" => [
      STATS::HP->value => 60,
      STATS::ATTACK->value => 90,
      STATS::DEFENSE->value => 55,
      STATS::SPECIAL_ATTACK->value => 90,
      STATS::SPECIAL_DEFENSE->value => 80,
      STATS::SPEED->value => 110,
    ],
  ],
  [
    "name" => "Zamazenta",
    "image" => "{$imagesPath}/zamazenta.png",
    "types" => [
      "primary_type" => "lucha"
    ],
    "stats" => [
      STATS::HP->value => 92,
      STATS::ATTACK->value => 120,
      STATS::DEFENSE->value => 115,
      STATS::SPECIAL_ATTACK->value => 80,
      STATS::SPECIAL_DEFENSE->value => 115,
      STATS::SPEED->value => 138,
    ],
  ],
  [
    "name" => "Zacian",
    "image" => "{$imagesPath}/zacian.png",
    "types" => [
      "primary_type" => "hada"
    ],
    "stats" => [
      STATS::HP->value => 92,
      STATS::ATTACK->value => 120,
      STATS::DEFENSE->value => 115,
      STATS::SPECIAL_ATTACK->value => 115,
      STATS::SPECIAL_DEFENSE->value => 138,
      STATS::SPEED->value => 130,
    ],
  ],
  [
    "name" => "Pikachu",
    "image" => "{$imagesPath}/pikachu.png",
    "types" => [
      "primary_type" => "electrico"
    ],
    "stats" => [
      STATS::HP->value => 35,
      STATS::ATTACK->value => 55,
      STATS::DEFENSE->value => 40,
      STATS::SPECIAL_ATTACK->value => 50,
      STATS::SPECIAL_DEFENSE->value => 50,
      STATS::SPEED->value => 90,
    ],
  ],
  [
    "name" => "Charizard",
    "image" => "{$imagesPath}/charizard.png",
    "types" => [
      "primary_type" => "fuego",
      "second_type" => "volador"
    ],
    "stats" => [
      STATS::HP->value => 78,
      STATS::ATTACK->value => 84,
      STATS::DEFENSE->value => 78,
      STATS::SPECIAL_ATTACK->value => 109,
      STATS::SPECIAL_DEFENSE->value => 85,
      STATS::SPEED->value => 100,
    ],
  ],
  [
    "name" => "Bulbasaur",
    "image" => "{$imagesPath}/bulbasaur.png",
    "types" => [
      "primary_type" => "planta"
    ],
    "stats" => [
      STATS::HP->value => 45,
      STATS::ATTACK->value => 49,
      STATS::DEFENSE->value => 49,
      STATS::SPECIAL_ATTACK->value => 65,
      STATS::SPECIAL_DEFENSE->value => 65,
      STATS::SPEED->value => 45,
    ],
  ],
  [
    "name" => "Squirtle",
    "image" => "{$imagesPath}/squirtle.png",
    "types" => [
      "primary_type" => "agua"
    ],
    "stats" => [
      STATS::HP->value => 44,
      STATS::ATTACK->value => 48,
      STATS::DEFENSE->value => 65,
      STATS::SPECIAL_ATTACK->value => 50,
      STATS::SPECIAL_DEFENSE->value => 64,
      STATS::SPEED->value => 43,
    ],
  ]
];

/**
 * @param $pokemon array Pokemon to get the total points of his stats
 * @return int total points of the stats
 */
function calculateTotalStatsPoints($pokemon)
{
  $totalStatsPoints = 0;
  foreach ($pokemon["stats"] as $stat) {
    $totalStatsPoints += $stat;
  }
  return $totalStatsPoints;
}

/**
 * @param $stat STATS stat to get the color
 * @return string class to add in the progress bar
 */
function getClassForStat($stat)
{
  return match ($stat) {
    STATS::HP => "bg-success",
    STATS::ATTACK => "bg-warning",
    STATS::DEFENSE => "bg-danger",
    STATS::SPECIAL_ATTACK => "bg-info",
    STATS::SPECIAL_DEFENSE => "bg-secondary",
    STATS::SPEED => "bg-primary",
  };
}

/**
 * @param $stat STATS stat to get the name
 * @return string name for the html
 */
function getStatName($stat)
{
  return match ($stat) {
    STATS::HP => "HP",
    STATS::ATTACK => "Ataque",
    STATS::DEFENSE => "Defensa",
    STATS::SPECIAL_ATTACK => "Ataque especial",
    STATS::SPECIAL_DEFENSE => "Defensa especial",
    STATS::SPEED => "Velocidad",
  };
}

/**
 * @param $statValue int Value of the stat
 * @param $totalStatsPoints int total stats points
 * @return int percentage of stat
 */
function calculatePercentage($statValue, $totalStatsPoints)
{
  return round($statValue * 250 / $totalStatsPoints);
}

/**
 * @param $stat STATS stat to print
 * @param $statValue int Value of the stat
 * @param $totalStatsPoints int total stats points
 * @return void
 */
function createStat($stat, $statValue, $totalStatsPoints)
{
  $percentage = calculatePercentage($statValue, $totalStatsPoints);
  $colorClass = getClassForStat($stat);
  $statName = getStatName($stat);

  echo "<section>";
  echo "<h1 class='fw-semibold'>{$statName}</h1>";
  echo "<div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>";
  echo "<div class='progress-bar progress-bar-striped progress-bar-animated {$colorClass}' style=\"width: {$percentage}%\">{$statValue}</div>";
  echo "</div>";
  echo "</section>";
}

/**
 * @param $pokemon array Pokémon to print the information in html
 * @return void
 */
function createPokemonCard($pokemon)
{
  $totalStatPoints = calculateTotalStatsPoints($pokemon);
  $cases = STATS::cases();

  echo "<section class='card p-4 shadow-lg rounded-end bg-light'>";
  echo "<h1 class='text-center fw-bolder mt-5'>{$pokemon["name"]}</h1>";
  echo "<article class='d-flex flex-wrap justify-content-around gap-1'>";
  echo "<div class='d-grid gap-2'>";
  echo "<img class='mb-5' src='{$pokemon["image"]}' alt='Imagen de {$pokemon["name"]}' />";
  echo "<section class='d-flex justify-content-around'>";
  foreach ($pokemon["types"] as $type) {
    echo "<h3 class='{$type} badge rounded-pill p-2 fw-bolder type'>" . strtoupper($type) . "</h3>";
  }
  echo "</section>";
  echo "</div>";
  echo "<section>";
  foreach ($cases as $case) {
    createStat($case, $pokemon["stats"][$case->value], $totalStatPoints);
  }
  echo "</section>";
  echo "</section>";
}

?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Práctica 1 Ejercicio 3</title>
  <link rel="icon" type="image/svg+xml" href="./images/pokeball.svg"/>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
    .type {
      color: white;
      width: 100px;
    }

    .psiquico {
      background-color: hotpink;
    }

    .electrico {
      background-color: yellow;
    }

    .lucha {
      background-color: saddlebrown;
    }

    .hada {
      background-color: hotpink;
    }

    .fuego {
      background-color: red;
    }

    .volador {
      background-color: cornflowerblue;
    }

    .planta {
      background-color: green;
    }

    .agua {
      background-color: blue;
    }
  </style>
</head>
<body>
<div class="bg-dark p-4">
  <header>
    <h1 class="text-center text-white">Pokémon</h1>
  </header>
  <main class="d-grid gap-5 p-5">
    <?php
    foreach ($pokemons as $pokemon) {
      createPokemonCard($pokemon);
    }
    ?>
  </main>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
</body>
</html>
