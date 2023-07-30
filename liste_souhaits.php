<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
   header('location:utilisateur_login.php');
};

include 'composantes/panier_liste_souhaits.php';

if(isset($_POST['delete'])){
   $liste_souhaits_id = $_POST['wishlist_id'];
   $effacer_element_liste = $conn->prepare("DELETE FROM `liste` WHERE id = ?");
   $effacer_element_liste->execute([$liste_souhaits_id]);
}

if(isset($_GET['delete_all'])){
   $effacer_element_liste = $conn->prepare("DELETE FROM `liste` WHERE id_utilisateur = ?");
   $effacer_element_liste->execute([$id_utilisateur]);
   header('location:liste_souhaits.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>liste de souhaits</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="products">

   <h3 class="heading">Votre liste de souhaits</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_liste_souhaits = $conn->prepare("SELECT * FROM `liste` WHERE id_utilisateur = ?");
      $select_liste_souhaits->execute([$id_utilisateur]);
      if($select_liste_souhaits->rowCount() > 0){
         while($chercher_liste_souhaits = $select_liste_souhaits->fetch(PDO::FETCH_ASSOC)){
            $grand_total += $chercher_liste_souhaits['prix'];  
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $chercher_liste_souhaits['pid']; ?>">
      <input type="hidden" name="wishlist_id" value="<?= $chercher_liste_souhaits['id']; ?>">
      <input type="hidden" name="name" value="<?= $chercher_liste_souhaits['nom']; ?>">
      <input type="hidden" name="price" value="<?= $chercher_liste_souhaits['prix']; ?>">
      <input type="hidden" name="image" value="<?= $chercher_liste_souhaits['image']; ?>">
      <a href="aperçu_rapide.php?pid=<?= $chercher_liste_souhaits['pid']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $chercher_liste_souhaits['image']; ?>" alt="">
      <div class="name"><?= $chercher_liste_souhaits['nom']; ?></div>
      <div class="flex">
         <div class="price"><?= $chercher_liste_souhaits['prix']; ?>Dh</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
      </div>
      <input type="submit" value="Ajouter au panier" class="btn" name="add_to_cart">
      <input type="submit" value="effacer l'article" onclick="return confirm('supprimer ceci de la liste de souhaits ?');" class="delete-btn" name="delete">
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">votre liste de voeux est vide</p>';
   }
   ?>
   </div>

   <div class="wishlist-total">
      <p>total : <span><?= $grand_total; ?>Dh</span></p>
      <a href="magasin.php" class="option-btn">Continuer vos achats</a>
      <a href="liste_souhaits.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('tout supprimer de la liste de souhaits ?');">supprimer tous les éléments</a>
   </div>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>