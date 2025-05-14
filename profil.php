<?php

header('Content-Type: text/html; charset=UTF-8');

session_start();

// Vérification de la connexion
if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

$fichier_utilisateurs = __DIR__ . '/data/utilisateurs.json';
$fichier_paiement = __DIR__ . '/data/paiement.json';

// Chargement des données utilisateur
$utilisateur_actuel = null;
if (file_exists($fichier_utilisateurs)) {
    $donnees_utilisateur = json_decode(file_get_contents($fichier_utilisateurs), true) ?? [];

    // Recherche de l'utilisateur dans le tableau 'utilisateur'
    foreach (($donnees_utilisateur['utilisateur'] ?? []) as $utilisateur) {
        if (($utilisateur['e-mail'] ?? '') === $_SESSION['utilisateur']['email']) {
            $utilisateur_actuel = $utilisateur;
            break;
        }
    }
}

if (!$utilisateur_actuel) {
    die("Erreur : Impossible de charger les données du profil.");
}

// Chargement des paiements (si le fichier existe)
$paiements_utilisateur = [];
if (file_exists($fichier_paiement)) {
    $donnees_paiement = json_decode(file_get_contents($fichier_paiement), true) ?? [];
    $paiements_utilisateur = array_filter($donnees_paiement, function($paiement) {
        return ($paiement['mail_utilisateur'] ?? '') === $_SESSION['utilisateur']['email'];
    });
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Mon Profil</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/theme-switcher.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
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
                <li><a href="presentation.html">Présentation</a></li>
                <li><a href="rechercher.html">Rechercher un voyage</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="profil.php">Mon Profil</a></li>
                <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>

    <!-- Section Profil Utilisateur -->
    <section class="profile-section">
        <h2>Mon Profil</h2>

        <!-- Informations de l'utilisateur -->
        <div class="profile-info">
            <div class="info-group">
                <label>Nom : <?= htmlspecialchars($utilisateur_actuel['nom'] ?? '') ?></label>
            </div>
            <div class="info-group">
                <label>Prénom : <?= htmlspecialchars($utilisateur_actuel['prenom'] ?? '') ?></label>
            </div>
            <div class="info-group">
                <label>Email : <?= htmlspecialchars($utilisateur_actuel['e-mail'] ?? '') ?></label>
            </div>
        </div>

        <!-- Paiements -->
        <h3>Mes Paiements</h3>
        <?php if (!empty($paiements_utilisateur)): ?>
            <ul>
                <?php foreach ($paiements_utilisateur as $paiement): ?>
                    <li>
                        Montant : <?= htmlspecialchars($paiement['montant'] ?? '') ?>€ -
                        Date : <?= htmlspecialchars($paiement['date'] ?? '') ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php else: ?>
            <p>Aucun paiement enregistré</p>
        <?php endif; ?>
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
