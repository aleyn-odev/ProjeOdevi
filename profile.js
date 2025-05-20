
document.addEventListener("DOMContentLoaded", () => {
    
    document.getElementById("fullName").value = window.userData.fullName;
    document.getElementById("email").value = window.userData.email;

   
    const universityList = [
        { id: "istanbul_uni", name: "İstanbul Üniversitesi" },
        { id: "boğaziçi_uni", name: "Boğaziçi Üniversitesi" },
        { id: "hacettepe_uni", name: "Hacettepe Üniversitesi" },
        { id: "ankara_uni", name: "Ankara Üniversitesi" },
    ];

    const universitySelect = document.getElementById("university");

    
    if (universitySelect.options.length <= 1) {
        universityList.forEach(uni => {
            const option = document.createElement("option");
            option.value = uni.id;
            option.textContent = uni.name;
            universitySelect.appendChild(option);
        });
    }

    // University save button
    document.getElementById("saveUniversityBtn").addEventListener("click", () => {
        const selectedUni = universitySelect.value;
        if (!selectedUni) {
            alert("Lütfen bir üniversite seçin.");
            return;
        }

        const selectedUniName = universityList.find(u => u.id === selectedUni)?.name || selectedUni;
        alert(`Üniversiteniz "${selectedUniName}" olarak kaydedildi.`);
        
        
    });

    
    function validatePassword(password) {
        const minLength = 8;
        const hasUpper = /[A-Z]/.test(password);
        const hasLower = /[a-z]/.test(password);
        const hasSymbol = /[!@#$%^&*(),.?":{}|<>]/.test(password);
        return password.length >= minLength && hasUpper && hasLower && hasSymbol;
    }

    
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

        messageEl.textContent = "İşleniyor...";

        
        fetch("change_password.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
            },
            body: JSON.stringify({ newPassword: newPass }),
        })
        .then(res => {
            if (!res.ok) throw new Error("Sunucu hatası");
            return res.text();
        })
        .then(msg => {
            alert(msg);
            messageEl.textContent = "Şifre başarıyla değiştirildi.";
            document.getElementById("newPassword").value = "";
            document.getElementById("confirmPassword").value = "";
        })
        .catch(err => {
            messageEl.textContent = "Hata: " + err.message;
        });
    });
});
