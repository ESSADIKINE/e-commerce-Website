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
   <title>page de recherche</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="search-form">
   <form action="" method="post">
      <input type="text" name="search_box" placeholder="cherche ici..." maxlength="100" class="box" required>
      <button type="submit" class="fas fa-search" name="search_btn"></button>
   </form>
</section>

<section class="products" style="padding-top: 0; min-height:100vh;">

   <div class="box-container">

   <?php
     if(isset($_POST['search_box']) OR isset($_POST['search_btn'])){
     $barre_recherche = $_POST['search_box'];
     $select_produit = $conn->prepare("SELECT * FROM `produits` WHERE nom LIKE '%{$barre_recherche}%'"); 
     $select_produit->execute();
     if($select_produit->rowCount() > 0){
      while($chercher_produit = $select_produit->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $chercher_produit['id']; ?>">
      <input type="hidden" name="name" value="<?= $chercher_produit['nom']; ?>">
      <input type="hidden" name="price" value="<?= $chercher_produit['prix']; ?>">
      <input type="hidden" name="image" value="<?= $chercher_produit['image_01']; ?>">
      <button class="fas fa-heart" type="submit" name="add_to_wishlist"></button>
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
         echo '<p class="empty">aucun produit trouvé!</p>';
      }
   }
   ?>

   </div>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>