<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
   header('location:utilisateur_login.php');
};

if(isset($_POST['delete'])){
   $id_panier = $_POST['id_panier'];
   $effacer_element_panier = $conn->prepare("DELETE FROM `panier` WHERE id = ?");
   $effacer_element_panier->execute([$id_panier]);
}

if(isset($_GET['delete_all'])){
   $effacer_element_panier = $conn->prepare("DELETE FROM `panier` WHERE id_utilisateur = ?");
   $effacer_element_panier->execute([$id_utilisateur]);
   header('location:panier.php');
}

if(isset($_POST['update_qty'])){
   $id_panier = $_POST['id_panier'];
   $quantité = $_POST['qty'];
   $quantité = filter_var($quantité, FILTER_SANITIZE_STRING);
   $mise_jour_quantité = $conn->prepare("UPDATE `panier` SET quantité = ? WHERE id = ?");
   $mise_jour_quantité->execute([$quantité, $id_panier]);
   $message[] = 'quantité du panier mise à jour';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Panier</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="products shopping-cart">

   <h3 class="heading">Panier</h3>

   <div class="box-container">

   <?php
      $grand_total = 0;
      $select_panier = $conn->prepare("SELECT * FROM `panier` WHERE id_utilisateur = ?");
      $select_panier->execute([$id_utilisateur]);
      if($select_panier->rowCount() > 0){
         while($chercher_panier = $select_panier->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="id_panier" value="<?= $chercher_panier['id']; ?>">
      <a href="aperçu_rapide.php?pid=<?= $chercher_panier['pid']; ?>" class="fas fa-eye"></a>
      <img src="uploaded_img/<?= $chercher_panier['image']; ?>" alt="">
      <div class="name"><?= $chercher_panier['nom']; ?></div>
      <div class="flex">
         <div class="price"><?= $chercher_panier['prix']; ?>Dh</div>
         <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $chercher_panier['quantité']; ?>">
         <button type="submit" class="fas fa-edit" name="update_qty"></button>
      </div>
      <div class="sub-total"> sous-total : <span><?= $sub_total = ($chercher_panier['prix'] * $chercher_panier['quantité']); ?>Dh</span> </div>
      <input type="submit" value="supprimer le produit" onclick="return confirm('supprimer ceci du panier ?');" class="delete-btn" name="delete">
   </form>
   <?php
   $grand_total += $sub_total;
      }
   }else{
      echo '<p class="empty">Votre panier est vide</p>';
   }
   ?>
   </div>

   <div class="cart-total">
      <p>total : <span><?= $grand_total; ?>Dh</span></p>
      <a href="magasin.php" class="option-btn">Continuer vos achats</a>
      <a href="panier.php?delete_all" class="delete-btn <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('tout supprimer du panier ?');">supprimer tous les produits</a>
      <a href="vérifier.php" class="btn <?= ($grand_total > 1)?'':'disabled'; ?>">Passer à la caisse</a>
   </div>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>