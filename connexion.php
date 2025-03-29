<?php
session_start();

// Étape 1 : Récupérer les données envoyées par l'utilisateur
$email = isset($_POST['email']) ? trim(strtolower($_POST['email'])) : '';
$mdp_entre = isset($_POST['password']) ? $_POST['password'] : '';

// Vérifier que les champs ne sont pas vides
if (empty($email) || empty($mdp_entre)) {
    $erreur = "Tous les champs sont obligatoires.";
} else {
    // Étape 2 : Lire le fichier JSON contenant les utilisateurs
    $fichier_json = './data/utilisateurs.json';

    if (file_exists($fichier_json)) {
        $donnees = json_decode(file_get_contents($fichier_json), true);

        if ($donnees && isset($donnees['utilisateurs'])) {
            // Étape 3 : Chercher l'utilisateur correspondant à l'email
            $utilisateur_trouve = null;

            foreach ($donnees['utilisateurs'] as $utilisateur) {
                if (trim(strtolower($utilisateur['e-mail'])) === $email) {
                    $utilisateur_trouve = $utilisateur;
                    break;
                }
            }

            if ($utilisateur_trouve) {
                // Vérifier le mot de passe
                if (password_verify($mdp_entre, $utilisateur_trouve['motdepasse'])) {
                    // Connexion réussie, enregistrer l'utilisateur en session
                    $_SESSION['utilisateur'] = [
                        'nom' => $utilisateur_trouve['nom'],
                        'prenom' => $utilisateur_trouve['prenom'],
                        'email' => $utilisateur_trouve['e-mail']
                    ];

                    // Rediriger vers le profil
                    header("Location: profil.php");
                    exit;
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

// Si une erreur est présente, on l'affiche dans la page HTML
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Connexion</title>
    <link rel="stylesheet" href="styles.css">
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
                <li><a href="presentation.html">Présentation</a></li>
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
        <?php if(isset($erreur)): ?>
        <div style="color:red; padding:10px; margin:10px; border:1px solid red">
            <?php echo htmlspecialchars($erreur); ?>
        </div>
        <?php endif; ?>
        <form action="connexion.php" method="POST" class="connexion-form">
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