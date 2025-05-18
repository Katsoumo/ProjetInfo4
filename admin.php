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
            <tbody id="userTableBody">
                <!-- Les utilisateurs seront ajoutés ici dynamiquement via JavaScript -->
            </tbody>
        </table>
    </section>

    <!-- Logo de chargement centré -->
    <div id="loadingSpinner" style="display: none;">
        <img src="images/loading.gif" alt="Chargement..." />
    </div>

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

    <!-- Script pour charger les utilisateurs et gérer les actions administratives -->
    <script>
        // Charger les utilisateurs depuis utilisateurs.json dans le dossier 'data'
        fetch('data/utilisateurs.json')
            .then(response => response.json())
            .then(data => {
                const users = data.utilisateur;
                const tableBody = document.getElementById("userTableBody");

                // Parcourir les utilisateurs et créer des lignes de tableau
                users.forEach(user => {
                    const row = document.createElement("tr");

                    const nameCell = document.createElement("td");
                    nameCell.innerText = `${user.prenom} ${user.nom}`;
                    row.appendChild(nameCell);

                    const emailCell = document.createElement("td");
                    emailCell.innerText = user['e-mail'];
                    row.appendChild(emailCell);

                    const statusCell = document.createElement("td");
                    statusCell.innerText = "Standard"; // Par défaut, tous sont "Standard"
                    row.appendChild(statusCell);

                    const actionCell = document.createElement("td");
                    actionCell.innerHTML = `
                        <button class="action-button vip-button" onclick="simulateUpdate(this, 'VIP')">
                            <i class="fas fa-crown"></i> VIP
                        </button>
                        <button class="action-button ban-button" onclick="simulateUpdate(this, 'Bannir')">
                            <i class="fas fa-ban"></i> Bannir
                        </button>
                    `;
                    row.appendChild(actionCell);

                    tableBody.appendChild(row);
                });
            })
            .catch(error => console.error("Erreur de chargement des utilisateurs:", error));

        // Fonction pour simuler une mise à jour
        function simulateUpdate(button, action) {
            const row = button.closest("tr");
            const statusCell = row.querySelector("td:nth-child(3)");

            // Afficher le logo de chargement
            document.getElementById("loadingSpinner").style.display = "block";

            // Désactiver les boutons pendant la simulation
            const allButtons = row.querySelectorAll("button");
            allButtons.forEach(button => button.disabled = true);

            // Changer de statut temporairement
            setTimeout(() => {
                if (action === 'VIP') {
                    if (statusCell.innerText === "VIP") {
                        statusCell.innerText = "Standard";
                        button.classList.remove("active");
                    } else {
                        statusCell.innerText = "VIP";
                        button.classList.add("active");
                    }
                } else if (action === 'Bannir') {
                    if (statusCell.innerText === "Banni") {
                        statusCell.innerText = "Standard";
                        button.classList.remove("active");
                    } else {
                        statusCell.innerText = "Banni";
                        button.classList.add("active");
                    }
                }

                // Cacher le logo de chargement et réactiver les boutons après 3 secondes
                document.getElementById("loadingSpinner").style.display = "none";
                allButtons.forEach(button => button.disabled = false);

                // À ce stade, la requête réelle pour mettre à jour la donnée utilisateur peut être envoyée.
                // Par exemple, une requête fetch pour mettre à jour la base de données pourrait être effectuée ici.
                // Exemple :
                // updateUserInDatabase(row);
            }, 3000); // Délai de 3 secondes (3000 ms)
        }

        // Cette fonction serait utilisée pour mettre à jour l'utilisateur dans la base de données lors de la phase réelle.
        // function updateUserInDatabase(row) {
        //    const userId = row.dataset.id; // Exemple de récupération de l'ID utilisateur
        //    const newStatus = row.querySelector("td:nth-child(3)").innerText;
        //    // Envoyer la requête pour mettre à jour l'utilisateur via une API ou une autre méthode
        //    fetch('updateUserEndpoint', { 
        //        method: 'POST',
        //        body: JSON.stringify({ userId, newStatus })
        //    })
        //    .then(response => response.json())
        //    .then(data => console.log("Utilisateur mis à jour:", data))
        //    .catch(error => console.error("Erreur lors de la mise à jour:", error));
        // }
    </script>

    <style>
        /* Style pour centrer le logo de chargement */
        #loadingSpinner {
            position: fixed;  /* Fixe le logo de chargement à l'écran */
            top: 50%;         /* Place-le verticalement au centre */
            left: 50%;        /* Place-le horizontalement au centre */
            transform: translate(-50%, -50%); /* Correction de l'alignement pour centrer précisément */
            z-index: 1000;    /* Assure que le logo de chargement est au-dessus de tout le reste */
            display: none;    /* Par défaut, caché */
        }

        #loadingSpinner img {
            width: 50px;   /* Taille du logo de chargement (ajuster selon votre image) */
            height: 50px;  /* Taille du logo de chargement (ajuster selon votre image) */
        }
    </style>

</body>