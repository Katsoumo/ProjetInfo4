<?php
header('Content-Type: text/html; charset=UTF-8');
include 'header.php';
if (!isset($_SESSION['utilisateur'])) {
    header("Location: connexion.php");
    exit();
}

$prix = floatval($_POST['montant'] ?? 0);

require('getapikey.php');
$api_key = getAPIKey("SUPMECA_G");

// Initialisation des variables
$message = '';
$titulaire = $_POST['titulaire'] ?? '';
$numero_carte = $_POST['numero_carte'] ?? '';
$expiration = $_POST['expiration'] ?? '';
$CVV = $_POST['CVV'] ?? '';


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validation des données
    $titulaire = htmlspecialchars(trim($_POST['titulaire'] ?? ''));
    $numero_carte = htmlspecialchars(trim($_POST['numero_carte'] ?? ''));
    $expiration = htmlspecialchars(trim($_POST['expiration'] ?? ''));
    $CVV = htmlspecialchars(trim($_POST['CVV'] ?? ''));
    $montant = htmlspecialchars(trim($_POST['montant'] ?? ''));

    if (empty($titulaire) || empty($numero_carte) || empty($expiration) || empty($CVV) || empty($montant)) {
        $message = "Tous les champs doivent être remplis.";
    } elseif (!preg_match("/^[0-9]{16}$/", str_replace(' ', '', $numero_carte))) {
        $message = "Numéro de carte invalide (16 chiffres requis).";
    } elseif (!preg_match("/^[0-9]{3,4}$/", $CVV)) {
        $message = "CVV invalide (3 ou 4 chiffres requis).";
    } elseif (!is_numeric($montant)) {
        $message = "Montant invalide.";
    } else {
        // Simulation de paiement
        $transaction_id = strtoupper(bin2hex(random_bytes(5)));
        $retour = "http://".$_SERVER['HTTP_HOST']."/ProjetSafari/retour_information.php";
        $control = md5($api_key."#".$transaction_id."#".$montant."#SUPMECA_G#".$retour."#");

        // Enregistrement facture
        $paiement = [
            "transaction_id" => $transaction_id,
            "utilisateur" => $_SESSION['utilisateur']['email'],
            "montant" => $montant,
            "date" => date("Y-m-d H:i:s"),
            "statut" => "en_attente"
        ];

        $fichier_paiement = __DIR__ . '/data/paiement.json';
        $paiements = file_exists($fichier_paiement) ? json_decode(file_get_contents($fichier_paiement), true) : [];
        $paiements[] = $paiement;
        file_put_contents($fichier_paiement, json_encode($paiements, JSON_PRETTY_PRINT));

        // Redirection vers le simulateur de banque
        header("Location: https://www.plateforme-smc.fr/cybank/index.php?transaction=$transaction_id&montant=$montant&vendeur=SUPMECA_G&retour=$retour&control=$control");
        exit();
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Paiement - Wild Safari</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/theme-switcher.js" defer></script>
    <style>
        body {
            padding-top: 150px;
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
        }

        .paiement-container {
            max-width: 600px;
            margin: 300px auto 200px;
            padding: 30px;
            background: white;
            border-radius: 8px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
            box-sizing: border-box;
        }

        input[readonly] {
            background-color: #f9f9f9;
        }

        .error {
            color: #d9534f;
            margin: 20px 0;
            padding: 15px;
            background: #fdf7f7;
            border-radius: 4px;
            border-left: 4px solid #d9534f;
        }

        .cta-button {
            background-color: #e67e22;
            color: white;
            padding: 14px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
            transition: background-color 0.3s;
            margin-top: 10px;
        }

        .cta-button:hover {
            background-color: #d35400;
        }

        .site-header {
            position: fixed;
            top: 0;
            width: 100%;
            z-index: 1000;
        }
    </style>
</head>
<body>

    <main class="paiement-container">
        <h2 style="color: #e67e22; text-align: center; margin-bottom: 30px;">Finalisation de votre paiement</h2>

        <?php if (!empty($message)): ?>
            <div class="error"><?= htmlspecialchars($message) ?></div>
        <?php endif; ?>

        <form method="POST">
            <div class="form-group">
                <label for="titulaire">Titulaire de la carte :</label>
                <input type="text" id="titulaire" name="titulaire" value="<?= htmlspecialchars($titulaire) ?>" required>
            </div>

            <div class="form-group">
                <label for="numero_carte">Num&eacute;ro de carte :</label>
                <input type="text" id="numero_carte" name="numero_carte" value="<?= htmlspecialchars($numero_carte) ?>" required placeholder="1234 5678 9012 3456" pattern="[0-9\s]{16,19}">
            </div>

            <div class="form-group">
                <label for="expiration">Date d'expiration :</label>
                <input type="month" id="expiration" name="expiration" value="<?= htmlspecialchars($expiration) ?>" required>
            </div>

            <div class="form-group">
                <label for="CVV">Code de s&eacute;curit&eacute; (CVV) :</label>
                <input type="text" id="CVV" name="CVV" value="<?= htmlspecialchars($CVV) ?>" required placeholder="123" pattern="[0-9]{3,4}">
            </div>

            <div class="form-group">
                <label>Montant à payer :</label>
                <input type="text" value="<?= htmlspecialchars($prix) ?>€" readonly class="montant-readonly">
                <input type="hidden" name="montant" value="<?= htmlspecialchars($prix) ?>">
            </div>

            <button type="submit" class="cta-button">Payer maintenant</button>
        </form>
    </main>
<?php include 'footer.php'; ?>

