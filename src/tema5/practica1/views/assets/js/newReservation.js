const reservationDateInput = document.querySelector("#reservationDate");

// Script para que sea valido solo la reserva para el dia siguiente
window.addEventListener("DOMContentLoaded", () => {
  const todayDate = new Date()
  todayDate.setDate(todayDate.getDate() + 1)
  const todayStr = todayDate.toISOString().split('T')[0];
  reservationDateInput.setAttribute('min', todayStr)
})