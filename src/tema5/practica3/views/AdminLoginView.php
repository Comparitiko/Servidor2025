<?php

namespace ChatGPTBlogs\views;

use ChatGPTBlogs\views\components\Footer;
use ChatGPTBlogs\views\components\Header;

class AdminLoginView
{
  public static function render($info = ""): void
  {
    Header::render("Registro de usuario");
    ?>
    <main class="h-screen overflow-hidden bg-[#eaf2f5]">
      <div class="bg-grey-300 min-h-screen flex flex-col">
        <form
          action="index.php"
          method="post"
          class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2"
        >
          <div class="bg-white px-6 py-8 rounded shadow-lg text-black w-full ">
            <h1 class="mb-8 text-3xl text-center">Iniciar sesión</h1>

            <?php
            if (strlen($info) !== 0) {
              $infoMessage = self::getInfoMessage($info);
              ?>
              <p class="<?= $infoMessage[0] ?>"><?= $infoMessage[1] ?></p>
              <?php
            }
            ?>

            <label>
              <input
                type="text"
                class="block border border-gray-300 w-full p-3 rounded mb-4"
                name="email"
                placeholder="Email"
                required
              />
            </label>

            <label>
              <input
                type="password"
                class="block border border-gray-300 w-full p-3 rounded mb-4"
                name="password"
                placeholder="Contraseña"
                required
              />
            </label>

            <input
              name="login_form"
              class="w-full text-center py-3 rounded bg-green-500 text-white hover:bg-green-700 focus:outline-none
              my-1"
              type="submit"
              value="Iniciar sesión"
            >
          </div>

          <div class="text-gray-800 mt-6">
            ¿No tienes una cuenta?
            <a
              class="no-underline border-b border-blue text-blue-500 hover:text-blue-700 hover:underline"
              href="index.php?action=show_admin_register"
            >
              Registrate
            </a>.
          </div>
          <div class="mt-6">
            <a
              class="no-underline border-b border-blue text-blue-500 hover:text-blue-700 hover:underline"
              href="index.php"
            >
              Volver a los articulos
            </a>
          </div>
        </form>
      </div>
    </main>
    <?php
    Footer::render();
  }

  /**
   * Get the info message as array with the class to put in the html tag and the text
   * First position is the class and the second one is the text message
   * @param $info
   * @return string[]
   */
  private static function getInfoMessage($info): array
  {
    return match ($info) {
      "server_error" => ["text-red-400", "Ha ocurrido un error intentelo de nuevo mas tarde"],
      "invalid_login" => ["text-red-400", "El email o la contraseña no son validos"]
    };
  }
}