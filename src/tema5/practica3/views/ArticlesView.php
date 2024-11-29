<?php

namespace ChatGPTBlogs\views;

use ChatGPTBlogs\views\components\Footer;
use ChatGPTBlogs\views\components\Header;

class ArticlesView
{
  public static function render(array $articles, $info): void
  {
    Header::render("Blogs");
    ?>
    <div class="h-screen overflow-hidden bg-slate-900">
      <header class="text-white">
        <h1>Blogs</h1>
        <a href="index.php?action=show_admin_login">Ir al panel de administrador</a>
      </header>
      <main>

        <?php
        if (isset($info) && strlen($info) !== 0) {
          $infoMessage = self::getInfoMessage($info);
          ?>
          <h2 class="<?= $infoMessage[0] ?> text-center"><?= $infoMessage[1] ?></h2>
          <?php
        }
        foreach ($articles as $article) {
          ?>
          <article>
            <h1><?= $article->getTitle() ?></h1>
            <p><?= $article->getContent() ?></p>
          </article>
          <?php
        }
        ?>

      </main>
    </div>
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
      "server_error" => ["text-red-400", "Ha ocurrido un error intentelo de nuevo mas tarde"]
    };
  }
}