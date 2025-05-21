// --- STATE ---
let events = [];
let currentEvent = null;

// --- ELEMENTS ---
const listEl     = document.getElementById("eventList");
const artistEl   = document.getElementById("artist");
const uniSelect  = document.getElementById("uniSelect");
const locationEl = document.getElementById("location");
const datetimeEl = document.getElementById("datetime");
const saveBtn    = document.getElementById("saveConcert");
const editBtn    = document.getElementById("editConcert");
const deleteBtn  = document.getElementById("deleteConcert");
const modal      = document.getElementById("confirmModal");
const yesBtn     = document.getElementById("confirmYes");
const noBtn      = document.getElementById("confirmNo");

// --- INIT ---
window.addEventListener("DOMContentLoaded", () => {
  ["İTÜ","Boğaziçi","ODTÜ"].forEach(u => {
    const opt = document.createElement("option");
    opt.value = u; opt.textContent = u;
    uniSelect.appendChild(opt);
  });
  renderList();
});

// --- RENDER LIST ---
function renderList() {
  listEl.querySelectorAll(".event-item").forEach(n => n.remove());
  events.forEach(ev => {
    const div = document.createElement("div");
    div.className = "event-item";
    div.textContent = ev.artist;
    div.onclick = () => selectEvent(ev, div);
    listEl.appendChild(div);
  });
}

// --- SELECT EVENT ---
function selectEvent(ev, div) {
  currentEvent = ev;
  listEl.querySelectorAll(".event-item").forEach(n => n.classList.remove("active"));
  div.classList.add("active");
  artistEl.value   = ev.artist;
  uniSelect.value  = ev.uni;
  locationEl.value = ev.location;
  datetimeEl.value = ev.datetime;
  setDisabled(true);
  saveBtn.disabled   = true;
  editBtn.disabled   = false;
  deleteBtn.disabled = false;
}

// --- DISABLE/ENABLE FORM ---
function setDisabled(dis) {
  [artistEl, uniSelect, locationEl, datetimeEl].forEach(e => e.disabled = dis);
}

// --- SAVE (CREATE/UPDATE) ---
saveBtn.addEventListener("click", () => {
  if (!/^\d{4}-\d{2}-\d{2}T\d{2}:\d{2}$/.test(datetimeEl.value)) {
    return alert("Tarih formatı YYYY-MM-DDThh:mm olmalı");
  }
  const data = {
    id: currentEvent ? currentEvent.id : Date.now(),
    artist:   artistEl.value.trim(),
    uni:      uniSelect.value,
    location: locationEl.value.trim(),
    datetime: datetimeEl.value
  };
  if (!data.artist || !data.uni || !data.location) {
    return alert("Tüm alanları doldurun.");
  }
  if (currentEvent) {
    events = events.map(e => e.id === data.id ? data : e);
  } else {
    events.push(data);
  }
  resetForm();
  renderList();
});

// --- EDIT ---
editBtn.addEventListener("click", () => {
  if (!currentEvent) return alert("Önce bir etkinlik seçin.");
  setDisabled(false);
  saveBtn.disabled = false;
});

// --- DELETE ---
deleteBtn.addEventListener("click", () => modal.classList.remove("hidden"));
yesBtn.addEventListener("click", () => {
  events = events.filter(e => e.id !== currentEvent.id);
  resetForm();
  renderList();
  modal.classList.add("hidden");
});
noBtn.addEventListener("click", () => modal.classList.add("hidden"));

// --- RESET FORM ---
function resetForm() {
  document.getElementById("concertForm").reset();
  currentEvent = null;
  setDisabled(false);
  saveBtn.disabled   = false;
  editBtn.disabled   = true;
  deleteBtn.disabled = true;
  listEl.querySelectorAll(".event-item").forEach(n => n.classList.remove("active"));
}

// --- ANNOUNCEMENT ---
document.getElementById("addAnnouncement").addEventListener("click", () => {
  const txt = document.getElementById("announcementText");
  const text = txt.value.trim();
  if (!text) return;
  const card = document.createElement("div");
  card.className = "announcement-card";
  card.innerHTML = `<p>${text}</p><button class="del-ann">×</button>`;
  card.querySelector(".del-ann").addEventListener("click", () => card.remove());
  document.getElementById("announcementList").appendChild(card);
  txt.value = "";
});

// --- PASSWORD SHOW/HIDE & VALIDATION ---
document.querySelectorAll(".toggle-password").forEach(icon => {
  icon.addEventListener("click", () => {
    const tgt = document.getElementById(icon.dataset.target);
    const isPwd = tgt.type === "password";
    tgt.type = isPwd ? "text" : "password";
    icon.textContent = isPwd ? "👁‍🗨" : "👁️";
  });
});

document.getElementById("saveAccount").addEventListener("click", () => {
  const p1 = document.getElementById("newPassword").value;
  const p2 = document.getElementById("confirmPassword").value;
  const msg = document.getElementById("accountMessage");
  msg.textContent = "";
  const regex = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[\W_]).{8,}$/;
  if (!p1 || !p2) { msg.textContent = "Lütfen tüm alanları doldurun."; return; }
  if (p1 !== p2)  { msg.textContent = "Şifreler eşleşmiyor."; return; }
  if (!regex.test(p1)) {
    msg.textContent = "Şifre en az 8 karakter, bir büyük harf, bir küçük harf, bir sembol içermeli.";
    return;
  }
  alert("Şifre güncellendi! (backend)");
});
