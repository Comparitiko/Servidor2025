<?php
  session_start();
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <title>Siete y media</title>
  <style>
    img {
      width: 100px;
      height: 100%;
    }
  </style>
</head>
<body>
  <header>
    <h1 class="bg-danger text-center text-white">Juego de las siete y media</h1>
  </header>
  <main>
    <div class="container my-4">
      <?php
      if (isset($_GET["jugador"])) {
        if (strcmp($_GET["jugador"], "ganador") == 0) {
          echo "
            <div class='alert alert-success' role='alert'>
              <h2 class='text-success'>Ganaste wee</h2>  
            </div>
          ";
        } else if (strcmp($_GET["jugador"], "perdedor") == 0) {
          echo "
            <div class='alert alert-danger' role='alert'>
              <h2 class='text-danger'>Perdiste wee</h2>  
            </div>
          ";
        }
      } else {
        echo "<h2>Haga click en el dorso de la carta para pedir otra carta</h2>";
      }
      ?>
      <div class="d-flex flex-wrap gap-4 my-5">
        <?php
        $disabled = "";
        if (isset($_GET["jugador"])) $disabled = "disabled";
        echo "
          <a class='p-1 border border-4 btn {$disabled}' href='controlador.php?accion=nueva-carta'>
            <img src='./images/dorso-rojo.svg' alt='Dorso rojo de la carta'>
          </a>
        ";
          foreach ($_SESSION["cartas-sacadas"] as $carta) {
            echo "
              <img src='{$carta["imagen"]}' alt='Imagen carta {$carta["carta"]} de {$carta["palo"]}'>
            ";
          }
          if (isset($_GET["jugador"])) {
            if (strcmp($_GET["jugador"], "ganador") == 0) {
              echo "<img src='./images/cara-feliz.jpeg' alt='Carita feliz'>";
            } else if (strcmp($_GET["jugador"], "perdedor") == 0) {
              echo "<img src='./images/cara-triste.jpeg' alt='Carita triste'>";
            }
          }
        ?>
      </div>
      <?php
      // Comprobar si hay cartas sacadas, si no hay cartas pone el boton de reset, si no hay nada no lo pone
      if (isset($_SESSION["cartas-sacadas"]) && (count($_SESSION["cartas-sacadas"]) != 0))
        echo "<a href='controlador.php?accion=reset' class='btn btn-primary'>Reset</a>"
      ?>
    </div>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
