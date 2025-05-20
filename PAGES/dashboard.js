// Backend'den alınacak örnek veriler (yerine gerçek API ile değiştirilecek)
const studentData = {
  name: "Aleyna Yılmaz",
  university: "Boğaziçi Üniversitesi",
  ticketCount: 3
};

const upcomingEvent = {
  title: "Yaz Şenliği 2025",
  date: "10 Haziran 2025",
  image: "concert1.jpg"
};

const announcements = [
  "Bahar konseri 25 Mayıs’ta!",
  "Yeni etkinlikler eklendi.",
  "Biletlerde %10 indirim başladı."
];

// Sayfa yüklendiğinde verileri yerleştir
document.addEventListener("DOMContentLoaded", () => {
  document.getElementById("student-name").textContent = studentData.name;
  document.getElementById("university-name").textContent = studentData.university;
  document.getElementById("ticket-count").textContent = studentData.ticketCount;

  document.getElementById("event-title").textContent = upcomingEvent.title;
  document.getElementById("event-date").textContent = upcomingEvent.date;
  document.getElementById("event-image").src = upcomingEvent.image;

  const list = document.getElementById("announcement-list");
  list.innerHTML = ""; // varsayılan mesajı temizle
  announcements.forEach(msg => {
    const li = document.createElement("li");
    li.textContent = msg;
    list.appendChild(li);
  });
});
