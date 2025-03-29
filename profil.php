<?php
session_start();
if(!isset($_SESSION['mail_utilisateur'])){
    header("Location: connexion.php");
    exit(1);
}
$fichier_utilisateurs='./data/utilisateurs.json';
$fichier_paiement='./data/paiement.json';

    if(!file_exists($fichier_utilisateurs) || !file_exists($fichier_paiement)){
        die("Erreur : Fichiers de données manquants");
    }
$donnee_utilisateur=json_decode(file_get_contents($fichier_utilisateurs), true);
$donnee_paiement=json_decode(file_get_contents($fichier_paiement), true);

$utilisateur_actuel=null;
    foreach($donnee_utilisateur['users'] as $utilisateurs){
        if ($utilisateurs['e-mail']===$_SESSION['mail_utilisateur']){
            $utilisateur_actuel=$utilisateurs;
            break;
        }
    }
    if(!$utilisateur_actuel){
        die("Erreur : Utilisateur non trouvé");
    }
$fichier_paiement=array_filter($donnee_paiement, function($paiements){
    return $paiements['mail_utilisateur']===$_SESSION['mail_utilisateur'];
});
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Mon Profil</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Ajout d'une icône de crayon (Font Awesome) -->
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
            </ul>
        </nav>
    </header>

    <!-- Section Profil Utilisateur -->
    <section class="profile-section">
        <h2>Mon Profil</h2>
            <!-- Informations de l'utilisateur -->
        <div>
            <div>
                <label>Nom :<?=$utilisateur_actuel['nom']?></label>
            </div>
            <div>
                <label>Prénom :<?=$utilisateur_actuel['prenom']?></label>
            </div>
            <div>
                <label>Adresse mail :<?=$utilisateur_actuel['e-mail']?></label>
            </div>
        </div>
            <h3>Mes Paiements</h3>
            <?php if(!empty($paiement_utilisateur)): ?>
                <ul>
                    <?php foreach ($paiement_utilisateur as $paiements): ?>
                        <li>
                            Montant : <?= $paiements['montant'] ?>€ - 
                            Date : <?= $paiements['date'] ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php else: ?>
                <p>Aucun paiement enregistré</p>
            <?php endif; ?>
        </div>
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

    <!-- Script pour la modification des champs -->
    <script>
        function editField(fieldId) {
            const field = document.getElementById(fieldId);
            const currentValue = field.innerText;
            const newValue = prompt(`Modifier ${fieldId}:`, currentValue);

            if (newValue !== null && newValue.trim() !== "") {
                field.innerText = newValue;
                alert("Modification enregistrée !");
            }
        }
    </script>
</body>
</html>