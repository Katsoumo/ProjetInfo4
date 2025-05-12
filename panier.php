<?php
include 'header.php';
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

<main class="cart-section">
  <h1>Mon Panier</h1>

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
<?php include 'footer.php'; ?>
