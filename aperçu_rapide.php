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
   <title>aperçu rapide</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="quick-view">

   <h1 class="heading">aperçu rapide</h1>

   <?php
     $pid = $_GET['pid'];
     $select_produit = $conn->prepare("SELECT * FROM `produits` WHERE id = ?"); 
     $select_produit->execute([$pid]);
     if($select_produit->rowCount() > 0){
      while($chercher_produit = $select_produit->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $chercher_produit['id']; ?>">
      <input type="hidden" name="name" value="<?= $chercher_produit['nom']; ?>">
      <input type="hidden" name="price" value="<?= $chercher_produit['prix']; ?>">
      <input type="hidden" name="image" value="<?= $chercher_produit['image_01']; ?>">
      <div class="row">
         <div class="image-container">
            <div class="main-image">
               <img src="uploaded_img/<?= $chercher_produit['image_01']; ?>" alt="">
            </div>
            <div class="sub-image">
               <img src="uploaded_img/<?= $chercher_produit['image_01']; ?>" alt="">
               <img src="uploaded_img/<?= $chercher_produit['image_02']; ?>" alt="">
               <img src="uploaded_img/<?= $chercher_produit['image_03']; ?>" alt="">
            </div>
         </div>
         <div class="content">
            <div class="name"><?= $chercher_produit['nom']; ?></div>
            <div class="flex">
               <div class="price"><?= $chercher_produit['prix']; ?><span>Dh</span></div>
               <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
            </div>
            <div class="details"><?= $chercher_produit['details']; ?></div>
            <div class="flex-btn">
               <input type="submit" value="Ajouter au panier" class="btn" name="add_to_cart">
               <input class="option-btn" type="submit" name="add_to_wishlist" value="ajouter à la liste de souhaits">
            </div>
         </div>
      </div>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">aucun produit ajouté pour le moment !</p>';
   }
   ?>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>