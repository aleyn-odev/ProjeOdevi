<?php
session_start();


if (isset($_GET['logout'])) {
    session_unset();
    session_destroy();
    header("Location: index.html");
    exit();
}
if (!isset($_SESSION['user_id'])) {
    header("Location: index.html"); 
    exit();
}
?>
<!DOCTYPE html>
<html lang="tr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kontrol Paneli</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="stylesheet" href="menustyle.css">
</head>
<body>


    <nav class="site-nav">
        <button class="sidebar-toggle">
            <span class="material-symbols-rounded">menu</span>
        </button>
    </nav>
    <div class="container">
        <aside class="sidebar">

        <header class="sidebar-header">
            <button class="sidebar-toggle">
                <span class="material-symbols-rounded">chevron_left</span>
            </button>
        </header>

        <div class="sidebar-content">
        <div class="sidebar-user">
            <?php echo htmlspecialchars($_SESSION['user_name']); ?>
        </div>

       
            <form action="#" class="search-form">
                <span class="material-symbols-rounded">search</span>
                <input type="search" placeholder="Ara..." required>
            </form>

            
            <ul class="menu-list">
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="material-symbols-rounded">Home</span>
                        <span class="menu-label">Kontrol Paneli</span>
                    </a>    
                </li>
                <li class="menu-item">
                    <a href="profile.php" class="menu-link">
                        <span class="material-symbols-rounded">Person</span>
                        <span class="menu-label">Profil</span>
                    </a>    
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="material-symbols-rounded">Bookmark</span>
                        <span class="menu-label">Biletler</span>
                    </a>    
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="material-symbols-rounded">Music_Note</span>
                        <span class="menu-label">Konserler</span>
                    </a>    
                </li>
                <li class="menu-item">
                    <a href="#" class="menu-link">
                        <span class="material-symbols-rounded">Settings</span>
                        <span class="menu-label">Ayarlar</span>
                    </a>    
                </li>
                <li class="menu-item">
                    <a href="?logout=true" class="menu-link">
                        <span class="material-symbols-rounded">Logout</span>
                        <span class="menu-label">Çıkış Yap</span>
                    </a>    
                </li>
            </ul>
        </div>
        
        <div class="sidebar-footer">
            <button class="theme-toggle">
                <div class="theme-label">
                    <span class="theme-icon material-symbols-rounded">dark_mode</span>
                    <span class="theme-text">Karanlık Mod</span>
                </div>
                <div class="theme-toggle-track">
                    <div class="theme-toggle-indicator"></div>
                </div>
            </button>
        </div>
        </aside>
    </div>
    <script src="menu.js"></script>
</body>
</html>
