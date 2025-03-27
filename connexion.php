<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Connexion</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@700&display=swap" rel="stylesheet">
</head>
<body>
    <!-- En-tête du site -->
    <header class="site-header">
        <div class="logo">
            <a href="index.html">
                <img src="images/logo.png" alt="Wild Safari Logo" class="logo-image">
            </a>
            <p>Réservation de safaris en Afrique et séjours en pleine nature</p>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.html">Accueil</a></li>
                <li><a href="presentation.html">Présentation</a></li>
                <li><a href="rechercher.html">Rechercher un voyage</a></li>
                <li><a href="inscription.html">Inscription</a></li>
                <li><a href="connexion.html">Connexion</a></li>
                <li><a href="profil.html">Mon Profil</a></li> 
            </ul>
        </nav>
    </header>

    <!-- Section Connexion -->
    <section class="form-section">
        <h2>Connexion</h2>
        <form action="#" method="POST" class="connexion-form">
            <!-- Champ Email -->
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required>
            </div>

            <!-- Champ Mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required>
            </div>

            <!-- Bouton de connexion -->
            <button type="submit" class="cta-button">Se connecter</button>
        </form>

        <!-- Lien vers la page d'inscription -->
        <p class="form-link">Pas encore inscrit ? <a href="inscription.html">Inscrivez-vous ici</a>.</p>
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
