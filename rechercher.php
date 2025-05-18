<?php
session_start();

$trips = json_decode(file_get_contents(__DIR__ . '/data/trips.json'),true)['trips'] ?? [];
if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Rechercher un Safari</title>
    <script src="js/theme-switcher.js" defer></script>
    <script src="js/price-calculator.js" defer></script>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>

<body>
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
                <li><a href="profil.php">Mon Profil</a></li> 
                <li><a href="panier.php">Mon Panier</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
    <!-- Section Recherche de voyages -->
    <section class="search-section">
        <h2>Rechercher un Safari</h2>
        <form action="panier.php" method="POST" class="search-form">
            <!-- Champ Destination -->
            <div class="form-group">
                <label for="destination">Destination :</label>
                <select id="destination" name="destination" required>
                    <option value="">-- Sélectionnez un pays --</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Tanzanie">Tanzanie</option>
                    <option value="Afrique-du-Sud">Afrique du Sud</option>
                    <option value="Botswana">Botswana</option>
                </select>
            </div>

            <!-- Champ Choix du Safari -->
            <div class="form-group">
                <label for="choix-du-safari">Choix du Safari :</label>
                <select id="choix-du-safari" name="choix-du-safari" required>
                    <option value="">-- Sélectionnez un safari --</option>
                    <optgroup label="Kenya">
                        <option value="Masai-Mara">Masai Mara</option>
                        <option value="Amboseli">Amboseli</option>
                        <option value="Tsavo-Est-Ouest">Tsavo Est & Ouest</option>
                        <option value="Samburu">Samburu</option>
                    </optgroup>
                    <optgroup label="Tanzanie">
                        <option value="Serengeti">Serengeti</option>
                        <option value="Ngorongoro">Ngorongoro</option>
                        <option value="Tarangire">Tarangire</option>
                        <option value="Reserve-de-Selous">Réserve de Selous</option>
                    </optgroup>
                    <optgroup label="Afrique du Sud">
                        <option value="Kruger-National-Park">Kruger National Park</option>
                        <option value="Sabi-Sand-Game-Reserve">Sabi Sand Game Reserve</option>
                        <option value="Madikwe-Game-Reserve">Madikwe Game Reserve</option>
                        <option value="Addo-Elephant-National-Park">Addo Elephant National Park</option>
                    </optgroup>
                    <optgroup label="Botswana">
                        <option value="Okavango-Delta">Okavango Delta</option>
                        <option value="Chobe-National-Park">Chobe National Park</option>
                        <option value="Moremi-Game-Reserve">Moremi Game Reserve</option>
                        <option value="Central-Kalahari-Game-Reserve">Central Kalahari Game Reserve</option>
                    </optgroup>
                </select>
            </div>

            <!-- Champ Type de Safari -->
            <div class="form-group">
                <label for="type-de-safari">Type de Safari :</label>
                <select id="type-de-safari" name="type-de-safari" required>
                    <option value="">-- Choisissez votre type de Safari --</option>
                    <option value="Groupe">Groupe (inclus)</option>
                    <option value="Aventure">Aventure (+50€)</option>
                    <option value="Privée">Privé (+70€)</option>
                    <option value="Peu-importe">Peu importe</option>
                </select>
            </div>

            <!-- Champ Ville de départ -->
            <div class="form-group">
                <label for="ville-depart">Ville de départ :</label>
                <input type="text" id="ville-depart" name="ville-depart" placeholder="Ex: Paris, Montréal" required>
            </div>

            <!-- Champ Date de départ -->
            <div class="form-group">
                <label for="date-depart">Date de départ :</label>
                <input type="date" id="date-depart" name="date-depart" required>
            </div>

            <!-- Champ Date de retour -->
            <div class="form-group">
                <label for="date-retour">Date de retour (facultatif) :</label>
                <input type="date" id="date-retour" name="date-retour">
            </div>

            <!-- Champ Type de logement -->
            <div class="form-group">
                <label for="type-de-logement">Type de logement :</label>
                <select id="type-de-logement" name="type-de-logement" required>
                    <option value="">-- Choisissez votre logement --</option>
                    <option value="Campement">Campement (inclus)</option>
                    <option value="Hôtel">Hôtel (inclus)</option>
                    <option value="Ecolodge">Écolodge (-50€)</option>
                    <option value="Lodge">Lodge (+150€)</option>
                    <option value="Tented-Camp">Campement de luxe (+300€)</option>
                    <option value="Peu-importe">Peu importe</option>
                </select>
            </div>

            <!-- Bouton de recherche -->
            <button type="submit" class="cta-button">Ajouter à mon panier</button>

            <input type="hidden" name="prix_final" id="prix-final-input" value="500">
        </form>
        
        <div class="price-summary">
            <h3>Prix estimé : <span id="price-display">500€</span></h3>
    </section>
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

