<?php

include '../composantes/connecter.php';

session_start();

$id_admin = $_SESSION['admin_id'];

if(!isset($id_admin)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $nom = $_POST['name'];
   $nom = filter_var($nom, FILTER_SANITIZE_STRING);
   $prix = $_POST['price'];
   $prix = filter_var($prix, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   $select_produit = $conn->prepare("SELECT * FROM `produits` WHERE nom = ?");
   $select_produit->execute([$nom]);

   if($select_produit->rowCount() > 0){
      $message[] = 'le nom du produit existe déjà !';
   }else{

      $ajouter_produits = $conn->prepare("INSERT INTO `produits`(nom, details, prix, image_01, image_02, image_03) VALUES(?,?,?,?,?,?)");
      $ajouter_produits->execute([$nom, $details, $prix, $image_01, $image_02, $image_03]);

      if($ajouter_produits){
         if($image_size_01 > 2000000 OR $image_size_02 > 2000000 OR $image_size_03 > 2000000){
            $message[] = "la taille de l'image est trop grande!";
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
            move_uploaded_file($image_tmp_name_02, $image_folder_02);
            move_uploaded_file($image_tmp_name_03, $image_folder_03);
            $message[] = 'nouveau produit ajouté!';
         }

      }

   }  

};

if(isset($_GET['delete'])){

   $effacer_id = $_GET['delete'];
   $effacer_image_produit = $conn->prepare("SELECT * FROM `produits` WHERE id = ?");
   $effacer_image_produit->execute([$effacer_id]);
   $fetch_delete_image = $effacer_image_produit->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_02']);
   unlink('../uploaded_img/'.$fetch_delete_image['image_03']);
   $effacer_produits = $conn->prepare("DELETE FROM `produits` WHERE id = ?");
   $effacer_produits->execute([$effacer_id]);
   $supprimer_panier = $conn->prepare("DELETE FROM `panier` WHERE pid = ?");
   $supprimer_panier->execute([$effacer_id]);
   $effacer_liste_souhaits = $conn->prepare("DELETE FROM `liste` WHERE pid = ?");
   $effacer_liste_souhaits->execute([$effacer_id]);
   header('location:produits.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>produits</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="add-products">

   <h1 class="heading">ajouter un produit</h1>

   <form action="" method="post" enctype="multipart/form-data">
      <div class="flex">
         <div class="inputBox">
            <span>nom du produit (obligatoire)</span>
            <input type="text" class="box" required maxlength="100" placeholder="entrez le nom du produit" name="name">
         </div>
         <div class="inputBox">
            <span>prix du produit (obligatoire)</span>
            <input type="number" min="0" class="box" required max="9999999999" placeholder="entrez le prix du produit" onkeypress="if(this.value.length == 10) return false;" name="price">
         </div>
        <div class="inputBox">
            <span>image 01 (obligatoire)</span>
            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 02 (obligatoire)</span>
            <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
        <div class="inputBox">
            <span>image 03 (obligatoire)</span>
            <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box" required>
        </div>
         <div class="inputBox">
            <span>détails du produit (obligatoire)</span>
            <textarea name="details" placeholder="entrer les détails du produit" class="box" required maxlength="500" cols="30" rows="10"></textarea>
         </div>
      </div>
      
      <input type="submit" value="ajouter le produit" class="btn" name="add_product">
   </form>

</section>

<section class="show-products">

   <h1 class="heading">produits ajoutés</h1>

   <div class="box-container">

   <?php
      $select_produit = $conn->prepare("SELECT * FROM `produits`");
      $select_produit->execute();
      if($select_produit->rowCount() > 0){
         while($chercher_produits = $select_produit->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <div class="box">
      <img src="../uploaded_img/<?= $chercher_produits['image_01']; ?>" alt="">
      <div class="name"><?= $chercher_produits['nom']; ?></div>
      <div class="price"><span><?= $chercher_produits['prix']; ?></span> Dh</div>
      <div class="details"><span><?= $chercher_produits['details']; ?></span></div>
      <div class="flex-btn">
         <a href="mise_jour_produit.php?update=<?= $chercher_produits['id']; ?>" class="option-btn">modifier</a>
         <a href="produits.php?delete=<?= $chercher_produits['id']; ?>" class="delete-btn" onclick="return confirm('supprimer ce produit ?');">supprimer</a>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">aucun produit ajouté pour le moment!</p>';
      }
   ?>
   
   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>