<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
   header('location:utilisateur_login.php');
};

if(isset($_POST['order'])){

   $nom = $_POST['name'];
   $nom = filter_var($nom, FILTER_SANITIZE_STRING);
   $Numéro = $_POST['number'];
   $Numéro = filter_var($Numéro, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $method = $_POST['method'];
   $method = filter_var($method, FILTER_SANITIZE_STRING);
   $address = 'Numéro appartement . '. $_POST['flat'] .', rue '. $_POST['street'] .', ville '. $_POST['city'] .', region '. $_POST['state'] .', '. $_POST['country'] .' - '. $_POST['pin_code'];
   $address = filter_var($address, FILTER_SANITIZE_STRING);
   $total_produits = $_POST['total_products'];
   $total_prix = $_POST['total_price'];

   $check_panier = $conn->prepare("SELECT * FROM `panier` WHERE id_utilisateur = ?");
   $check_panier->execute([$id_utilisateur]);

   if($check_panier->rowCount() > 0){

      $ajouter_panier = $conn->prepare("INSERT INTO `ordres`(id_utilisateur, nom, némuro, email, method, address, total_produit, total_prix) VALUES(?,?,?,?,?,?,?,?)");
      $ajouter_panier->execute([$id_utilisateur, $nom, $Numéro, $email, $method, $address, $total_produits, $total_prix]);

      $supprimer_panier = $conn->prepare("DELETE FROM `panier` WHERE id_utilisateur = ?");
      $supprimer_panier->execute([$id_utilisateur]);

      $message[] = 'commande passée avec succès !';
   }else{
      $message[] = 'Votre panier est vide';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>vérifier</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="checkout-orders">

   <form action="" method="POST">

   <h3>vos commandes</h3>

      <div class="display-orders">
      <?php
         $grand_total = 0;
         $panier_élements[] = '';
         $select_panier = $conn->prepare("SELECT * FROM `panier` WHERE id_utilisateur = ?");
         $select_panier->execute([$id_utilisateur]);
         if($select_panier->rowCount() > 0){
            while($chercher_panier = $select_panier->fetch(PDO::FETCH_ASSOC)){
               $panier_élements[] = $chercher_panier['nom'].' ('.$chercher_panier['prix'].' x '. $chercher_panier['quantité'].') - ';
               $total_produits = implode($panier_élements);
               $grand_total += ($chercher_panier['prix'] * $chercher_panier['quantité']);
      ?>
         <p> <?= $chercher_panier['nom']; ?> <span>(<?= $chercher_panier['prix'].'Dh x '. $chercher_panier['quantité']; ?>)</span> </p>
      <?php
            }
         }else{
            echo '<p class="empty">Votre panier est vide!</p>';
         }
      ?>
         <input type="hidden" name="total_products" value="<?= $total_produits; ?>">
         <input type="hidden" name="total_price" value="<?= $grand_total; ?>" value="">
         <div class="grand-total">total : <span><?= $grand_total; ?>Dh</span></div>
      </div>

      <h3>passez vos commandes</h3>

      <div class="flex">
         <div class="inputBox">
            <span>votre nom :</span>
            <input type="text" name="name" placeholder="entrez votre nom" class="box" maxlength="20" required>
         </div>
         <div class="inputBox">
            <span>téléphone :</span>
            <input type="number" name="number" placeholder="entrez votre numéro" class="box" min="0" max="9999999999" onkeypress="if(this.value.length == 10) return false;" required>
         </div>
         <div class="inputBox">
            <span>votre email :</span>
            <input type="email" name="email" placeholder="entrer votre email" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>mode de paiement :</span>
            <select name="method" class="box" required>
               <option value="paiement à la livraison">paiement à la livraison</option>
               <option value="Carte de crédit">Carte de crédit</option>
               <option value="paypal">paypal</option>
            </select>
         </div>
         <div class="inputBox">
            <span>adresse ligne 01 :</span>
            <input type="text" name="flat" placeholder="ex : numéro d'appartement" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>adresse ligne 02 :</span>
            <input type="text" name="street" placeholder="ex : nom de rue" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>ville :</span>
            <input type="text" name="city" placeholder="ex : casablanca" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>Région :</span>
            <input type="text" name="state" placeholder="ex : casablanca-settat" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>pays :</span>
            <input type="text" name="country" placeholder="ex : Maroc" class="box" maxlength="50" required>
         </div>
         <div class="inputBox">
            <span>code PIN :</span>
            <input type="number" min="0" name="pin_code" placeholder="ex : 123456" min="0" max="999999" onkeypress="if(this.value.length == 6) return false;" class="box" required>
         </div>
      </div>

      <input type="submit" name="order" class="btn  <?= ($grand_total > 1)?'':'disabled'; ?>" value="Passer la commande">

   </form>
</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>