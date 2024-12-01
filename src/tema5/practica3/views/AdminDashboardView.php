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
    <div class="min-h-screen overflow-hidden bg-[#eaf2f5]">
      <header>
        <div class="flex items-center justify-between p-4">
          <h1 class="text-3xl">Panel de administración</h1>
          <a class="hover:underline hover:text-slate-700 mr-12" href="index.php?admin_logout">Cerrar sesión</a>
        </div>
        <h2 class="text-center text-2xl mb-4">
          Bienvenido <?= $_SESSION["user"]["name"] ?>
        </h2>
      </header>
      <main
        id="main-container"
        class="max-w-sm mx-auto px-2 min-h-screen">

        <label for="apikey-input"></label>
        <input
          id="apikey-input"
          class="w-full mx-auto p-2 rounded-lg bg-white text-black resize-none text-balance mb-4 border
          border-gray-300 focus:outline-none focus:border-blue-500"
          placeholder="Inserte su API Key de OpenAI"
        >

        <label for="titulo"></label>
        <textarea
          id="titulo"
          class="w-full mx-auto h-32 p-2 rounded-lg bg-white text-black border-gray-300 resize-none text-balance focus:outline-none focus:border-blue-500"
          placeholder="Inserte el titulo de la publicación que quieres generar"
        ></textarea>
        <button
          id="generarArticulo"
          class="w-full mx-auto py-2 rounded-lg bg-green-500 text-white hover:bg-green-700 focus:outline-none"
        >
          Generar artículo
        </button>
      </main>
    </div>
    <script src="./views/assets/js/index.js" type="module"></script>
    <?php
    FooterComponent::render();
  }
}