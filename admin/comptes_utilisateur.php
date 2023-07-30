<?php

include '../composantes/connecter.php';

session_start();

$id_admin = $_SESSION['admin_id'];

if(!isset($id_admin)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $effacer_id = $_GET['delete'];
   $effacer_utilisateurs = $conn->prepare("DELETE FROM `utilisateurs` WHERE id = ?");
   $effacer_utilisateurs->execute([$effacer_id]);
   $effacer_ordress = $conn->prepare("DELETE FROM `ordres` WHERE id_utilisateur = ?");
   $effacer_ordress->execute([$effacer_id]);
   $effacer_messages = $conn->prepare("DELETE FROM `messages` WHERE id_utilisateur = ?");
   $effacer_messages->execute([$effacer_id]);
   $supprimer_panier = $conn->prepare("DELETE FROM `panier` WHERE id_utilisateur = ?");
   $supprimer_panier->execute([$effacer_id]);
   $effacer_liste_souhaits = $conn->prepare("DELETE FROM `liste` WHERE id_utilisateur = ?");
   $effacer_liste_souhaits->execute([$effacer_id]);
   header('location:comptes_utilisateur.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>comptes utilisateur</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="accounts">

   <h1 class="heading">comptes utilisateur</h1>

   <div class="box-container">

   <?php
      $select_comptes = $conn->prepare("SELECT * FROM `utilisateurs`");
      $select_comptes->execute();
      if($select_comptes->rowCount() > 0){
         while($cherche_comptes = $select_comptes->fetch(PDO::FETCH_ASSOC)){   
   ?>
   <div class="box">
      <p>id d'utilisateur : <span><?= $cherche_comptes['id']; ?></span> </p>
      <p> Nom d'utilisateur : <span><?= $cherche_comptes['nom']; ?></span> </p>
      <p> email : <span><?= $cherche_comptes['email']; ?></span> </p>
      <a href="comptes_utilisateur.php?delete=<?= $cherche_comptes['id']; ?>" onclick="return confirm('supprimer ce compte ? les informations relatives à utilisateur seront également supprimées !')" class="delete-btn">supprimer</a>
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