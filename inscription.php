<?php
session_start();
$fichier_utilisateurs = __DIR__ . '/data/utilisateurs.json';

if($_SERVER["REQUEST_METHOD"] == "POST"){
    $nom = isset($_POST["nom"]) ? htmlspecialchars(trim($_POST["nom"])) : "";
    $prenom = isset($_POST["prenom"]) ? htmlspecialchars(trim($_POST["prenom"])) : "";
    $email = isset($_POST["email"]) ? htmlspecialchars(trim($_POST["email"])) : "";
    $motdepasse = isset($_POST["password"]) ? $_POST["password"] : "";

    if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        $_SESSION["erreur"] = "L'adresse e-mail n'est pas valide.";
        header("Location: inscription.php");
        exit();
    }

    // Créer le dossier data s'il n'existe pas
    if(!file_exists(dirname($fichier_utilisateurs))){
        mkdir(dirname($fichier_utilisateurs), 0755, true);
    }

    // Initialiser la structure des données si le fichier n'existe pas
    $donnees = file_exists($fichier_utilisateurs) ? json_decode(file_get_contents($fichier_utilisateurs), true) : ['utilisateur' => []];

    // Vérifier si l'email existe déjà
    foreach($donnees['utilisateur'] as $user){
        if(strtolower($user["e-mail"]) === strtolower($email)){
            $_SESSION["erreur"] = "Cette adresse mail est déjà utilisée.";
            header("Location: inscription.php");
            exit();
        }
    }

    // Ajouter le nouvel utilisateur
    $nouvel_utilisateur = [
        "nom" => $nom,
        "prenom" => $prenom,
        "e-mail" => $email,
        "motdepasse" => password_hash($motdepasse, PASSWORD_DEFAULT)
    ];

    $donnees['utilisateur'][] = $nouvel_utilisateur;
    
    // Écrire dans le fichier
    if(file_put_contents($fichier_utilisateurs, json_encode($donnees, JSON_PRETTY_PRINT))){
        $_SESSION["message"] = "Inscription réussie ! Vous pouvez maintenant vous connecter.";
        header("Location: connexion.php");
        exit();
    } else {
        $_SESSION["erreur"] = "Une erreur est survenue lors de l'inscription.";
        header("Location: inscription.php");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Inscription</title>
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

    <!-- Section Inscription -->
    <section class="form-section">
        <h2>Inscription</h2>
        <form action="inscription.php" method="POST" class="inscription-form">
            <!-- Champ Nom -->
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" placeholder="Votre nom" required>
            </div>

            <!-- Champ Prénom -->
            <div class="form-group">
                <label for="prenom">Prénom :</label>
                <input type="text" id="prenom" name="prenom" placeholder="Votre prénom" required>
            </div>

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

            <!-- Bouton d'inscription -->
            <button type="submit" class="cta-button">S'inscrire</button>
        </form>

        <!-- Lien vers la page de connexion -->
        <p class="form-link">Déjà inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
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
