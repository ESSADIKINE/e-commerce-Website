<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
};

include 'composantes/panier_liste_souhaits.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>accueil</title>

   <link rel="stylesheet" href="https://unpkg.com/swiper@8/swiper-bundle.min.css" />
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<div class="home-bg">

<section class="home">

   <div class="swiper home-slider">
   
   <div class="swiper-wrapper">

      <div class="swiper-slide slide">
         <div class="image">
            <img src="photos/TCL-40.png" alt="">
         </div>
         <div class="content">
            <span>De bons produits aux meilleurs prix</span>
            <h3>derniers smartphones</h3>
            <a href="magasin.php" class="btn">Achetez maintenant</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="photos/home-img-2.png" alt="">
         </div>
         <div class="content">
            <span>De bons produits aux meilleurs prix</span>
            <h3>derniers smartwatches</h3>
            <a href="magasin.php" class="btn">Achetez maintenant</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="photos/laptop.png" alt="">
         </div>
         <div class="content">
            <span>De bons produits aux meilleurs prix</span>
            <h3>derniers laptops</h3>
            <a href="magasin.php" class="btn">Achetez maintenant</a>
         </div>
      </div>

      <div class="swiper-slide slide">
         <div class="image">
            <img src="photos/home-1.png" alt="">
          </div>
           <div class="content">
             <span>De bons produits aux meilleurs prix</span>
             <h3>derniers écouteurs</h3>
             <a href="magasin.php" class="btn">Achetez maintenant</a>
          </div>
         </div>
      </div>

      <div class="swiper-pagination"></div>

   </div>

</section>

</div>

</div>

<section class="home">
<section class="home-products">

   <h1 class="heading">derniers produits</h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_produit = $conn->prepare("SELECT * FROM `produits` LIMIT 6"); 
     $select_produit->execute();
     if($select_produit->rowCount() > 0){
      while($chercher_produit = $select_produit->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $chercher_produit['id']; ?>">
      <input type="hidden" name="name" value="<?= $chercher_produit['nom']; ?>">
      <input type="hidden" name="price" value="<?= $chercher_produit['prix']; ?>">
      <input type="hidden" name="image" value="<?= $chercher_produit['image_01']; ?>">
      <button href="aperçu_rapide.php?pid=<?= $chercher_produit['id']; ?>" class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
      <a href="aperçu_rapide.php?pid=<?= $chercher_produit['id']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $chercher_produit['image_01']; ?>" alt="">
      <div class="name"><?= $chercher_produit['nom']; ?></div>
      <div class="flex">
         <div class="price"><?= $chercher_produit['prix']; ?><span>Dh</span></div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Ajouter au panier" class="btn" name="add_to_cart">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">aucun produit ajouté pour le moment !</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>

</section>

<?php include 'composantes/bas_page.php'; ?>



<script src="https://unpkg.com/swiper@8/swiper-bundle.min.js"></script>

<script src="js/script.js"></script>

<script>

var swiper = new Swiper(".home-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
    },
});

 var swiper = new Swiper(".category-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      0: {
         slidesPerView: 2,
       },
      650: {
        slidesPerView: 3,
      },
      768: {
        slidesPerView: 4,
      },
      1024: {
        slidesPerView: 5,
      },
   },
});

var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

</script>

</body>
</html>