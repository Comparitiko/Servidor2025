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

});
