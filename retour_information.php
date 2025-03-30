<?php

header('Content-Type: text/html; charset=UTF-8');



require('getapikey.php');

if (!isset($_GET['transaction'],$_GET['montant'],$_GET['vendeur'],$_GET['status'],$_GET['control'])) {
    die("Erreur : paramètres manquants !");
}

$transaction=$_GET['transaction'];
$montant=$_GET['montant'];
$vendeur=$_GET['vendeur'];
$statut=$_GET['statut'];
$montant_envoye=$_GET['montant_envoye'];
$api_key=getAPIKey($vendeur);
$montant_calcule=md5($api_key."#".$transaction."#".$montant."#".$vendeur."#".$statut."#");

if($montant_envoye!==$montant_calcule){
    die("Erreur : données invalides !");
}
if($statut==="accepted"){
    echo"<h2>Paiement accepté</h2>";
    echo"<p>Transaction:$transaction</p>";
    echo"<p>Montant:$montant €</p>";
    echo"<p>Vendeur:$vendeur</p>";
}
else{
    echo"<h2>Paiement refusé</h2>";
    echo"<p>Transaction:$transaction</p>";
    echo"<p>Montant:$montant €</p>";
    echo"<p>Vendeur:$vendeur</p>";
}
echo "<br><a href='index.php'>Retour</a>";
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Confirmation de Paiement</title>
</head>
<body>
    <div class="container">
        <h2>Confirmation du Paiement</h2>
        <p class="message <?php echo ($statut==='accepté') ? 'succes' : 'erreur'; ?>">
            <?php echo $message; ?>
        </p>
        <p><strong>Transaction:</strong> <?php echo $transaction_id; ?></p>
        <p><strong>Montant:</strong> <?php echo $montant; ?> €</p>
        <p><strong>Statut:</strong> <?php echo ucfirst($statut); ?></p>
        <a href="index.php" class="btn">Retour à l'accueil</a>
    </div>
</body>
</html>

