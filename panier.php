<?php
session_start();
if (isset($_GET['action'], $_GET['index']) && $_GET['action'] === 'remove') {
    $idx = (int) $_GET['index'];
    if (isset($_SESSION['cart'][$idx])) {
        // Retirer l’élément et réindexer le tableau
        array_splice($_SESSION['cart'], $idx, 1);
    }
    header('Location: panier.php');
    exit;
}
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}
if (!isset($_SESSION['utilisateur'])) {
    header('Location: connexion.php');
    exit;
}
// On ne doit accepter l’accès qu’en POST depuis rechercher.php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['destination'])) {
    // Récupération des données envoyées
    $item = [
        'destination'     => $_POST['destination'],
        'choix_safari'    => $_POST['choix-du-safari'],
        'type_safari'     => $_POST['type-de-safari'],
        'ville_depart'    => $_POST['ville-depart'],
        'date_depart'     => $_POST['date-depart'],
        'date_retour'     => $_POST['date-retour'] ?? '',
        'type_logement'   => $_POST['type-de-logement'],
        'prix_final'      => floatval($_POST['prix_final'] ?? 0),
    ];

    // Initialisation du panier en session
    if (!isset($_SESSION['cart'])) {
        $_SESSION['cart'] = [];
    }
    $_SESSION['cart'][] = $item;

    header('Location: panier.php');
    exit;
}

// AFFICHAGE DU PANIER
$cart = $_SESSION['cart'] ?? [];
$total = 0;
foreach ($cart as $item) {
  $price = floatval($item['prix_final'] ?? 0);
  $total += $price;
  
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Inscription</title>
    <link rel="stylesheet" href="panier.css">
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
                <li><a href="presentation.php">Pr&eacute;sentation</a></li>
                <li><a href="rechercher.php">Rechercher un Safari</a></li>
                <li><a href="profil.php">Mon Profil</a></li>
                 <li><a href="logout.php">Déconnexion</a></li>
            </ul>
        </nav>
    </header>
<main class="cart-section">
  <?php if (empty($cart)): ?>
    <p>Votre panier est vide.</p>
    <a href="rechercher.php" class="cta-button">Rechercher un safari</a>
  <?php else: ?>
    <table>
      <thead>
        <tr>
          <th>Destination</th>
          <th>Safari</th>
          <th>Type</th>
          <th>Ville départ</th>
          <th>Date départ</th>
          <th>Date retour</th>
          <th>Logement</th>
          <th>Prix (€)</th>
          <th>Action</th> 
        </tr>
      </thead>
      <tbody>
        <?php foreach ($cart as $idx => $item):
              $price = isset($item['prix_final']) ? (float)$item['prix_final'] : 0.0;
          ?>
          <tr>
            <td data-label="Destination"><?= htmlspecialchars($item['destination']) ?></td>
            <td data-label="Choix Safari"><?= htmlspecialchars($item['choix_safari']) ?></td>
            <td data-label="Type de Safari"><?= htmlspecialchars($item['type_safari']) ?></td>
            <td data-label="Ville de départ"><?= htmlspecialchars($item['ville_depart']) ?></td>
            <td data-label="Date de départ"><?= htmlspecialchars($item['date_depart']) ?></td>
            <td data-label="Date de retour"><?= htmlspecialchars($item['date_retour']) ?></td>
            <td data-label="Type de Logement"><?= htmlspecialchars($item['type_logement']) ?></td>
            <td data-label="Prix"><?= number_format($price, 2, ',', ' ') ?></td>
            <td data-label="Action">
            <a href="panier.php?action=remove&index=<?= $idx ?>"class="remove-link" onclick="return confirm('Supprimer cet élément du panier ?');">Supprimer</a>
          </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
       <tfoot>
        <tr>
          <td colspan="7" style="text-align:right"><strong>Total :</strong></td>
          <td><?= number_format($total, 2, ',', ' ') ?> €</td>
        </tr>
      </tfoot>
    </table>
    <form action="paiement.php" method="post" style="text-align:center; margin-top:30px;">
      <input type="hidden" name="montant" value="<?= htmlspecialchars($total) ?>">
      <button type="submit" class="cta-button">
        Valider mon panier (<?= number_format($total, 2, ',', ' ') ?> €)
      </button>
    </form>
  <?php endif; ?>
</main>
     <footer class="site-footer">
        <div class="footer-content">
            <div class="footer-section">
                <h3>Contacts</h3>
                <p>95000 Cergy</p>
                <p>Tel: 07 60 64 38 10</p>
                <p>Informations g&eacute;n&eacute;rales: ilyashaidar6@gmail.com</p>
            </div>
            <div class="footer-section">
                <h3>Suivez-nous sur Instagram !</h3>
                <p>99ilyas66</p>
                <p>myriiam_br</p>
                <p>abdrzr_95</p>
            </div>
        </div>
        <p>&copy; 2025 Wild Safari. Tous droits r&eacute;serv&eacute;s.</p>
    </footer>
    <script src="js/theme-switcher.js"></script>
</body>
</html>