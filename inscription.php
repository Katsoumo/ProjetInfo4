<?php
header('Content-Type: text/html; charset=UTF-8');
session_start();
$fichier_utilisateurs = __DIR__ . '/data/utilisateurs.json';

// Debug: V rifier si le script est atteint
file_put_contents('debug.log', "Script inscription.php atteint\n", FILE_APPEND);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Formulaire soumis
    file_put_contents('debug.log', "Formulaire POST re u\n", FILE_APPEND);

    // R cup ration et nettoyage des donnees
    $nom = trim($_POST["nom"] ?? '');
    $prenom = trim($_POST["prenom"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $motdepasse = $_POST["password"] ?? '';
    $confirm_mdp   = $_POST["confirm_password"] ?? '';

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["erreur"] = "L'adresse e-mail n'est pas valide.";
        header("Location: inscription.php");
        exit();
    }
    if ($motdepasse !== $confirm_mdp) {
    $_SESSION['erreur'] = "Les mots de passe ne correspondent pas.";
    header("Location: inscription.php");
    exit();
    }
    // Chargement des donn es existantes
    $donnees = [];
    if (file_exists($fichier_utilisateurs)) {
        $contenu = file_get_contents($fichier_utilisateurs);
        $donnees = json_decode($contenu, true) ?: ['utilisateur' => []];
        file_put_contents('debug.log', "Fichier utilisateurs.json charge\n", FILE_APPEND);
    } else {
        $donnees = ['utilisateur' => []];
        file_put_contents('debug.log', "Nouveau fichier utilisateurs.json initialise\n", FILE_APPEND);
    }

    // V rification de l'email existant
    foreach ($donnees['utilisateur'] as $user) {
        if (strtolower($user['e-mail'] ?? '') === strtolower($email)) {
            $_SESSION["erreur"] = "Cette adresse mail est deja utilisee.";
            header("Location: inscription.php");
            exit();
        }
    }

    // Cr ation du nouvel utilisateur
    $nouvel_utilisateur = [
        'nom' => $nom,
        'prenom' => $prenom,
        'e-mail' => $email,
        'motdepasse' => password_hash($motdepasse, PASSWORD_DEFAULT)
    ];

    $donnees['utilisateur'][] = $nouvel_utilisateur;

    //  criture dans le fichier
    if (file_put_contents($fichier_utilisateurs, json_encode($donnees, JSON_PRETTY_PRINT))) {
        file_put_contents('debug.log', "Utilisateur enregistre avec succes\n", FILE_APPEND);
        $_SESSION["message"] = "Inscription reussie ! Vous pouvez maintenant vous connecter.";
        header("Location: connexion.php");
        exit();
    } else {
        file_put_contents('debug.log', "echec de l'ecriture dans le fichier\n", FILE_APPEND);
        $_SESSION["erreur"] = "Une erreur est survenue lors de l'enregistrement. Veuillez reessayer.";
        header("Location: inscription.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Inscription</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/theme-switcher.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
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
                <li><a href="presentation.php">Présentation</a></li>
                <li><a href="rechercher.php">Rechercher un Safari</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
            </ul>
        </nav>
    </header>
    <!-- Section Inscription -->
    <section class="form-section">
        <h2>Inscription</h2>
        <?php if(isset($_SESSION['erreur'])): ?>
            <div class="error-message"><?= htmlspecialchars($_SESSION['erreur']) ?></div>
            <?php unset($_SESSION['erreur']); ?>
        <?php endif; ?>

        <?php if(isset($_SESSION['message'])): ?>
            <div class="success-message"><?= htmlspecialchars($_SESSION['message']) ?></div>
            <?php unset($_SESSION['message']); ?>
        <?php endif; ?>

        <form action="inscription.php" method="POST" class="inscription-form">
            <!-- Champ Nom -->
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>">
            </div>

            <!-- Champ Pr nom -->
            <div class="form-group">
                <label for="prenom">Pr&eacute;nom :</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre pr&eacute;nom" required value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>">
            </div>

            <!-- Champ Email -->
            <div class="form-group">
                <label for="email">Email :</label>
                <input type="email" id="email" name="email" placeholder="Votre email" required value="<?= htmlspecialchars($_POST['email'] ?? '') ?>">
            </div>

            <!-- Champ Mot de passe -->
            <div class="form-group">
                <label for="password">Mot de passe :</label>
                <input type="password" id="password" name="password" placeholder="Votre mot de passe" required minlength="8" maxlength="50">        
                <p class="help-text">Votre mot de passe doit comporter 8 caractères.</p>
            </div>

        <div class="form-group">
            <label for="confirm_password">Confirmez votre mot de passe :</label>
            <input type="password" name="confirm_password" id="confirm_password" placeholder="Confirmez votre mot de passe" required minlength="8" maxlength="50" oninput="checkPasswordMatch();"/>
            <span id="confirm-error" class="error-message"></span>
        </div>

            <!-- Bouton d'inscription -->
            <button type="submit" class="cta-button">S'inscrire</button>
        </form>
        <!-- Lien vers la page de connexion -->
        <p class="form-link">D&eacute;j&agrave; inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
    </section>
    </main>
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
    <script src="js/validation.js"></script>
    <script src="js/CompteurCaractères.js"></script>
    <script src="js/mdp.js"></script>
</body>
</html>
