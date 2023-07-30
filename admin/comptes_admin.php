<?php

include '../composantes/connecter.php';

session_start();

$id_admin = $_SESSION['admin_id'];

if(!isset($id_admin)){
  header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $effacer_id = $_GET['delete'];
   $effacer_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $effacer_admins->execute([$effacer_id]);
   header('location:comptes_admin.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>comptes admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="accounts">

   <h1 class="heading">comptes admin</h1>

   <div class="box-container">

   <div class="box">
      <p>ajouter un nouvel admin</p>
      <a href="register_admin.php" class="option-btn">s'inscrire admin</a>
   </div>

   <?php
      $select_comptes = $conn->prepare("SELECT * FROM `admins`");
      $select_comptes->execute();
      if($select_comptes->rowCount() > 0){
         while($cherche_comptes = $select_comptes->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p> id d'admin : <span><?= $cherche_comptes['id']; ?></span> </p>
      <p> nom d'admin : <span><?= $cherche_comptes['nom']; ?></span> </p>
      <div class="flex-btn">
         <a href="comptes_admin.php?delete=<?= $cherche_comptes['id']; ?>" onclick="return confirm('supprimer ce compte ?')" class="delete-btn">supprimer</a>
         <?php
            if($cherche_comptes['id'] == $id_admin){
               echo '<a href="mise_jour_profil.php" class="option-btn">modifier</a>';
            }
         ?>
      </div>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">aucun compte disponible!</p>';
      }
   ?>

   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>