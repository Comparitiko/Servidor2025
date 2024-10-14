<?php
  session_start();
  if (isset($_SESSION["usuario"])) return header("Location: proyectos.php");
?>
<!doctype html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
  <link href="css/styles.css" rel="stylesheet" />
  <title>Inicio de sesión</title>
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
                if (isset($_GET["error"]) && strcmp($_GET["error"], "bad_request") === 0) {
                  echo "<h2 class='text-danger'>Error en el inicio de sesión</h2>";
                }
              ?>
              <!-- Email input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form1Example13">Email</label>
                <input type="text" id="form1Example13" class="form-control form-control-lg"
                       name="email" required />
              </div>

              <!-- Password input -->
              <div data-mdb-input-init class="form-outline mb-4">
                <label class="form-label" for="form1Example23">Contraseña</label>
                <input type="password" id="form1Example23" class="form-control form-control-lg"
                       name="password" required />
              </div>

              <div class="d-flex justify-content-center align-items-center mb-4">
                <!-- Submit button -->
                <button name="login" type="submit" data-mdb-button-init data-mdb-ripple-init
                        class="btn
                btn-primary btn-lg btn-block">Iniciar sesión</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </section>
  </main>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
</body>
</html>