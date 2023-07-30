<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
};

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>commandes</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="orders">

   <h1 class="heading">commandes passées</h1>

   <div class="box-container">

   <?php
      if($id_utilisateur == ''){
         echo '<p class="empty">veuillez vous connecterer pour voir vos commandes</p>';
      }else{
         $select_ordres = $conn->prepare("SELECT * FROM `ordres` WHERE id_utilisateur = ?");
         $select_ordres->execute([$id_utilisateur]);
         if($select_ordres->rowCount() > 0){
            while($chercher_ordres = $select_ordres->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p>placé sur : <span><?= $chercher_ordres['date_commande']; ?></span></p>
      <p>Nom : <span><?= $chercher_ordres['nom']; ?></span></p>
      <p>email : <span><?= $chercher_ordres['email']; ?></span></p>
      <p>Numéro : <span><?= $chercher_ordres['némuro']; ?></span></p>
      <p>adresse : <span><?= $chercher_ordres['address']; ?></span></p>
      <p>mode de paiement : <span><?= $chercher_ordres['method']; ?></span></p>
      <p>vos commandes : <span><?= $chercher_ordres['total_produit']; ?></span></p>
      <p>prix total : <span><?= $chercher_ordres['total_prix']; ?>Dh</span></p>
      <p> statut de paiement : <span style="color:<?php if($chercher_ordres['payment_status'] == 'pending'){ echo 'red'; }else{ echo 'green'; }; ?>"><?= $chercher_ordres['payment_status']; ?></span> </p>
   </div>
   <?php
      }
      }else{
         echo '<p class="empty">pas encore de commandes passées!</p>';
      }
      }
   ?>

   </div>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>