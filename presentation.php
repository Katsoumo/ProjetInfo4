<?php
session_start();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Présentation</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/theme-switcher.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- En-tête du site -->
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
                <li><a href="rechercher.php">Rechercher un Safari</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>

<!-- Conteneur vide pour décaler la section de présentation -->
<div class="spacer" style="height: 150px;"></div>
<!-- Section Présentation -->
<section class="presentation">
    <h2>Bienvenue chez Wild Safari</h2>
    <p>
        Wild Safari vous propose des expériences uniques en pleine nature...
    </p>


    <!-- Section Présentation du site -->
    <section class="presentation-section">
        <h2>Présentation de Wild Safari</h2>
        <p>
            Bienvenue sur <strong>Wild Safari</strong>, votre agence de voyages spécialisée dans les safaris en Afrique. Notre mission est de vous offrir des expériences uniques et inoubliables au cœur de la nature sauvage. Que vous soyez passionné de faune sauvage ou simplement à la recherche d'une escapade hors du commun, nos circuits sont conçus pour vous faire découvrir des paysages à couper le souffle et des rencontres extraordinaires avec les animaux.
        </p>
        <p>
            Nous proposons des séjours déjà configurés, mais vous avez la possibilité de personnaliser certaines options comme l'hébergement, la restauration, les activités et les transports. Explorez nos offres et réservez dès maintenant votre aventure !
        </p>

    </section>

    <!-- Section Recherche rapide -->
    <section class="quick-search">
        <h2>Rechercher un voyage</h2>
        <form action="rechercher.php" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Rechercher un voyage..." required>
            <button type="submit">🔍</button>
        </form>
    </section>

    <!-- Pied de page -->
    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contacts</h3>
                <p>95000 Cergy</p>
                <p>Tel: 07 60 64 38 10</p>
                <p>Informations générales: ilyashaidar6@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous sur Instagram !</h3>
                <p>99ilyas66</p>
                <p>myriiam_br</p>
                <p>abdrzr_95</p>
            </div>
        </div>
        <p>&copy; 2025 Wild Safari. Tous droits réservés.</p>
    </footer>
</body>
</html>
