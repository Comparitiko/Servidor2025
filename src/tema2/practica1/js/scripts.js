/*!
    * Start Bootstrap - SB Admin v7.0.7 (https://startbootstrap.com/template/sb-admin)
    * Copyright 2013-2023 Start Bootstrap
    * Licensed under MIT (https://github.com/StartBootstrap/startbootstrap-sb-admin/blob/master/LICENSE)
    */
//
// Scripts
// 

window.addEventListener('DOMContentLoaded', event => {

  // Toggle the side navigation
  const sidebarToggle = document.body.querySelector('#sidebarToggle');
  if (sidebarToggle) {
    // Uncomment Below to persist sidebar toggle between refreshes
    if (localStorage.getItem('sb|sidebar-toggle') === 'true') {
      document.body.classList.toggle('sb-sidenav-toggled');
    }
    sidebarToggle.addEventListener('click', event => {
      event.preventDefault();
      document.body.classList.toggle('sb-sidenav-toggled');
      localStorage.setItem('sb|sidebar-toggle', document.body.classList.contains('sb-sidenav-toggled'));
    });
  }

  const allTds = document.querySelectorAll("td")

  allTds.forEach(td => {
    td.classList.add("align-middle")
  })

  // Seleccionar los tds que sean los dos ultimos de cada tr
  const LatestTds = document.querySelectorAll("#datatablesSimple tr > td:last-child")
  const penultimatesTds = document.querySelectorAll("#datatablesSimple tr > td:nth-last-child(2)")

  const twoLasttds = [...penultimatesTds, ...LatestTds]

  // Añadir la clase text-ceneter a los tds
  twoLasttds.forEach((td) => {
    td.classList.add("text-center",)
  })

  const importanciaInput = document.querySelector("input#importancia")
  const porcentajeInput = document.querySelector("input#porcentaje-completado")
  const fechaInicioInput = document.querySelector("input#fecha-inicio")
  const fechaFinInput = document.querySelector("input#fecha-fin")

  if (!importanciaInput) return
  if (!porcentajeInput) return
  if (!fechaInicioInput) return
  if (!fechaFinInput) return

  // Poner la fecha maxima de inicio en hoy y la minima en la fecha fin igual
  const today = new Date().toISOString().split('T')[0];
  fechaInicioInput.setAttribute('max', today);
  fechaFinInput.setAttribute('min', today)

  // Controlar que sea un numero entre 0 y 100
  porcentajeInput.addEventListener("keyup", (e) => {
    const valorNum = parseInt(e.target.value)
    if (e.key === "Backspace") return

    if (isNaN(valorNum)) e.target.value = 0
    if (valorNum > 100) e.target.value = 100
  })

  // Controlar que sea un numero entre 1 y 5
  importanciaInput.addEventListener("keyup", (e) => {
    const valorNum = parseInt(e.target.value)
    if (e.key === "Backspace") return

    if (isNaN(valorNum)) e.target.value = 1
    if (valorNum > 5) e.target.value = 5
  })

});
