<?php

include '../composantes/connecter.php';

session_start();

$id_admin = $_SESSION['admin_id'];

if(!isset($id_admin)){
   header('location:admin_login.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>tableau de bord</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="dashboard">

   <h1 class="heading">tableau de bord</h1>

   <div class="box-container">

      <div class="box">
         <h3>bienvenu!</h3>
         <p><?= $chercher_profil['nom']; ?></p>
         <a href="mise_jour_profil.php" class="btn">mettre à jour le profil</a>
      </div>

      <div class="box">
         <?php
            $total_pendings = 0;
            $select_pendings = $conn->prepare("SELECT * FROM `ordres` WHERE payment_status = ?");
            $select_pendings->execute(['en attendant']);
            if($select_pendings->rowCount() > 0){
               while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                  $total_pendings += $fetch_pendings['total_prix'];
               }
            }
         ?>
         <h3><span></span><?= $total_pendings; ?> Dh</h3>
         <p>commandes en attentes</p>
         <a href="commandes_passées.php" class="btn">voir les commandes</a>
      </div>

      <div class="box">
         <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `ordres` WHERE payment_status = ?");
            $select_completes->execute(['completé']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_prix'];
               }
            }
         ?>
         <h3><span></span><?= $total_completes; ?> Dh</h3>
         <p>commandes terminées</p>
         <a href="commandes_passées.php" class="btn">voir les commandes</a>
      </div>

      <div class="box">
         <?php
            $select_ordres = $conn->prepare("SELECT * FROM `ordres`");
            $select_ordres->execute();
            $Némuro_ordres = $select_ordres->rowCount()
         ?>
         <h3><?= $Némuro_ordres; ?></h3>
         <p>commandes passées</p>
         <a href="commandes_passées.php" class="btn">voir les commandes</a>
      </div>

      <div class="box">
         <?php
            $select_produit = $conn->prepare("SELECT * FROM `produits`");
            $select_produit->execute();
            $Numéro_prodiuts = $select_produit->rowCount()
         ?>
         <h3><?= $Numéro_prodiuts; ?></h3>
         <p>produits ajoutés</p>
         <a href="produits.php" class="btn">voir les produits</a>
      </div>

      <div class="box">
         <?php
            $select_utilisateurs = $conn->prepare("SELECT * FROM `utilisateurs`");
            $select_utilisateurs->execute();
            $Numéro_of_users = $select_utilisateurs->rowCount()
         ?>
         <h3><?= $Numéro_of_users; ?></h3>
         <p>utilisateurs normaux</p>
         <a href="comptes_utilisateur.php" class="btn">voir les utilisateurs</a>
      </div>

      <div class="box">
         <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $Numéro_admins = $select_admins->rowCount()
         ?>
         <h3><?= $Numéro_admins; ?></h3>
         <p>utilisateurs admins</p>
         <a href="comptes_admin.php" class="btn">voir les admins</a>
      </div>

      <div class="box">
         <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
           $Numéro_messages = $select_messages->rowCount()
         ?>
         <h3><?=$Numéro_messages; ?></h3>
         <p>nouveaux messages</p>
         <a href="messages.php" class="btn">voir les messages</a>
      </div>

   </div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>