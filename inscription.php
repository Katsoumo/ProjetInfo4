<?php
header('Content-Type: text/html; charset=UTF-8');
include 'header.php';
$fichier_utilisateurs = __DIR__ . '/data/utilisateurs.json';

// Debug: V�rifier si le script est atteint
file_put_contents('debug.log', "Script inscription.php atteint\n", FILE_APPEND);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Debug: Formulaire soumis
    file_put_contents('debug.log', "Formulaire POST re�u\n", FILE_APPEND);

    // R�cup�ration et nettoyage des donn�es
    $nom = trim($_POST["nom"] ?? '');
    $prenom = trim($_POST["prenom"] ?? '');
    $email = trim($_POST["email"] ?? '');
    $motdepasse = $_POST["password"] ?? '';

    // Validation de l'email
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $_SESSION["erreur"] = "L'adresse e-mail n'est pas valide.";
        header("Location: inscription.php");
        exit();
    }

    // Cr�ation du dossier data si inexistant
    if (!file_exists(dirname($fichier_utilisateurs))) {
        mkdir(dirname($fichier_utilisateurs), 0755, true);
        file_put_contents('debug.log', "Dossier data cr��\n", FILE_APPEND);
    }

    // Chargement des donn�es existantes
    $donnees = [];
    if (file_exists($fichier_utilisateurs)) {
        $contenu = file_get_contents($fichier_utilisateurs);
        $donnees = json_decode($contenu, true) ?: ['utilisateur' => []];
        file_put_contents('debug.log', "Fichier utilisateurs.json charg�\n", FILE_APPEND);
    } else {
        $donnees = ['utilisateur' => []];
        file_put_contents('debug.log', "Nouveau fichier utilisateurs.json initialis�\n", FILE_APPEND);
    }

    // V�rification de l'email existant
    foreach ($donnees['utilisateur'] as $user) {
        if (strtolower($user['e-mail'] ?? '') === strtolower($email)) {
            $_SESSION["erreur"] = "Cette adresse mail est d�j� utilis�e.";
            header("Location: inscription.php");
            exit();
        }
    }

    // Cr�ation du nouvel utilisateur
    $nouvel_utilisateur = [
        'nom' => $nom,
        'prenom' => $prenom,
        'e-mail' => $email,
        'motdepasse' => password_hash($motdepasse, PASSWORD_DEFAULT)
    ];

    $donnees['utilisateur'][] = $nouvel_utilisateur;

    // �criture dans le fichier
    if (file_put_contents($fichier_utilisateurs, json_encode($donnees, JSON_PRETTY_PRINT))) {
        file_put_contents('debug.log', "Utilisateur enregistr� avec succ�s\n", FILE_APPEND);
        $_SESSION["message"] = "Inscription r�ussie ! Vous pouvez maintenant vous connecter.";
        header("Location: connexion.php");
        exit();
    } else {
        file_put_contents('debug.log', "�chec de l'�criture dans le fichier\n", FILE_APPEND);
        $_SESSION["erreur"] = "Une erreur est survenue lors de l'enregistrement. Veuillez r�essayer.";
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

            <!-- Champ Pr�nom -->
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
            </div>

            <!-- Bouton d'inscription -->
            <button type="submit" class="cta-button">S'inscrire</button>
        </form>

        <!-- Lien vers la page de connexion -->
        <p class="form-link">D&eacute;j&agrave; inscrit ? <a href="connexion.php">Connectez-vous ici</a>.</p>
    </section>
    </main>
      <script src="js/validation.js"></script>
    <script src="js/CompteurCaractères.js"></script>
    <script src="js/mdp.js"></script>
    <?php include 'footer.php'; ?>
