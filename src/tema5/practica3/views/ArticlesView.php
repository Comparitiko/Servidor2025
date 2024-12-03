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
    <div class="min-h-screen bg-slate-900 m-0">
      <header class="mb-10 p-5 text-white flex justify-between items-center">
        <h1 class="font-extrabold text-center text-3xl flex-1">Blogs</h1>
        <a
          class="hover:underline hover:text-red-400 mr-12 text-end"
          href="index.php?action=show_admin_login"
        >
          Ir al panel de administrador
        </a>
      </header>
      <main class="pb-10 m-0">

        <?php
        if (isset($info) && strlen($info) !== 0) {
          $infoMessage = self::getInfoMessage($info);
          ?>
          <h2 class="<?= $infoMessage[0] ?> text-center"><?= $infoMessage[1] ?></h2>
          <?php
        }
        ?>
        <div class="grid gap-10">
          <?php
          foreach ($articles as $article) {
            ?>
            <article class="w-1/2 mx-auto flex items-center justify-center gap-5 text-white">
              <section class="grid gap-5">
                <h1 class="text-2xl text-center font-bold"><?= $article->getTitle() ?></h1>
                <p><?= $article->getContent() ?></p>
              </section>
              <img
                class="rounded-lg"
                src="<?= $article->getImage() ?>"
                alt="Imagen de artículo"
                width="256"
                height="256"
              >
            </article>
            <?php
          }
          ?>
        </div>

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