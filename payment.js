const cardNameInput = document.getElementById("cardName");
const cardNumberInput = document.getElementById("cardNumber");
const cvvInput = document.getElementById("cvv");
const paymentForm = document.getElementById("paymentForm");


cardNameInput.addEventListener("input", () => {
  cardNameInput.value = cardNameInput.value
    .toUpperCase()
    .replace(/[^A-Z\s]/g, "");
});


cardNumberInput.addEventListener("input", () => {
  let val = cardNumberInput.value;
  val = val.replace(/\D/g, "");
  val = val.match(/.{1,4}/g)?.join(" ") || "";
  cardNumberInput.value = val;
});


cvvInput.addEventListener("input", () => {
  cvvInput.value = cvvInput.value.replace(/\D/g, "");
});

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
