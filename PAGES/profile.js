// Varsayılan kullanıcı verisi (backend'den gelecek aslında)
const userData = {
  fullName: "Ahmet Yılmaz",
  email: "ahmet.yilmaz@edu.tr",
  university: "istanbul_uni"
};

// Varsayılan üniversite listesi (backend'den dinamik gelecek)
const universityList = [
  { id: "istanbul_uni", name: "İstanbul Üniversitesi" },
  { id: "boğaziçi_uni", name: "Boğaziçi Üniversitesi" },
  { id: "hacettepe_uni", name: "Hacettepe Üniversitesi" },
  { id: "ankara_uni", name: "Ankara Üniversitesi" },
];

// Sayfa yüklendiğinde kullanıcı verisini ve üniversite listesini göster
window.addEventListener("DOMContentLoaded", () => {
  document.getElementById("fullName").value = userData.fullName;
  document.getElementById("email").value = userData.email;

  const universitySelect = document.getElementById("university");
  universityList.forEach(uni => {
    const option = document.createElement("option");
    option.value = uni.id;
    option.textContent = uni.name;
    if (uni.id === userData.university) option.selected = true;
    universitySelect.appendChild(option);
  });
});

// Üniversite kaydetme butonu
document.getElementById("saveUniversityBtn").addEventListener("click", () => {
  const selectedUni = document.getElementById("university").value;
  if (!selectedUni) {
    alert("Lütfen bir üniversite seçin.");
    return;
  }
  // Backend'e POST isteği gönderilecek (şimdilik alert)
  alert(`Üniversiteniz "${universityList.find(u => u.id === selectedUni).name}" olarak kaydedildi.`);
});

// Şifre validasyon fonksiyonu
function validatePassword(password) {
  const minLength = 8;
  const hasUpper = /[A-Z]/.test(password);
  const hasLower = /[a-z]/.test(password);
  const hasSymbol = /[!@#$%^&*(),.?":{}|<>]/.test(password);
  return password.length >= minLength && hasUpper && hasLower && hasSymbol;
}

// Şifre yenileme işlemi
document.getElementById("savePasswordBtn").addEventListener("click", () => {
  const newPass = document.getElementById("newPassword").value;
  const confirmPass = document.getElementById("confirmPassword").value;
  const messageEl = document.getElementById("passwordMessage");

  if (!newPass || !confirmPass) {
    messageEl.textContent = "Lütfen her iki alanı da doldurun.";
    return;
  }
  if (newPass !== confirmPass) {
    messageEl.textContent = "Şifreler eşleşmiyor!";
    return;
  }
  if (!validatePassword(newPass)) {
    messageEl.textContent = "Şifre en az 8 karakter olmalı, büyük harf, küçük harf ve sembol içermelidir.";
    return;
  }

  messageEl.textContent = "";
  // Backend'e şifre değişikliği gönderilecek (şimdilik alert)
  alert("Şifreniz başarıyla değiştirildi.");
  // Alanları temizle
  document.getElementById("newPassword").value = "";
  document.getElementById("confirmPassword").value = "";
});
