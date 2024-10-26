<?php
session_start();
if (isset($_SESSION["usuario"])) {
  header("Location: proyectos.php");
  exit();
}
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <title>Registro de usuario</title>
</head>
<body>
<main>
  <section class="vh-100">
    <div class="container py-5 h-100">
      <div class="row d-flex align-items-center justify-content-center h-100">
        <div class="col-md-8 col-lg-7 col-xl-6">
          <img src="https://mdbcdn.b-cdn.net/img/Photos/new-templates/bootstrap-login-form/draw2.svg"
               class="img-fluid" alt="Phone image">
        </div>
        <div class="col-md-7 col-lg-5 col-xl-5 offset-xl-1">
          <form action="controlador.php" method="post">

            <?php
              if (isset($_GET["error"]) && strcmp($_GET["error"], "passwords-not-match") === 0) {
                echo "<h2 class='text-danger'>Las contraseñas no coinciden</h2>";
              }
              if (isset($_GET["error"]) && strcmp($_GET["error"], "user-already-exists") === 0) {
                echo "<h2 class='text-danger'>El usuario ya existe</h2>";
              }
              if (isset($_GET["error"]) && strcmp($_GET["error"], "register-failed") === 0) {
                echo "<h2 class='text-danger'>Error al registrar, intente de nuevo mas tarde</h2>";
              }
            ?>

            <!-- Username input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form1Example03">Nombre de usuario</label>
              <input type="text" id="form1Example03" class="form-control form-control-lg"
                     name="username" required />
            </div>

            <!-- Email input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form1Example13">Email</label>
              <input type="email" id="form1Example13" class="form-control form-control-lg"
                     name="email" required />
            </div>

            <!-- Password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form1Example23">Contraseña</label>
              <input type="password" id="form1Example23" class="form-control form-control-lg"
                     name="password" required minlength="8" />
            </div>

            <!-- Confirm password input -->
            <div data-mdb-input-init class="form-outline mb-4">
              <label class="form-label" for="form1Example33">Confirmar contraseña</label>
              <input type="password" id="form1Example33" class="form-control form-control-lg"
                     name="confirm-password" required minlength="8"/>
            </div>

            <div class="d-flex justify-content-center align-items-center mb-4">
              <!-- Submit button -->
              <button name="register" type="submit" data-mdb-button-init data-mdb-ripple-init
                      class="btn
                btn-primary btn-lg btn-block">Registrarse</button>
            </div>
            <p>¿Tienes una cuenta? <a href="login.php">Inicia sesión</a></p>
          </form>
        </div>
      </div>
    </div>
  </section>
</main>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>