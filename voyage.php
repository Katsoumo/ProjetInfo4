<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();

if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

$id = $_GET['id'] ?? null;
$fichier_voyages = __DIR__ . '/data/trips.json';

if (!file_exists($fichier_voyages) || !$id) {
    die("Voyage non trouvé.");
}

$voyages = json_decode(file_get_contents($fichier_voyages), true);
$voyage = null;

foreach ($voyages['trips'] as $v) {
    if ($v['id'] == $id) {
        $voyage = $v;
        break;
    }
}

if (!$voyage) {
    die("Voyage non trouvé.");
}

// Traitement du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $options_choisies = $_POST['options'] ?? [];

    // Sauvegarder dans le panier
    $panier = [
        'id' => $voyage['id'],
        'nom' => $voyage['name'],
        'prix' => $voyage['price'],
        'etapes' => []
    ];

    foreach ($voyage['etapes'] as $index => $etape) {
        $panier['etapes'][] = [
            'lieu' => $etape['titre'] ?? $etape['lieu'] ?? '',
            'options' => $options_choisies[$index] ?? []
        ];
    }

    file_put_contents(__DIR__ . '/data/panier.json', json_encode($panier, JSON_PRETTY_PRINT));
    header("Location: recapitulatif.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= htmlspecialchars($voyage['name'] ?? '') ?> - Wild Safari</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 150px;
            font-family: 'Roboto', sans-serif;
        }
        .voyage-container {
            max-width: 800px;
            margin: 0 auto 50px;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .etape {
            margin-bottom: 30px;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 5px;
        }
        .option-group {
            margin: 15px 0;
        }
        .btn-valider {
            background: #e67e22;
            color: white;
            padding: 12px 25px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <header class="site-header">
        <div class="logo">
            <a href="index.php">
                <img src="images/logo.png" alt="Wild Safari Logo" class="logo-image">
            </a>
            <p>R&eacute;servation de safaris en Afrique et s&eacute;jours en pleine nature</p>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="profil.php">Mon Profil</a></li>
            </ul>
        </nav>
    </header>

    <main class="voyage-container">
        <h2 style="color: #e67e22;"><?= htmlspecialchars($voyage['name'] ?? '') ?></h2>
        <p>Durée : <?= htmlspecialchars($voyage['duration'] ?? '') ?></p>

        <form method="POST">
            <?php foreach ($voyage['etapes'] as $index => $etape): ?>
            <div class="etape">
                <h3><?= htmlspecialchars($etape['titre'] ?? 'Étape '.($index+1)) ?></h3>
                <p>Lieu : <?= htmlspecialchars($etape['lieu'] ?? $etape['position_geographique'] ?? '') ?></p>

                <?php foreach ($etape['options'] as $type => $options): ?>
                <div class="option-group">
                    <h4><?= htmlspecialchars($type) ?> :</h4>
                    <?php foreach ($options as $key => $option): ?>
                    <div>
                        <input type="radio"
                               id="opt_<?= $index ?>_<?= $type ?>_<?= $key ?>"
                               name="options[<?= $index ?>][<?= $type ?>]"
                               value="<?= htmlspecialchars($option) ?>"
                               <?= $key === 0 ? 'checked' : '' ?>>
                        <label for="opt_<?= $index ?>_<?= $type ?>_<?= $key ?>">
                            <?= htmlspecialchars($option) ?>
                        </label>
                    </div>
                    <?php endforeach; ?>
                </div>
                <?php endforeach; ?>
            </div>
            <?php endforeach; ?>

            <button type="submit" class="btn-valider">Valider les options</button>
        </form>
    </main>

    <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contacts</h3>
                <p>95000 Cergy</p>
                <p>Tel: 07 60 64 38 10</p>
                <p>Informations g&eacute;n&eacute;rales: ilyashaidar6@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous sur Instagram !</h3>
                <p>99ilyas66</p>
                <p>myriiam_br</p>
                <p>abdrzr_95</p>
            </div>
        </div>
        <p>&copy; 2025 Wild Safari. Tous droits r&eacute;serv&eacute;s.</p>
    </footer>
</body>
</html>
