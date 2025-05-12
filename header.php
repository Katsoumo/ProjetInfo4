<?php
session_set_cookie_params([
    'httponly' => true,
    'secure'   => isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on'
]);

session_start();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Wild Safari</title>
  <link rel="stylesheet" href="styles.css">
  <script src="js/theme-switcher.js" defer></script>
</head>
<body class="<?= isset($_SESSION['utilisateur']) ? 'logged-in' : '' ?>">
  <header class="site-header">
    <div class="logo">
      <a href="index.php">
        <img src="images/logo.png" alt="Wild Safari Logo" class="logo-image">
      </a>
      <p>Réservation de safaris en Afrique et séjours en pleine nature</p>
    </div>
    <nav class="main-nav">
      <ul>
        <li><a href="index.php">Accueil</a></li>
        <li><a href="presentation.php">Présentation</a></li>
        <li><a href="rechercher.php">Rechercher un voyage</a></li>

        <?php if(isset($_SESSION['utilisateur'])): ?>
          <li><a href="profil.php">Mon Profil</a></li>
          <li>
            <a href="panier.php">
              Mon Panier (<?= count($_SESSION['cart'] ?? []) ?>)
            </a>
          </li>
          <li><a href="logout.php">Déconnexion</a></li>
        <?php else: ?>
          <li><a href="inscription.php">Inscription</a></li>
          <li><a href="connexion.php">Connexion</a></li>
        <?php endif; ?>
      </ul>
    </nav>
  </header>
