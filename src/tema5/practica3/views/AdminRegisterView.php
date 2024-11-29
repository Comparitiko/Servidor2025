<?php

namespace ChatGPTBlogs\views;

use ChatGPTBlogs\views\components\FooterComponent;
use ChatGPTBlogs\views\components\HeaderComponent;

class AdminRegisterView
{
  public static function render($info): void
  {
    HeaderComponent::render("Registro de usuario");
    ?>
    <main class="h-screen overflow-hidden bg-[#eaf2f5]">
      <div class="bg-grey-300 min-h-screen flex flex-col">
        <form
          action="index.php"
          method="post"
          class="container max-w-sm mx-auto flex-1 flex flex-col items-center justify-center px-2"
        >
          <div class="bg-white px-6 py-8 rounded shadow-lg text-black w-full ">
            <h1 class="mb-8 text-3xl text-center">Registrarse</h1>
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
                name="name"
                placeholder="Nombre completo"
                required
                minlength="2"
              />
            </label>

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
                minlength="8"
              />
            </label>

            <label>
              <input
                type="password"
                class="block border border-gray-300 w-full p-3 rounded mb-4"
                name="confirm_password"
                placeholder="Confirmar contraseña"
                required
                minlength="8"
              />
            </label>

            <input
              name="register_form"
              class="w-full text-center py-3 rounded bg-green-500 text-white hover:bg-green-700 focus:outline-none
              my-1"
              type="submit"
              value="Crear cuenta"
            >
          </div>

          <div class="text-grey-dark mt-6">
            ¿Tienes ya una cuenta?
            <a
              class="no-underline border-b border-blue text-blue-500 hover:text-blue-700 hover:underline"
              href="index.php?action=show_admin_login"
            >
              Inicia sesión
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
    FooterComponent::render();
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
      "passwords" => ["text-red-400", "Las contraseñas tienen que ser iguales"],
      "user_exists" => ["text-red-400", "El usuario con ese email ya existe"],
      "server_error" => ["text-red-400", "Ha ocurrido un error intentelo de nuevo mas tarde"]
    };
  }
}