<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>à propos</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="about">

   <div class="row">

      <div class="image">
         <img src="photos/about-img.svg" alt="">
      </div>

      <div class="content">
         <h3>Pourquoi nous choisir?</h3>
         <p>Fst Tech est un site e-commerce proposant une large gamme de produits électroniques et de technologie de l'information. Le site offre une expérience d'achat en ligne pratique et sécurisée, ainsi qu'une sélection de produits de qualité à des prix compétitifs. Les clients peuvent parcourir les différentes catégories de produits, lire les avis des clients et obtenir des conseils de professionnels avant de faire leur choix. Fst Tech s'engage à offrir un excellent service à la clientèle et à traiter chaque commande avec soin pour garantir la satisfaction de ses clients.</p>
         <a href="contact.php" class="btn">Contactez-Nous</a>
      </div>

   </div>

</section>

<section class="reviews">
   
   <h1 class="heading">avis clients</h1>

   <div class="swiper reviews-slider">

   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <img src="photos/pic-1.png" alt="">
         <p>Site Agréable Et Commande Facile Livraison Très Rapide Seul Petit Bémol Il Y Avait Des Rupture De Stock Sur Des Produit Que Je Voulais Acheter.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Anass Essadikine</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="photos/pic-2.png" alt="">
         <p>Site Simple D'utilisation. Pas De Surprises, Tout Est Bien Décrit. J'apprécie Les Commentaires Clients Qui Permettent De Se Faire Une Bonne Idée Du Produit.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Oussama BENMOUROU</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="photos/pic-3.png" alt="">
         <p>J'ai acheté un téléphone portable sur ce site et j'en suis très satisfait. Le prix était compétitif et la livraison a été rapide. Je recommande vivement ce site.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Oumaima BENBIHI</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="photos/pic-4.png" alt="">
         <p>J'ai commandé une tablette en ligne et j'ai été très déçu par la qualité du produit. Je ne recommande pas ce site pour les achats électroniques.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Abdessamad BOULKROUCHE</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="photos/pic-5.png" alt="">
         <p>J'ai acheté une montre connectée sur ce site et j'en suis très content. Le processus de paiement a été sécurisé et la livraison a été rapide. Je recommande ce site pour tous vos achats électroniques.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>Redeouan</h3>
      </div>

      <div class="swiper-slide slide">
         <img src="photos/pic-4.png" alt="">
         <p>J'ai acheté un ordinateur portable sur ce site et j'ai été très satisfait de mon achat. Le prix était très compétitif et le service client a été très réactif lorsque j'ai eu des questions. Je recommande vivement ce site.</p>
         <div class="stars">
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star"></i>
            <i class="fas fa-star-half-alt"></i>
         </div>
         <h3>mouad</h3>
      </div>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".reviews-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
        slidesPerView:1,
      },
      768: {
        slidesPerView: 2,
      },
      991: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>