<?php

include '../composantes/connecter.php';

session_start();

$id_admin = $_SESSION['admin_id'];

if(!isset($id_admin)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $nom = $_POST['name'];
   $nom = filter_var($nom, FILTER_SANITIZE_STRING);
   $prix = $_POST['price'];
   $prix = filter_var($prix, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $update_product = $conn->prepare("UPDATE `produits` SET nom = ?, prix = ?, details = ? WHERE id = ?");
   $update_product->execute([$nom, $prix, $details, $pid]);

   $message[] = 'produit mis à jour avec succès!';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = "la taille de l'image est trop grande!";
      }else{
         $update_image_01 = $conn->prepare("UPDATE `produits` SET image_01 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/'.$old_image_01);
         $message[] = 'image 01 mise à jour avec succès!';
      }
   }

   $old_image_02 = $_POST['old_image_02'];
   $image_02 = $_FILES['image_02']['name'];
   $image_02 = filter_var($image_02, FILTER_SANITIZE_STRING);
   $image_size_02 = $_FILES['image_02']['size'];
   $image_tmp_name_02 = $_FILES['image_02']['tmp_name'];
   $image_folder_02 = '../uploaded_img/'.$image_02;

   if(!empty($image_02)){
      if($image_size_02 > 2000000){
         $message[] = "la taille de l'image est trop grande!";
      }else{
         $update_image_02 = $conn->prepare("UPDATE `produits` SET image_02 = ? WHERE id = ?");
         $update_image_02->execute([$image_02, $pid]);
         move_uploaded_file($image_tmp_name_02, $image_folder_02);
         unlink('../uploaded_img/'.$old_image_02);
         $message[] = 'image 02 mise à jour avec succès!';
      }
   }

   $old_image_03 = $_POST['old_image_03'];
   $image_03 = $_FILES['image_03']['name'];
   $image_03 = filter_var($image_03, FILTER_SANITIZE_STRING);
   $image_size_03 = $_FILES['image_03']['size'];
   $image_tmp_name_03 = $_FILES['image_03']['tmp_name'];
   $image_folder_03 = '../uploaded_img/'.$image_03;

   if(!empty($image_03)){
      if($image_size_03 > 2000000){
         $message[] = "la taille de l'image est trop grande!";
      }else{
         $update_image_03 = $conn->prepare("UPDATE `produits` SET image_03 = ? WHERE id = ?");
         $update_image_03->execute([$image_03, $pid]);
         move_uploaded_file($image_tmp_name_03, $image_folder_03);
         unlink('../uploaded_img/'.$old_image_03);
         $message[] = 'image 03 mise à jour avec succès!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>mettre à jour le produit</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="update-product">

   <h1 class="heading">mettre à jour le produit</h1>

   <?php
      $update_id = $_GET['update'];
      $select_produit = $conn->prepare("SELECT * FROM `produits` WHERE id = ?");
      $select_produit->execute([$update_id]);
      if($select_produit->rowCount() > 0){
         while($chercher_produits = $select_produit->fetch(PDO::FETCH_ASSOC)){ 
   ?>
   <form action="" method="post" enctype="multipart/form-data">
      <input type="hidden" name="pid" value="<?= $chercher_produits['id']; ?>">
      <input type="hidden" name="old_image_01" value="<?= $chercher_produits['image_01']; ?>">
      <input type="hidden" name="old_image_02" value="<?= $chercher_produits['image_02']; ?>">
      <input type="hidden" name="old_image_03" value="<?= $chercher_produits['image_03']; ?>">
      <div class="image-container">
         <div class="main-image">
            <img src="../uploaded_img/<?= $chercher_produits['image_01']; ?>" alt="">
         </div>
         <div class="sub-image">
            <img src="../uploaded_img/<?= $chercher_produits['image_01']; ?>" alt="">
            <img src="../uploaded_img/<?= $chercher_produits['image_02']; ?>" alt="">
            <img src="../uploaded_img/<?= $chercher_produits['image_03']; ?>" alt="">
         </div>
      </div>
      <span>mettre à jour le nom</span>
      <input type="text" name="name" required class="box" maxlength="100" placeholder="entrez le nom du produit" value="<?= $chercher_produits['nom']; ?>">
      <span>mettre à jour le prix</span>
      <input type="number" name="price" required class="box" min="0" max="9999999999" placeholder="entrez le prix du produit" onkeypress="if(this.value.length == 10) return false;" value="<?= $chercher_produits['prix']; ?>">
      <span>mettre à jour les détails</span>
      <textarea name="details" class="box" required cols="30" rows="10"><?= $chercher_produits['details']; ?></textarea>
      <span>mettre à jour l'image 01</span>
      <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>mettre à jour l'image 02</span>
      <input type="file" name="image_02" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <span>mettre à jour l'image 03</span>
      <input type="file" name="image_03" accept="image/jpg, image/jpeg, image/png, image/webp" class="box">
      <div class="flex-btn">
         <input type="submit" name="update" class="btn" value="mettre à jour">
         <a href="produits.php" class="option-btn">retourner</a>
      </div>
   </form>
   
   <?php
         }
      }else{
         echo '<p class="empty">aucun produit trouvé!</p>';
      }
   ?>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>