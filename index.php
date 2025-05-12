<?php
include 'header.php';
?>
  <section class="hero">
    <video autoplay loop muted playsinline class="hero-video" preload="auto">
      <source src="videos/safari-video.mp4" type="video/mp4">
      Votre navigateur ne supporte pas la vidéo.
    </video>
    <div class="hero-content">
      <h2>Explorez la nature sauvage</h2>
      <p>Découvrez des safaris inoubliables au cœur de l'Afrique. Réservez dès maintenant votre aventure !</p>
      <a href="rechercher.php" class="cta-button">Réserver maintenant</a>
    </div>
  </section>

  <!-- Section Présentation -->
  <section class="presentation">
    <h2>Bienvenue chez Wild Safari</h2>
    <p>
      Wild Safari vous propose des expériences uniques en pleine nature. Que vous soyez passionné de faune sauvage ou simplement à la recherche d'une escapade hors du commun, nos safaris sont conçus pour vous offrir des moments inoubliables. Découvrez des paysages à couper le souffle et des rencontres extraordinaires avec les animaux.
    </p>
  </section>

  <!-- Section Activités -->
  <section class="activities">
    <h2>Nos activités</h2>
    <div class="activity-grid">
      <div class="activity-card">
        <img src="images/safari.jpg" alt="Safari">
        <h3>Safari en 4x4</h3>
        <p>Explorez les réserves naturelles et observez les animaux dans leur habitat naturel.</p>
      </div>
      <div class="activity-card">
        <img src="images/randonnee.jpg" alt="Randonnée">
        <h3>Randonnée pédestre</h3>
        <p>Partez à pied à la découverte des paysages époustouflants de l'Afrique.</p>
      </div>
      <div class="activity-card">
        <img src="images/camping.jpg" alt="Camping">
        <h3>Camping en pleine nature</h3>
        <p>Passez une nuit sous les étoiles au cœur de la savane africaine.</p>
      </div>
    </div>
  </section>

  <!-- Section Témoignages -->
  <section class="testimonials">
    <h2>Ce que disent nos clients</h2>
    <div class="testimonial-grid">
      <div class="testimonial-card">
        <p>« Une expérience incroyable ! Les guides étaient très professionnels et les paysages à couper le souffle. »</p>
        <span>- Marie D.</span>
      </div>
      <div class="testimonial-card">
        <p>« Le safari en 4x4 était génial, nous avons vu des lions de très près. Je recommande vivement ! »</p>
        <span>- Jean P.</span>
      </div>
      <div class="testimonial-card">
        <p>« Un séjour inoubliable. Le camping sous les étoiles était magique. »</p>
        <span>- Sophie L.</span>
      </div>
    </div>
  </section>
   </main>
<?php include 'footer.php'; ?>
