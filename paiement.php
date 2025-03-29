<?php
session_start();
if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit(1);
}

require('getapikey.php'); 
$api_key = getAPIKey("SUPMECA_G"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $titulaire=htmlspecialchars($_POST['titulaire']);
    $numero_carte=htmlspecialchars($_POST['numero_carte']);
    $expiration= htmlspecialchars($_POST['expiration']);
    $CVV=htmlspecialchars($_POST['CVV']);
    $montant=htmlspecialchars($_POST['montant']);
    
    if(empty($titulaire) || empty($numero_carte) || empty($expiration) || empty($CVV) || empty($montant)){
        $message="Tous les champs doivent être remplis.";
    } 
    else if(!preg_match("/^[0-9]{16}$/", $numero_carte)){
        $message="Numéro de carte inexistant.";
    } 
    else if(!preg_match("/^[0-9]{3,4}$/", $CVV)){
        $message="CVV invalide.";
    } 
    else{
        $transaction_id=strtoupper(bin2hex(random_bytes(5)));
        $retour="http://localhost/safari/confirmation.php";
        $control=md5($api_key."#".$transaction_id."#".$montant."#SUPMECA_G#".$retour."#");
 
        $paiement=[
            "transaction_id"=>$transaction_id,
            "titulaire"=>$titulaire,
            "numero_carte"=>$numero_carte,
            "expiration"=>$expiration,
            "CVV"=>$CVV,
            "montant"=>$montant,
            "date"=>date("Y-m-d H:i:s"),
            "utilisateur"=>$_SESSION['utilisateur']
        ];
        $fichier_utilisateurs = './data/utilisateurs.json';
        $paiements=file_exists($fichier_utilisateurs) ? json_decode(file_get_contents($fichier_utilisateurs), true):[];
        $paiements[]=$paiement;
        file_put_contents($file, json_encode($paiements, JSON_PRETTY_PRINT));
        header("Location: https://www.plateforme-smc.fr/cybank/index.php?transaction=$transaction_id&montant=$montant&vendeur=SUPMECA_G&retour=$retour&control=$control");
        exit(1);
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Paiement - Wild Safari</title>
</head>
<body>
    <h2>Paiement</h2>
    <?php if (isset($message)) echo "<p style='color:red;'>$message</p>"; ?>
    <form action="paiement.php" method="POST">
        <label>Titulaire de la carte:</label>
        <input type="text" name="titulaire" required><br>
        <label>Numéro de carte:</label>
        <input type="text" name="numero_carte" required><br>
        <label>Date d'expiration:</label>
        <input type="month" name="expiration" required><br>
        <label>CVV:</label>
        <input type="text" name="CVV" required><br>
        <label>Montant:</label>
        <input type="text" name="montant" required><br>
        <button type="submit">Payer</button>
    </form>

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
