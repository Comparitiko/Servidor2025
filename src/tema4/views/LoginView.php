<?php

namespace Coworking\views;

class LoginView
{

  private static function getInfoMessage($info): array
  {
    return match ($info) {
      "login_fail" => ["error", "El email o la contraseña son incorrectos"],
      "server_error" => ["error", "Error en el inicio de sesión, intente de nuevo mas tarde"],
    };
  }

  public static function render($info)
  {
    ?>
    <!doctype html>
    <html lang="es">
    <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
      <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
      <title>Inicio de sesión | Coworking Gabriel</title>
      <!-- CSS files -->
      <link href="./views/assets/css/tabler.min.css?1692870487" rel="stylesheet"/>
      <link href="./views/assets/css/tabler-flags.min.css?1692870487" rel="stylesheet"/>
      <link href="./views/assets/css/tabler-payments.min.css?1692870487" rel="stylesheet"/>
      <link href="./views/assets/css/tabler-vendors.min.css?1692870487" rel="stylesheet"/>
      <link href="./views/assets/css/demo.min.css?1692870487" rel="stylesheet"/>
      <style>
        @import url('https://rsms.me/inter/inter.css');

        :root {
          --tblr-font-sans-serif: 'Inter Var', -apple-system, BlinkMacSystemFont, San Francisco, Segoe UI, Roboto, Helvetica Neue, sans-serif;
        }

        body {
          font-feature-settings: "cv03", "cv04", "cv11";
        }
      </style>
    </head>
    <body class=" d-flex flex-column">
    <script src="./views/assets/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
      <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
          <div class="col-lg">
            <div class="container-tight">
              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-4">Inicia sesión con tu cuenta</h2>
                  <?php
                  if (strlen($info) > 0) {
                    $infoMessage = self::getInfoMessage($info);

                    if ($infoMessage[0] === "error") echo "<p class='text-danger mb-2'>{$infoMessage[1]}</p>";
                  }
                  ?>
                  <form action="index.php" method="POST">
                    <div class="mb-3">
                      <label for="email" class="form-label">Email</label>
                      <input id="email" name="email" type="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                      <label for="password" class="form-label">Contraseña</label>
                      <input id="password" name="password" type="password" class="form-control" required>
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="login" class="btn btn-primary w-100">Iniciar sesión</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="text-center text-secondary mt-3">
                ¿No tienes una cuenta? <a href="index.php?action=show_register" tabindex="-1">Registrate</a>
              </div>
            </div>
          </div>
          <div class="col-lg d-none d-lg-block">
            <img src="./views/assets/static/illustrations/undraw_secure_login_pdn4.svg" height="300"
                 class="d-block mx-auto"
                 alt="Secure login image">
          </div>
        </div>
      </div>
    </div>
    <!-- Libs JS -->
    <!-- Tabler Core -->
    <script src="./views/assets/js/tabler.min.js?1692870487" defer></script>
    <script src="./views/assets/js/demo.min.js?1692870487" defer></script>
    </body>
    </html>
    <?php
  }
}