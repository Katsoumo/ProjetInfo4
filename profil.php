<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wild Safari - Mon Profil</title>
    <link rel="stylesheet" href="styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;700&family=Raleway:wght@700&display=swap" rel="stylesheet">
    <!-- Ajout d'une icône de crayon (Font Awesome) -->
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
                <li><a href="index.html">Accueil</a></li>
                <li><a href="presentation.html">Présentation</a></li>
                <li><a href="rechercher.html">Rechercher un voyage</a></li>
                <li><a href="inscription.html">Inscription</a></li>
                <li><a href="connexion.html">Connexion</a></li>
                <li><a href="profil.html">Mon Profil</a></li> 
            </ul>
        </nav>
    </header>

    <!-- Section Profil Utilisateur -->
    <section class="profile-section">
        <h2>Mon Profil</h2>
        <div class="profile-info">
            <!-- Informations de l'utilisateur -->
            <div class="info-group">
                <label>Nom :</label>
                <p id="nom">Jean Dupont</p>
                <button class="edit-button" onclick="editField('nom')">
                    <i class="fas fa-pencil-alt"></i> <!-- Icône crayon -->
                </button>
            </div>

            <div class="info-group">
                <label>Prénom :</label>
                <p id="prenom">Marie</p>
                <button class="edit-button" onclick="editField('prenom')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>

            <div class="info-group">
                <label>Email :</label>
                <p id="email">jean.dupont@example.com</p>
                <button class="edit-button" onclick="editField('email')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>

            <div class="info-group">
                <label>Mot de passe :</label>
                <p id="password">••••••••</p>
                <button class="edit-button" onclick="editField('password')">
                    <i class="fas fa-pencil-alt"></i>
                </button>
            </div>
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
