<?php
session_start();

if (isset($_POST['language'])) {
    $_SESSION['lang'] = $_POST['language'];
    header("Location: settings.php");
    exit();
}

include 'lang.php';
?>


<!DOCTYPE html>
<html lang="<?= htmlspecialchars($lang) ?>">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title><?= htmlspecialchars($translations['settings']) ?></title>
  <link rel="stylesheet" href="settings.css" />
</head>
<body>
  <div class="container">
    <main class="main-content">
      <h1><?= htmlspecialchars($translations['settings']) ?></h1>

      <section class="card notification-settings">
        <h2><?= htmlspecialchars($translations['university_notification']) ?></h2>
        <p><?= htmlspecialchars($translations['notify_text']) ?></p>
        <label class="switch">
          <input type="checkbox" id="notifToggle" />
          <span class="slider round"></span>
        </label>
      </section>

      <section class="card language-settings">
        <h2><?= htmlspecialchars($translations['language_selection']) ?></h2>
        <form id="languageForm" method="POST" action="settings.php">
          <select name="language" id="languageSelect" onchange="this.form.submit()">
            <option value="tr" <?= $lang === 'tr' ? 'selected' : '' ?>>Türkçe</option>
            <option value="en" <?= $lang === 'en' ? 'selected' : '' ?>>English</option>
          </select>
        </form>
      </section>
    </main>
  </div>

  <script src="settings.js"></script>
</body>
</html>
