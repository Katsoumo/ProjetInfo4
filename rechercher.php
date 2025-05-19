<?php
session_start();

if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

// Liste complète des voyages (16 voyages)
$allTrips = [
    // Kenya
    [
        'id' => 1,
        'name' => 'Safari Masai Mara',
        'price' => 1200,
        'duration' => '5 jours',
        'destination' => 'Kenya',
        'safari' => 'Masai-Mara',
        'type' => 'Groupe',
        'logement' => 'Campement',
        'date' => '2024-07-15',
        'repas' => 'Complet',
        'description' => 'Découvrez les Big Five dans la réserve emblématique du Masai Mara.',
        'image' => 'masai-mara.jpg'
    ],
    [
        'id' => 2,
        'name' => 'Safari Amboseli',
        'price' => 1100,
        'duration' => '4 jours',
        'destination' => 'Kenya',
        'safari' => 'Amboseli',
        'type' => 'Aventure',
        'logement' => 'Hôtel',
        'date' => '2024-08-10',
        'repas' => 'Petit-déjeuner',
        'description' => 'Vue imprenable sur le Kilimandjaro avec les éléphants.',
        'image' => 'amboseli.jpg'
    ],
    [
        'id' => 3,
        'name' => 'Safari Tsavo',
        'price' => 1300,
        'duration' => '6 jours',
        'destination' => 'Kenya',
        'safari' => 'Tsavo-Est-Ouest',
        'type' => 'Privée',
        'logement' => 'Lodge',
        'date' => '2024-09-05',
        'repas' => 'Demi-pension',
        'description' => 'Exploration des parcs Tsavo Est et Ouest, les plus vastes du Kenya.',
        'image' => 'tsavo.jpg'
    ],
    [
        'id' => 4,
        'name' => 'Safari Samburu',
        'price' => 1400,
        'duration' => '5 jours',
        'destination' => 'Kenya',
        'safari' => 'Samburu',
        'type' => 'Groupe',
        'logement' => 'Tented-Camp',
        'date' => '2024-10-12',
        'repas' => 'Complet',
        'description' => 'Découverte des espèces uniques de la réserve de Samburu.',
        'image' => 'samburu.jpg'
    ],
    // Tanzanie
    [
        'id' => 5,
        'name' => 'Safari Serengeti',
        'price' => 1800,
        'duration' => '7 jours',
        'destination' => 'Tanzanie',
        'safari' => 'Serengeti',
        'type' => 'Aventure',
        'logement' => 'Campement',
        'date' => '2024-07-20',
        'repas' => 'Complet',
        'description' => 'La grande migration dans le parc du Serengeti.',
        'image' => 'serengeti.jpg'
    ],
    [
        'id' => 6,
        'name' => 'Safari Ngorongoro',
        'price' => 1600,
        'duration' => '5 jours',
        'destination' => 'Tanzanie',
        'safari' => 'Ngorongoro',
        'type' => 'Groupe',
        'logement' => 'Hôtel',
        'date' => '2024-08-15',
        'repas' => 'Petit-déjeuner',
        'description' => 'Exploration de la célèbre caldeira du Ngorongoro.',
        'image' => 'ngorongoro.jpg'
    ],
    [
        'id' => 7,
        'name' => 'Safari Tarangire',
        'price' => 1500,
        'duration' => '4 jours',
        'destination' => 'Tanzanie',
        'safari' => 'Tarangire',
        'type' => 'Privée',
        'logement' => 'Lodge',
        'date' => '2024-09-10',
        'repas' => 'Demi-pension',
        'description' => 'Parc connu pour ses baobabs et sa grande population d\'éléphants.',
        'image' => 'tarangire.jpg'
    ],
    [
        'id' => 8,
        'name' => 'Safari Selous',
        'price' => 1700,
        'duration' => '6 jours',
        'destination' => 'Tanzanie',
        'safari' => 'Reserve-de-Selous',
        'type' => 'Aventure',
        'logement' => 'Tented-Camp',
        'date' => '2024-10-20',
        'repas' => 'Complet',
        'description' => 'La plus grande réserve de faune sauvage d\'Afrique.',
        'image' => 'selous.jpg'
    ],
    // Afrique du Sud
    [
        'id' => 9,
        'name' => 'Safari Kruger',
        'price' => 2000,
        'duration' => '7 jours',
        'destination' => 'Afrique-du-Sud',
        'safari' => 'Kruger-National-Park',
        'type' => 'Groupe',
        'logement' => 'Campement',
        'date' => '2024-07-25',
        'repas' => 'Complet',
        'description' => 'Le parc national le plus célèbre d\'Afrique du Sud.',
        'image' => 'kruger.jpg'
    ],
    [
        'id' => 10,
        'name' => 'Safari Sabi Sand',
        'price' => 2500,
        'duration' => '5 jours',
        'destination' => 'Afrique-du-Sud',
        'safari' => 'Sabi-Sand-Game-Reserve',
        'type' => 'Privée',
        'logement' => 'Lodge',
        'date' => '2024-08-20',
        'repas' => 'Complet',
        'description' => 'Expérience exclusive dans une réserve privée adjacente au Kruger.',
        'image' => 'sabi-sand.jpg'
    ],
    [
        'id' => 11,
        'name' => 'Safari Madikwe',
        'price' => 1800,
        'duration' => '4 jours',
        'destination' => 'Afrique-du-Sud',
        'safari' => 'Madikwe-Game-Reserve',
        'type' => 'Aventure',
        'logement' => 'Tented-Camp',
        'date' => '2024-09-15',
        'repas' => 'Demi-pension',
        'description' => 'Réserve moins fréquentée avec une excellente observation des animaux.',
        'image' => 'madikwe.jpg'
    ],
    [
        'id' => 12,
        'name' => 'Safari Addo Elephant',
        'price' => 1600,
        'duration' => '3 jours',
        'destination' => 'Afrique-du-Sud',
        'safari' => 'Addo-Elephant-National-Park',
        'type' => 'Groupe',
        'logement' => 'Hôtel',
        'date' => '2024-10-25',
        'repas' => 'Petit-déjeuner',
        'description' => 'Parc spécialisé dans la conservation des éléphants.',
        'image' => 'addo.jpg'
    ],
    // Botswana
    [
        'id' => 13,
        'name' => 'Safari Okavango Delta',
        'price' => 2200,
        'duration' => '8 jours',
        'destination' => 'Botswana',
        'safari' => 'Okavango-Delta',
        'type' => 'Privée',
        'logement' => 'Ecolodge',
        'date' => '2024-07-30',
        'repas' => 'Complet',
        'description' => 'Expérience unique dans le delta de l\'Okavango, classé à l\'UNESCO.',
        'image' => 'okavango.jpg'
    ],
    [
        'id' => 14,
        'name' => 'Safari Chobe',
        'price' => 1900,
        'duration' => '5 jours',
        'destination' => 'Botswana',
        'safari' => 'Chobe-National-Park',
        'type' => 'Groupe',
        'logement' => 'Campement',
        'date' => '2024-08-25',
        'repas' => 'Complet',
        'description' => 'Connu pour sa grande population d\'éléphants et croisières sur la rivière Chobe.',
        'image' => 'chobe.jpg'
    ],
    [
        'id' => 15,
        'name' => 'Safari Moremi',
        'price' => 2100,
        'duration' => '6 jours',
        'destination' => 'Botswana',
        'safari' => 'Moremi-Game-Reserve',
        'type' => 'Aventure',
        'logement' => 'Tented-Camp',
        'date' => '2024-09-20',
        'repas' => 'Complet',
        'description' => 'Combinaison unique de zones inondées et de terres arides.',
        'image' => 'moremi.jpg'
    ],
    [
        'id' => 16,
        'name' => 'Safari Kalahari',
        'price' => 1700,
        'duration' => '7 jours',
        'destination' => 'Botswana',
        'safari' => 'Central-Kalahari-Game-Reserve',
        'type' => 'Privée',
        'logement' => 'Lodge',
        'date' => '2024-10-30',
        'repas' => 'Demi-pension',
        'description' => 'Découverte du désert du Kalahari et de sa faune adaptée.',
        'image' => 'kalahari.jpg'
    ]
];


