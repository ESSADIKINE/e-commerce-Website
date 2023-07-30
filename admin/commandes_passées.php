<?php

include '../composantes/connecter.php';

session_start();

$id_admin = $_SESSION['admin_id'];

if(!isset($id_admin)){
   header('location:admin_login.php');
}

if(isset($_POST['update_payment'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `ordres` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'statut de paiement mis à jour !';
}

if(isset($_GET['delete'])){
   $effacer_id = $_GET['delete'];
   $effacer_ordres = $conn->prepare("DELETE FROM `ordres` WHERE id = ?");
   $effacer_ordres->execute([$effacer_id]);
   header('location:commandes_passées.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>commandes passées</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="orders">

<h1 class="heading">commandes passées</h1>

<div class="box-container">

   <?php
      $select_ordres = $conn->prepare("SELECT * FROM `ordres`");
      $select_ordres->execute();
      if($select_ordres->rowCount() > 0){
         while($chercher_ordres = $select_ordres->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
      <p> placé sur : <span><?= $chercher_ordres['date_commande']; ?></span> </p>
      <p> nom : <span><?= $chercher_ordres['nom']; ?></span> </p>
      <p> numéro : <span><?= $chercher_ordres['némuro']; ?></span> </p>
      <p> adresse : <span><?= $chercher_ordres['address']; ?></span> </p>
      <p> produits totaux : <span><?= $chercher_ordres['total_produit']; ?></span> </p>
      <p> prix total : <span><?= $chercher_ordres['total_prix']; ?>Dh</span> </p>
      <p> mode de paiement : <span><?= $chercher_ordres['method']; ?></span> </p>
      <form action="" method="post">
         <input type="hidden" name="order_id" value="<?= $chercher_ordres['id']; ?>">
         <select name="payment_status" class="select">
            <option selected disabled><?= $chercher_ordres['payment_status']; ?></option>
            <option value="en attendant">en attendant</option>
            <option value="complété">complété</option>
         </select>
        <div class="flex-btn">
         <input type="submit" value="modifier" class="option-btn" name="update_payment">
         <a href="commandes_passées.php?delete=<?= $chercher_ordres['id']; ?>" class="delete-btn" onclick="return confirm('supprimer cette commande?');">supprimer</a>
        </div>
      </form>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">pas encore de commandes passées!</p>';
      }
   ?>

</div>

</section>


<script src="../js/admin_script.js"></script>
   
</body>
</html>
