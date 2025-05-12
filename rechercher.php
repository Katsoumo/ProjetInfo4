<?php
include 'header.php';

$trips = json_decode(file_get_contents(__DIR__ . '/data/trips.json'),true)['trips'] ?? [];

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Rechercher un voyage</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/theme-switcher.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
</head>

<body>

    <!-- Section Recherche de voyages -->
    <section class="search-section">
        <h2>Rechercher un Safari</h2>
        <form action="panier.php" method="POST" class="search-form">
            <!-- Champ Destination -->
            <div class="form-group">
                <label for="destination">Destination :</label>
                <select id="destination" name="destination" required>
                    <option value="">-- Sélectionnez un pays --</option>
                    <option value="kenya">Kenya</option>
                    <option value="tanzanie">Tanzanie</option>
                    <option value="afrique-du-sud">Afrique du Sud</option>
                    <option value="botswana">Botswana</option>
                </select>
            </div>

            <!-- Champ Choix du Safari -->
            <div class="form-group">
                <label for="choix-du-safari">Choix du Safari :</label>
                <select id="choix-du-safari" name="choix-du-safari" required>
                    <option value="">-- Sélectionnez un safari --</option>
                    <optgroup label="Kenya">
                        <option value="masai-mara">Masai Mara</option>
                        <option value="amboseli">Amboseli</option>
                        <option value="tsavo-est-ouest">Tsavo Est & Ouest</option>
                        <option value="samburu">Samburu</option>
                    </optgroup>
                    <optgroup label="Tanzanie">
                        <option value="serengeti">Serengeti</option>
                        <option value="ngorongoro">Ngorongoro</option>
                        <option value="tarangire">Tarangire</option>
                        <option value="reserve-de-selous">Réserve de Selous</option>
                    </optgroup>
                    <optgroup label="Afrique du Sud">
                        <option value="kruger-national-park">Kruger National Park</option>
                        <option value="sabi-sand-game-reserve">Sabi Sand Game Reserve</option>
                        <option value="madikwe-game-reserve">Madikwe Game Reserve</option>
                        <option value="addo-elephant-national-park">Addo Elephant National Park</option>
                    </optgroup>
                    <optgroup label="Botswana">
                        <option value="okavango-delta">Okavango Delta</option>
                        <option value="chobe-national-park">Chobe National Park</option>
                        <option value="moremi-game-reserve">Moremi Game Reserve</option>
                        <option value="central-kalahari-game-reserve">Central Kalahari Game Reserve</option>
                    </optgroup>
                </select>
            </div>

            <!-- Champ Type de Safari -->
            <div class="form-group">
                <label for="type-de-safari">Type de Safari :</label>
                <select id="type-de-safari" name="type-de-safari" required>
                    <option value="">-- Choisissez votre type de Safari --</option>
                    <option value="groupe">Groupe (inclus)</option>
                    <option value="aventure">Aventure (+50€)</option>
                    <option value="prive">Privé (+70€)</option>
                    <option value="peu-importe">Peu importe</option>
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
                    <option value="campement">Campement (inclus)</option>
                    <option value="hotel">Hôtel (inclus)</option>
                    <option value="ecolodge">Écolodge (-50€)</option>
                    <option value="lodge">Lodge (+150€)</option>
                    <option value="tented-camp">Campement de luxe (+300€)</option>
                    <option value="peu-importe">Peu importe</option>
                </select>
            </div>

            <!-- Bouton de recherche -->
            <button type="submit" class="cta-button">Ajouter à mon panier</button>

            <input type="hidden" name="prix_final" id="prix-final-input" value="500">
        </form>
        
        <div class="price-summary">
            <h3>Prix estimé : <span id="price-display">500€</span></h3>
    </section>
   </main>
     <script src="js/price-calculator.js"></script>
<?php include 'footer.php'; ?>
