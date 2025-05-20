document.addEventListener("DOMContentLoaded", () => {
  const notifToggle = document.getElementById("notifToggle");
  const languageSelect = document.getElementById("languageSelect");

  notifToggle.checked = false;

  notifToggle.addEventListener("change", () => {

  });


  languageSelect.addEventListener("change", () => {
    alert(`Dil seçimi değişti: ${languageSelect.value}`);

  });
});
