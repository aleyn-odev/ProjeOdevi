document.addEventListener("DOMContentLoaded", () => {
  const notifToggle = document.getElementById("notifToggle");
  const languageSelect = document.getElementById("languageSelect");

  // Bildirim ayarlarını backend'den yükleme yeri (örnek false)
  notifToggle.checked = false;

  notifToggle.addEventListener("change", () => {
    // Backend'e bildirim tercihi kaydetme işlemi yapılacak
  });

  // Dil seçimi
  languageSelect.addEventListener("change", () => {
    alert(`Dil seçimi değişti: ${languageSelect.value}`);
    // Backend'e dil tercihi kaydetme işlemi yapılacak
  });
});
