<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();

if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

// Charger les données du voyage
$fichier_panier = __DIR__ . '/data/panier.json';
if (!file_exists($fichier_panier)) {
    die("Aucun voyage sélectionné.");
}

$voyage = json_decode(file_get_contents($fichier_panier), true);
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Récapitulatif - Wild Safari</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            padding-top: 150px;
            font-family: 'Roboto', sans-serif;
        }
        .recap-container {
            max-width: 800px;
            margin: 0 auto 50px;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        .etape {
            margin-bottom: 25px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .option {
            margin-left: 20px;
            color: #555;
        }
        .total {
            font-size: 1.2em;
            font-weight: bold;
            text-align: right;
            margin-top: 20px;
            color: #e67e22;
        }
        .actions {
            display: flex;
            justify-content: space-between;
            margin-top: 30px;
        }
        .btn {
            padding: 12px 25px;
            border-radius: 4px;
            cursor: pointer;
        }
        .btn-modifier {
            background: #f8f9fa;
            border: 1px solid #ddd;
        }
        .btn-payer {
            background: #e67e22;
            color: white;
            border: none;
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

    <main class="recap-container">
        <h2 style="color: #e67e22;">Récapitulatif de votre voyage</h2>
        <h3><?= htmlspecialchars($voyage['nom'] ?? 'Nom du voyage') ?></h3>

        <?php foreach ($voyage['etapes'] as $etape): ?>
        <div class="etape">
            <h4><?= htmlspecialchars($etape['lieu'] ?? '') ?></h4>
            <?php foreach ($etape['options'] as $type => $choix): ?>
                <div class="option">
                    <strong><?= htmlspecialchars($type) ?> :</strong>
                    <?= htmlspecialchars(is_array($choix) ? implode(', ', $choix) : $choix) ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endforeach; ?>

        <div class="total">
            Total : <?= htmlspecialchars($voyage['prix'] ?? '0') ?> €
        </div>

        <div class="actions">
            <a href="voyage.php?id=<?= $voyage['id'] ?? '' ?>" class="btn btn-modifier">Modifier les options</a>
            <a href="paiement.php?montant=<?= $voyage['prix'] ?? '' ?>" class="btn btn-payer">Procéder au paiement</a>
        </div>
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
