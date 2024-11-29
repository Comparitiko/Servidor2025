<?php

namespace ChatGPTBlogs\views;

use ChatGPTBlogs\views\components\FooterComponent;
use ChatGPTBlogs\views\components\HeaderComponent;

class AdminDashboardView
{
  public static function render(): void
  {
    HeaderComponent::render("Panel de administración");
    ?>
    <div class="h-screen overflow-hidden bg-[#eaf2f5]">
      <header class="flex">
        <nav class="border-gray-200 bg-gray-900 w-full">
          <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
            <div class="hidden w-full md:block md:w-auto" id="navbar-default">
              <ul
                class="font-medium flex p-4 md:p-0 mt-4 border border-gray-700 rounded-lg bg-gray-800
                md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0 md:bg-gray-900">
                <li>
                  <a href="index.php?action=show_articles"
                     class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent
                     md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500
                     dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Volver a los
                    articulos</a>
                </li>
                <li>
                  <h2 class="text-white">Usuario: <?= $_SESSION["user"]["name"] ?></h2>
                </li>
                <li>
                  <a href="index.php?action=admin_logout"
                     class="block py-2 px-3 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent
                     md:border-0 md:hover:text-blue-700 md:p-0 dark:text-white md:dark:hover:text-blue-500
                     dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent">Cerrar sesión</a>
                </li>
              </ul>
            </div>
          </div>
        </nav>

      </header>
      <main id="main-container" class="flex flex-col items-center justify-center pt-20">
        <form id="new-article-form">
          <label for="title"></label>
          <textarea
            id="title"
            class="w-100 h-32 resize-none"
            placeholder="Inserte el título del artículo"
          ></textarea>
        </form>
      </main>
    </div>
    <?php
    FooterComponent::render();
  }
}