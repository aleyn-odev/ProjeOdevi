<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: index.html");
    exit();
}


$userData = [
    'fullName' => $_SESSION['user_name'] ?? '',
    'email' => $_SESSION['user_email'] ?? '',
    'university' => $_SESSION['university'] ?? 'istanbul_uni' // Default value
];
?>

<!DOCTYPE html>
<html lang="tr">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Profil - <?php echo htmlspecialchars($userData['fullName']); ?></title>
  <link rel="stylesheet" href="profile.css" />
</head>
<body>
  <div class="profile-container">
    <h2>Profil Bilgilerim</h2>
    <form id="profileForm">
      <div class="form-group">
        <label for="fullName">Ad Soyad</label>
        <input type="text" id="fullName" value="<?php echo htmlspecialchars($userData['fullName']); ?>" disabled />
      </div>
      <div class="form-group">
        <label for="email">E-posta</label>
        <input type="email" id="email" value="<?php echo htmlspecialchars($userData['email']); ?>" disabled />
      </div>
      <div class="form-group">
        <label for="university">Üniversite</label>
        <select id="university">
          <option value="">Üniversite seçin</option>
          <?php
          $universities = [
              'istanbul_uni' => 'İstanbul Üniversitesi',
              'boğaziçi_uni' => 'Boğaziçi Üniversitesi', 
              'hacettepe_uni' => 'Hacettepe Üniversitesi',
              'ankara_uni' => 'Ankara Üniversitesi'
          ];
          
          foreach ($universities as $id => $name) {
              $selected = ($id == $userData['university']) ? 'selected' : '';
              echo "<option value='$id' $selected>$name</option>";
          }
          ?>
        </select>
        <button type="button" id="saveUniversityBtn">Kaydet</button>
      </div>
    </form>

    <hr />

    <h3>Şifre Yenile</h3>
    <form id="passwordForm">
      <div class="form-group">
        <label for="newPassword">Yeni Şifre</label>
        <input type="password" id="newPassword" placeholder="En az 8 karakter" />
      </div>
      <div class="form-group">
        <label for="confirmPassword">Yeni Şifre (Tekrar)</label>
        <input type="password" id="confirmPassword" placeholder="Şifreyi tekrar girin" />
      </div>
      <button type="button" id="savePasswordBtn">Kaydet</button>
      <p id="passwordMessage" class="message"></p>
    </form>
  </div>

  <script>
    window.userData = <?php echo json_encode($userData); ?>;
    window.universities = <?php echo json_encode($universities); ?>;
  </script>
  

  <script src="profile.js"></script>
</body>
</html>