// Filtrer selon la destination sélectionnée
$selectedDestination = $_POST['destination'] ?? '';
$filteredTrips = $allTrips;

if (!empty($selectedDestination)) {
    $filteredTrips = array_filter($allTrips, function($trip) use ($selectedDestination) {
        return $trip['destination'] === $selectedDestination;
    });
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Rechercher un Safari</title>
    <script src="js/theme-switcher.js" defer></script>
    <script src="js/trip-sorter.js" defer></script>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>










<script>
document.addEventListener('DOMContentLoaded', function() {
    const sortSelect = document.getElementById('sort-by');
    const tripsContainer = document.getElementById('trips-container');
    
    sortSelect.addEventListener('change', function() {
        const trips = Array.from(tripsContainer.querySelectorAll('.trip-card'));
        const sortValue = this.value;
        
        trips.sort((a, b) => {
            const priceA = parseFloat(a.dataset.price);
            const priceB = parseFloat(b.dataset.price);
            const durationA = parseInt(a.querySelector('.trip-meta span:first-child').textContent);
            const durationB = parseInt(b.querySelector('.trip-meta span:first-child').textContent);
            
            switch(sortValue) {
                case 'price-asc':
                    return priceA - priceB;
                case 'price-desc':
                    return priceB - priceA;
                case 'duration-asc':
                    return durationA - durationB;
                case 'duration-desc':
                    return durationB - durationA;
                default:
                    return 0;
            }
        });
        
        // Réorganiser les voyages dans le conteneur
        trips.forEach(trip => tripsContainer.appendChild(trip));
    });

});
</script>















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
        <form method="POST" class="search-form" id="search-form">
            <!-- Champ Destination -->
            <div class="form-group">
                <label for="destination">Destination :</label>
                <select id="destination" name="destination">
                    <option value="">-- Toutes destinations --</option>
                    <option value="Kenya">Kenya</option>
                    <option value="Tanzanie">Tanzanie</option>
                    <option value="Afrique-du-Sud">Afrique du Sud</option>
                    <option value="Botswana">Botswana</option>
                </select>
            </div>

            <!-- Champ Type de Safari -->
            <div class="form-group">
                <label for="type-de-safari">Type de Safari :</label>
                <select id="type-de-safari" name="type-de-safari">
                    <option value="">-- Tous types --</option>
                    <option value="Groupe">Groupe (inclus)</option>
                    <option value="Aventure">Aventure (+50€)</option>
                    <option value="Privée">Privé (+70€)</option>
                </select>
            </div>

            <!-- Champ Date de départ -->
            <div class="form-group">
                <label for="date-depart">Date de départ :</label>
                <input type="date" id="date-depart" name="date-depart">
            </div>

            <!-- Champ Type de logement -->
            <div class="form-group">
                <label for="type-de-logement">Type de logement :</label>
                <select id="type-de-logement" name="type-de-logement">
                    <option value="">-- Tous logements --</option>
                    <option value="Campement">Campement (inclus)</option>
                    <option value="Hôtel">Hôtel (inclus)</option>
                    <option value="Ecolodge">Écolodge (-50€)</option>
                    <option value="Lodge">Lodge (+150€)</option>
                    <option value="Tented-Camp">Campement de luxe (+300€)</option>
                </select>
            </div>

            <!-- Boutons -->
            <div class="form-buttons">
                <button type="submit" class="cta-button">Rechercher</button>
                <button type="reset" class="reset-button">Réinitialiser</button>
            </div>
        </form>
    </section>

    <!-- Section Résultats de recherche -->
    <section class="results-section">
        <div class="results-header">
            <h2>Nos Safaris Disponibles (<?= count($filteredTrips) ?>)</h2>
            <div class="sort-controls">
                <label for="sort-by">Trier par :</label>
                <select id="sort-by" class="sort-select">
                    <option value="default">Par défaut</option>
                    <option value="price-asc">Prix (croissant)</option>
                    <option value="price-desc">Prix (décroissant)</option>
                    <option value="duration-asc">Durée (croissante)</option>
                    <option value="duration-desc">Durée (décroissante)</option>
                </select>
            </div>
        </div>

        <div id="trips-container" class="trips-grid">
            <?php foreach ($filteredTrips as $trip): ?>
                <div class="trip-card" 
                     data-id="<?= $trip['id'] ?>"
                     data-price="<?= $trip['price'] ?>">
                    <div class="trip-image">
                        <img src="images/<?= $trip['image'] ?>" alt="<?= htmlspecialchars($trip['name']) ?>">
                        <div class="price-tag"><?= $trip['price'] ?>€</div>
                        <div class="trip-badge"><?= $trip['type'] ?></div>
                    </div>
                    <div class="trip-details">
                        <h3><?= htmlspecialchars($trip['name']) ?></h3>
                        <div class="trip-meta">
                            <span><i class="fas fa-calendar-alt"></i> <?= htmlspecialchars($trip['duration']) ?></span>
                            <span><i class="fas fa-map-marker-alt"></i> <?= htmlspecialchars($trip['destination']) ?></span>
                        </div>
                        <div class="trip-options">
                            <span><i class="fas fa-hotel"></i> <?= htmlspecialchars($trip['logement']) ?></span>
                            <span><i class="fas fa-utensils"></i> <?= $trip['repas'] ?></span>
                        </div>
                    </div>
                    <div class="trip-actions">
                        <form action="panier.php" method="post" class="add-to-cart-form">
                            <input type="hidden" name="voyage_id" value="<?= $trip['id'] ?>">
                            <input type="hidden" name="nom_voyage" value="<?= htmlspecialchars($trip['name']) ?>">
                            <input type="hidden" name="destination" value="<?= $trip['destination'] ?>">
                            <input type="hidden" name="prix_base" value="<?= $trip['price'] ?>">
                            <input type="hidden" name="duree" value="<?= $trip['duration'] ?>">
                            <input type="hidden" name="type_safari" id="type_safari_<?= $trip['id'] ?>" value="">
                            <input type="hidden" name="type_logement" id="type_logement_<?= $trip['id'] ?>" value="">
                            <button type="submit" class="add-to-cart-button">
                                <i class="fas fa-cart-plus"></i> Ajouter au panier
                            </button>
                        </form>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
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

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const updateTripPrices = () => {
                const typeSelect = document.getElementById('type-de-safari');
                const logementSelect = document.getElementById('type-de-logement');
                
                document.querySelectorAll('.trip-card').forEach(card => {
                    const basePrice = parseFloat(card.dataset.price);
                    let totalPrice = basePrice;
                    const tripId = card.dataset.id;
                    
                    // Calcul des extras
                    if (typeSelect.value === 'Aventure') totalPrice += 50;
                    if (typeSelect.value === 'Privée') totalPrice += 70;
                    if (logementSelect.value === 'Ecolodge') totalPrice -= 50;
                    if (logementSelect.value === 'Lodge') totalPrice += 150;
                    if (logementSelect.value === 'Tented-Camp') totalPrice += 300;
                    
                    // Mise à jour du formulaire d'ajout au panier
                    document.getElementById(`type_safari_${tripId}`).value = typeSelect.value;
                    document.getElementById(`type_logement_${tripId}`).value = logementSelect.value;
                    
                    // Mise à jour de l'affichage du prix
                    const priceTag = card.querySelector('.price-tag');
                    if (priceTag) {
                        priceTag.textContent = totalPrice + '€';
                    }
                });
            };
            
            document.getElementById('type-de-safari').addEventListener('change', updateTripPrices);
            document.getElementById('type-de-logement').addEventListener('change', updateTripPrices);
            updateTripPrices();
        });
    </script>
</body>
</html>