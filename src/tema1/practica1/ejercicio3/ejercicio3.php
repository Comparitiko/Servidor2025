<?php
$imagesPath = "http://localhost:8080/tema1/practica1/ejercicio3/images";

enum STATS: string {
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
    "image" => "{$imagesPath}/mewtwo",
    "types" => [
      "first_type" => "psiquico",
      "second_type" => "",
    ],
    "stats" => [
      STATS::HP->value => 106,
      STATS::ATTACK->value => 110,
      STATS::DEFENSE->value => 90,
      STATS::SPECIAL_ATTACK->value => 154,
      STATS::SPECIAL_DEFENSE->value => 90,
      STATS::SPEED->value => 130,
    ],
    "altura" => 20,
    "peso" => 1220,
  ],
  [
    "name" => "Raichu",
    "image" => "{$imagesPath}/raichu",
    "types" => [
      "first_type" => "eléctrico",
      "second_type" => "",
    ],
    "stats" => [
      STATS::HP->value => 60,
      STATS::ATTACK->value => 90,
      STATS::DEFENSE->value => 55,
      STATS::SPECIAL_ATTACK->value => 90,
      STATS::SPECIAL_DEFENSE->value => 80,
      STATS::SPEED->value => 110,
    ],
    "altura" => 8,
    "peso" => 300,
  ],
  [
    "name" => "Zamazenta",
    "image" => "{$imagesPath}/zamazenta",
    "types" => [
      "first_type" => "lucha",
      "second_type" => "",
    ],
    "stats" => [
      STATS::HP->value => 92,
      STATS::ATTACK->value => 120,
      STATS::DEFENSE->value => 115,
      STATS::SPECIAL_ATTACK->value => 80,
      STATS::SPECIAL_DEFENSE->value => 115,
      STATS::SPEED->value => 138,
    ],
    "altura" => 29,
    "peso" => 2100,
  ],
  [
    "name" => "Zacian",
    "image" => "{$imagesPath}/zacian",
    "types" => [
      "first_type" => "hada",
      "second_type" => "",
    ],
    "stats" => [
      STATS::HP->value => 92,
      STATS::ATTACK->value => 120,
      STATS::DEFENSE->value => 115,
      STATS::SPECIAL_ATTACK->value => 115,
      STATS::SPECIAL_DEFENSE->value => 138,
      STATS::SPEED->value => 130,
    ],
    "altura" => 28,
    "peso" => 1100,
  ],
  [
    "name" => "Pikachu",
    "image" => "{$imagesPath}/pikachu",
    "types" => [
      "first_type" => "eléctrico",
      "second_type" => "",
    ],
    "stats" => [
      STATS::HP->value => 35,
      STATS::ATTACK->value => 55,
      STATS::DEFENSE->value => 40,
      STATS::SPECIAL_ATTACK->value => 50,
      STATS::SPECIAL_DEFENSE->value => 50,
      STATS::SPEED->value => 90,
    ],
    "altura" => 4,
    "peso" => 60,
  ],
  [
    "name" => "Charizard",
    "image" => "{$imagesPath}/charizard",
    "types" => [
      "first_type" => "fuego",
      "second_type" => "volador",
    ],
    "stats" => [
      STATS::HP->value => 78,
      STATS::ATTACK->value => 84,
      STATS::DEFENSE->value => 78,
      STATS::SPECIAL_ATTACK->value => 109,
      STATS::SPECIAL_DEFENSE->value => 85,
      STATS::SPEED->value => 100,
    ],
    "altura" => 17,
    "peso" => 905,
  ],
  [
    "name" => "Bulbasaur",
    "image" => "{$imagesPath}/bulbasaur",
    "types" => [
      "first_type" => "planta",
      "second_type" => "",
    ],
    "stats" => [
      STATS::HP->value => 45,
      STATS::ATTACK->value => 49,
      STATS::DEFENSE->value => 49,
      STATS::SPECIAL_ATTACK->value => 65,
      STATS::SPECIAL_DEFENSE->value => 65,
      STATS::SPEED->value => 45,
    ],
    "altura" => 7,
    "peso" => 69,
  ],
  [
    "name" => "Squirtle",
    "image" => "{$imagesPath}/squirtle",
    "types" => [
      "first_type" => "agua",
      "second_type" => "",
    ],
    "stats" => [
      STATS::HP->value => 44,
      STATS::ATTACK->value => 48,
      STATS::DEFENSE->value => 65,
      STATS::SPECIAL_ATTACK->value => 50,
      STATS::SPECIAL_DEFENSE->value => 64,
      STATS::SPEED->value => 43,
    ],
    "altura" => 5,
    "peso" => 90,
  ]
];

function calculateTotalStatsPoints($pokemon) {
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
function getClassForStat($stat) {
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
 * @param $statValue int Value of the stat
 * @param $totalStatsPoints int total stats points
 * @return int percentage of stat
 */
function calculatePercentage($statValue, $totalStatsPoints) {
  return round($statValue * 100 / $totalStatsPoints);
}

/**
 * @param $stat STATS stat to print
 * @param $statValue int Value of the stat
 * @param $totalStatsPoints int total stats points
 * @return void
 */
function createStat($stat, $statValue, $totalStatsPoints) {
  $percentage = calculatePercentage($statValue, $totalStatsPoints);
  $colorClass = getClassForStat($stat);
  echo "<section>";
  echo "<h1>{$stat->value}</h1>";
  echo "<div class='progress' role='progressbar' aria-label='Basic example' aria-valuenow='0' aria-valuemin='0' aria-valuemax='100'>";
  echo "<div class='progress-bar progress-bar-striped progress-bar-animated {$colorClass}' style=\"width: {$percentage}%\">{$percentage}</div>";
  echo "</div>";
  echo "</section>";
}

/**
 * @param $pokemon array Pokémon to print the information in html
 * @return void
 */
function createPokemonCard($pokemon) {
  $totalStatPoints = calculateTotalStatsPoints($pokemon);

  echo "<section class='card'>";
  echo "<article>";

  echo "</article>";
  echo "<article>";
  foreach ($pokemon["stats"] as $stat)
  echo "</article>";
  echo "</section>";
}
?>

<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Práctica 1 Ejercicio 3</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="container">
  <main>
    <?php
    foreach ($pokemons as $pokemon) {
      createPokemonCard($pokemon);
    }
    ?>
  </main>
</div>

  <header>

  </header>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
