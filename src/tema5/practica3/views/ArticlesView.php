<?php

namespace ChatGPTBlogs\views;

use ChatGPTBlogs\views\components\FooterComponent;
use ChatGPTBlogs\views\components\HeaderComponent;

class ArticlesView
{
  public static function render(array $articles, $info): void
  {
    HeaderComponent::render("Blogs");
    ?>
    <div class="bg-gray-100">
      <header class="bg-blue-600 text-white p-4">
        <div class="container mx-auto flex items-center justify-between">
          <div class="w-1/3">
            <!-- Espacio vacío a la izquierda para mantener el balance -->
          </div>
          <div class="w-1/3 text-center">
            <h1 class="text-3xl font-extrabold">Blogs</h1>
          </div>
          <div class="w-1/3 text-right">
            <a href="index.php?action=show_admin_dashboard"
               class="text-white hover:underline hover:text-blue-200 transition duration-300 ease-in-out">
              Ir al panel de administrador
            </a>
          </div>
        </div>
      </header>
      <main class="container mx-auto mt-8 px-4">

        <?php
        if (isset($info) && strlen($info) !== 0) {
          $infoMessage = self::getInfoMessage($info);
          ?>
          <h2 class="<?= $infoMessage[0] ?> text-center"><?= $infoMessage[1] ?></h2>
          <?php
        }
        ?>
        <section class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
          <?php
          foreach ($articles as $article) {
            ?>
            <article class="bg-white rounded-lg shadow-md overflow-hidden">
              <img src="<?= $article->getImage() ?>" width="256" height="256" alt="Imagen de noticia 1"
                   class="w-full h-64 object-cover">
              <div class="p-4">
                <h2 class="text-xl font-semibold mb-2"><?= $article->getTitle() ?></h2>
                <p class="text-gray-600 mb-4"><?= $article->getContent() ?></p>
              </div>
            </article>
            <?php
          }
          ?>
        </section>

      </main>
    </div>
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
      "server_error" => ["text-red-400", "Ha ocurrido un error intentelo de nuevo mas tarde"]
    };
  }
}