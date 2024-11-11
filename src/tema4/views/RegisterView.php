<?php

namespace Coworking\views;

class RegisterView {

  private static function getErrorMessage($error): string
  {
    return match ($error) {
      "passwords" => "Las contraseñas introducidas no coinciden",
      "user_exists" => "Usuario o email ya existen",
      "server_error" => "Error en el registro, intente de nuevo mas tarde",
    };
  }

  public static function render($error): void
  {
    ?>
    <!doctype html>
    <html lang="es">
    <head>
      <meta charset="utf-8"/>
      <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover"/>
      <meta http-equiv="X-UA-Compatible" content="ie=edge"/>
      <title>Registro | Coworking Gabriel</title>
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
    <body  class=" d-flex flex-column">
    <script src="./views/assets/js/demo-theme.min.js?1692870487"></script>
    <div class="page page-center">
      <div class="container container-normal py-4">
        <div class="row align-items-center g-4">
          <div class="col-lg">
            <div class="container-tight">
              <div class="card card-md">
                <div class="card-body">
                  <h2 class="h2 text-center mb-2">Crea una cuenta de usuario</h2>
                  <?php
                  if (strlen($error) > 0) {
                    ?>
                    <p class="text-danger mb-2"><?=RegisterView::getErrorMessage($error)?></p>
                    <?php
                  }
                  ?>
                  <form action="index.php" method="POST">
                    <div class="mb-2">
                      <label for="username" class="form-label">Nombre de usuario</label>
                      <input id="username" name="username" type="text" class="form-control" required>
                    </div>
                    <div class="mb-2">
                      <label for="email" class="form-label">Email</label>
                      <input id="email" name="email" type="email" class="form-control" required>
                    </div>
                    <div class="mb-2">
                      <label for="password" class="form-label">Contraseña</label>
                      <input id="password" name="password" type="password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                      <label for="confirm_password" class="form-label">Confirmar contraseña</label>
                      <input id="confirm_password" name="confirm_password" type="password" class="form-control" required>
                    </div>
                    <div class="mb-2">
                      <label for="phone" class="form-label">Numero de teléfono</label>
                      <input id="phone" name="phone" type="tel" class="form-control" required pattern="^[0-9]{9}$">
                    </div>
                    <div class="form-footer">
                      <button type="submit" name="register" class="btn btn-primary w-100">Registrarse</button>
                    </div>
                  </form>
                </div>
              </div>
              <div class="text-center text-secondary mt-3">
                ¿Ya tienes una cuenta? <a href="index.php?action=show_login" tabindex="-1">Inicia sesión</a>
              </div>
            </div>
          </div>
          <div class="col-lg d-none d-lg-block">
            <img src="./views/assets/static/illustrations/undraw_secure_login_pdn4.svg" height="300" class="d-block mx-auto"
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