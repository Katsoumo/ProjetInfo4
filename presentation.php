<?php
include 'header.php';
?>


<div class="spacer" style="height: 150px;"></div>

<!-- Section Présentation -->
<section class="presentation">
    <h2>Bienvenue chez Wild Safari</h2>

    <!-- Section Présentation du site -->
    <section class="presentation-section">
        <h2>Présentation de Wild Safari</h2>
        <p>
            Bienvenue sur <strong>Wild Safari</strong>, votre agence de voyages spécialisée dans les safaris en Afrique. Notre mission est de vous offrir des expériences uniques et inoubliables au cœur de la nature sauvage. Que vous soyez passionné de faune sauvage ou simplement à la recherche d'une escapade hors du commun, nos circuits sont conçus pour vous faire découvrir des paysages à couper le souffle et des rencontres extraordinaires avec les animaux.
        </p>
        <p>
            Nous proposons des séjours déjà configurés, mais vous avez la possibilité de personnaliser certaines options comme l'hébergement, la restauration, les activités et les transports. Explorez nos offres et réservez dès maintenant votre aventure !
        </p>

    </section>

    <!-- Section Recherche rapide -->
    <section class="quick-search">
        <h2>Rechercher un voyage</h2>
        <form action="rechercher.php" method="GET" class="search-form">
            <input type="text" name="query" placeholder="Rechercher un voyage..." required>
            <button type="submit">🔍</button>
        </form>
    </section>
    </main>
    <?php include 'footer.php'; ?>
