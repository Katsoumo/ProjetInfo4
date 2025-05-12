<?php
include 'header.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Administration</title>
    <link rel="stylesheet" href="styles.css">
    <script src="js/theme-switcher.js" defer></script>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&family=Playfair+Display:wght@700&display=swap" rel="stylesheet">
    <!-- Ajout d'icônes (Font Awesome) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <!-- En-tête du site -->
    <header class="site-header">
        <div class="logo">
            <a href="index.html">
                <img src="images/logo.png" alt="Wild Safari Logo" class="logo-image">
            </a>
            <p>Réservation de safaris en Afrique et séjours en pleine nature</p>
        </div>
        <nav class="main-nav">
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="presentation.php">Présentation</a></li>
                <li><a href="rechercher.php">Rechercher un voyage</a></li>
                <li><a href="inscription.php">Inscription</a></li>
                <li><a href="connexion.php">Connexion</a></li>
                <li><a href="admin.php">Administration</a></li> <!-- Lien vers la page d'administration -->
            </ul>
        </nav>
    </header>

    <!-- Section Administration -->
    <section class="admin-section">
        <h2>Administration des Utilisateurs</h2>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Email</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <!-- Exemple d'utilisateurs -->
                <tr>
                    <td>Jean Dupont</td>
                    <td>jean.dupont@example.com</td>
                    <td>Standard</td>
                    <td>
                        <button class="action-button vip-button" onclick="toggleVIP(this)">
                            <i class="fas fa-crown"></i> VIP
                        </button>
                        <button class="action-button ban-button" onclick="toggleBan(this)">
                            <i class="fas fa-ban"></i> Bannir
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Marie Curie</td>
                    <td>marie.curie@example.com</td>
                    <td>VIP</td>
                    <td>
                        <button class="action-button vip-button" onclick="toggleVIP(this)">
                            <i class="fas fa-crown"></i> VIP
                        </button>
                        <button class="action-button ban-button" onclick="toggleBan(this)">
                            <i class="fas fa-ban"></i> Bannir
                        </button>
                    </td>
                </tr>
                <tr>
                    <td>Paul Martin</td>
                    <td>paul.martin@example.com</td>
                    <td>Banni</td>
                    <td>
                        <button class="action-button vip-button" onclick="toggleVIP(this)">
                            <i class="fas fa-crown"></i> VIP
                        </button>
                        <button class="action-button ban-button" onclick="toggleBan(this)">
                            <i class="fas fa-ban"></i> Bannir
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </section>
</main>
<script src="js/adminaction.js"></script>
<?php include 'footer.php'; ?>
