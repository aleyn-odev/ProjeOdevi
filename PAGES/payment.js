const cardNameInput = document.getElementById("cardName");
const cardNumberInput = document.getElementById("cardNumber");
const cvvInput = document.getElementById("cvv");
const paymentForm = document.getElementById("paymentForm");

// Kart üzerindeki isim inputu: sadece harf ve boşluk kabul et, otomatik büyük harfe çevir
cardNameInput.addEventListener("input", () => {
  cardNameInput.value = cardNameInput.value
    .toUpperCase()
    .replace(/[^A-Z\s]/g, "");
});

// Kart numarası inputu: sadece rakamları al, araya otomatik boşluk ekle
cardNumberInput.addEventListener("input", () => {
  let val = cardNumberInput.value;
  val = val.replace(/\D/g, "");
  val = val.match(/.{1,4}/g)?.join(" ") || "";
  cardNumberInput.value = val;
});

// CVV inputu: sadece rakam kabul et
cvvInput.addEventListener("input", () => {
  cvvInput.value = cvvInput.value.replace(/\D/g, "");
});

// Form gönderildiğinde basit kontrol
paymentForm.addEventListener("submit", (e) => {
  e.preventDefault();

  const cardName = cardNameInput.value.trim();
  const cardNumber = cardNumberInput.value.replace(/\s/g, "");
  const expiry = document.getElementById("expiry").value;
  const cvv = cvvInput.value;

  if (!cardName || cardNumber.length < 16 || !expiry || cvv.length < 3) {
    alert("Lütfen tüm kart bilgilerini doğru ve eksiksiz girin.");
    return;
  }

  alert("Ödeme bilgilerinizi aldık. Backend ile işleme alınıyor.");
});
