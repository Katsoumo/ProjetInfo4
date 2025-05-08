<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();

// Debug
file_put_contents('debug_connexion.log', "Début connexion.php\n", FILE_APPEND);

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['utilisateur'])) {
    header("Location: profil.php");
    exit();
}

// Initialisation des variables
$erreur = '';
$email = '';

// Traitement du formulaire
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = isset($_POST['email']) ? trim(strtolower($_POST['email'])) : '';
    $mdp_entre = isset($_POST['password']) ? $_POST['password'] : '';

    file_put_contents('debug_connexion.log', "Tentative de connexion avec email: $email\n", FILE_APPEND);

    // Validation des champs
    if (empty($email) || empty($mdp_entre)) {
        $erreur = "Tous les champs sont obligatoires.";
    } else {
        $fichier_json = __DIR__ . '/data/utilisateurs.json';

        if (file_exists($fichier_json)) {
            $contenu = file_get_contents($fichier_json);
            $donnees = json_decode($contenu, true);

            if ($donnees && isset($donnees['utilisateur'])) {
                $utilisateur_trouve = null;

                foreach ($donnees['utilisateur'] as $utilisateur) {
                    if (strtolower($utilisateur['e-mail']) === strtolower($email)) {
                        $utilisateur_trouve = $utilisateur;
                        break;
                    }
                }

                if ($utilisateur_trouve) {
                    if (password_verify($mdp_entre, $utilisateur_trouve['motdepasse'])) {
                        $_SESSION['utilisateur'] = [
                            'nom' => $utilisateur_trouve['nom'],
                            'prenom' => $utilisateur_trouve['prenom'],
                            'email' => $utilisateur_trouve['e-mail']
                        ];

                        file_put_contents('debug_connexion.log', "Connexion réussie pour $email\n", FILE_APPEND);
                        header("Location: profil.php");
                        exit();
                    } else {
                        $erreur = "Mot de passe incorrect.";
                    }
                } else {
                    $erreur = "Email non trouvé.";
                }
            } else {
                $erreur = "Format du fichier utilisateurs incorrect.";
            }
        } else {
            $erreur = "Fichier utilisateurs introuvable.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Connexion</title>
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
            <p>R&eacute;servation de safaris en Afrique et s&eacute;jours en pleine nature</p>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="presentation.html">Pr&eacute;sentation</a></li>
                <li><a href="rechercher.html">Rechercher un voyage</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="profil.php">Mon Profil</a></li>
            </ul>
        </nav>
    </header>

    <!-- Section Connexion -->
    <section class="form-section">
        <h2>Connexion</h2>

        <?php if (!empty($erreur)): ?>
            <div class="error-message"><?= htmlspecialchars($erreur) ?></div>
        <?php endif; ?>

        <?php if (isset($_SESSION['message'])): ?>
            <div class="success-message"><?= htmlspecialchars($_SESSION['message']) ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <form action="connexion.php" method="POST" class="connexion-form">
            <!-- Champ Email -->
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required value="<?= htmlspecialchars($email) ?>">
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
        <p class="form-link">Pas encore inscrit ? <a href="inscription.php">Inscrivez-vous ici</a>.</p>
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
