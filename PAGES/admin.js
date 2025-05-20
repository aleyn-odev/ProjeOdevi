// Dropzone
const dropzone = document.getElementById("concertImageDrop");
const fileInput = document.getElementById("concertImage");
dropzone.addEventListener("click", () => fileInput.click());
dropzone.addEventListener("dragover", e => {
  e.preventDefault(); dropzone.classList.add("dragover");
});
dropzone.addEventListener("dragleave", () => dropzone.classList.remove("dragover"));
dropzone.addEventListener("drop", e => {
  e.preventDefault();
  dropzone.classList.remove("dragover");
  fileInput.files = e.dataTransfer.files;
});

// Üniversite listesini doldur
window.addEventListener("DOMContentLoaded", () => {
  const uniSelect = document.getElementById("uniSelect");
  const uniList = [
    { id: "itu", name: "İTÜ" },
    { id: "bo", name: "Boğaziçi" },
    { id: "odtu", name: "ODTÜ" }
  ];
  uniList.forEach(u => {
    const opt = document.createElement("option");
    opt.value = u.id; opt.textContent = u.name;
    uniSelect.appendChild(opt);
  });
});

// Konser kaydet: yıl kısıtı kontrolü ekleniyor
document.getElementById("saveConcert").addEventListener("click", () => {
  const dt = document.getElementById("datetime").value;
  const pattern = /^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/;
  if (!pattern.test(dt)) {
    alert("Lütfen 4 haneli yıl içeren geçerli bir tarih-saat girin (YYYY-MM-DDThh:mm).");
    return;
  }
  alert("Konser kaydediliyor... (backend call)");
});

document.getElementById("editConcert").addEventListener("click", () => {
  alert("Konser düzenleniyor...");
});
document.getElementById("deleteConcert").addEventListener("click", () => {
  if (confirm("Silmek istediğine emin misin?")) alert("Konser siliniyor...");
});

// Duyuru Yönetimi
const announcementText = document.getElementById("announcementText");
const announcementList = document.getElementById("announcementList");
document.getElementById("addAnnouncement").addEventListener("click", () => {
  const text = announcementText.value.trim();
  if (!text) return;
  const card = document.createElement("div");
  card.className = "announcement-card";
  card.innerHTML = `<p>${text}</p><button class="del-ann">×</button>`;
  card.querySelector(".del-ann").addEventListener("click", () => card.remove());
  announcementList.appendChild(card);
  announcementText.value = "";
});

// Hesap ayarları
document.getElementById("saveAccount").addEventListener("click", () => {
  const newPass = document.getElementById("newPassword").value;
  const confirmPass = document.getElementById("confirmPassword").value;
  const msg = document.getElementById("accountMessage");
  msg.textContent = "";
  if (!newPass || !confirmPass) {
    msg.textContent = "Lütfen tüm alanları doldurun.";
    return;
  }
  if (newPass !== confirmPass) {
    msg.textContent = "Şifreler eşleşmiyor.";
    return;
  }
  alert("Şifre güncelleniyor...");
});
