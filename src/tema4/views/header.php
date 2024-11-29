<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Coworking Gabriel</title>
  <link rel="icon" href="./views/assets/images/coworking-logo.jpg" type="image/jpg">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css">
</head>
<body>
<header class="p-3 bg-dark text-white">
  <div class="container">
    <div class="d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">

      <ul class="nav col-12 col-lg-auto me-lg-auto mb-4 justify-content-center mb-md-0">
        <li><a href="./index.php" class="nav-link px-2 text-white fs-4">Inicio</a></li>
        <li><a href="./index.php?action=show_my_reservations" class="nav-link px-2 text-white fs-4 ms-5">Mis
            reservas</a></li>
        <li><a href="./index.php?action=show_new_reservation" class="nav-link px-2 text-white fs-4 ms-5">Crear
            reserva</a></li>
      </ul>

      <div class="text-end d-flex align-items-center gap-4">
        <h4><?= $_SESSION["user"]["username"] ?></h4>
        <a href="./index.php?action=logout" type="button" class="btn btn-outline-light me-2">Cerrar sesión</a>
      </div>
    </div>
  </div>
</header>