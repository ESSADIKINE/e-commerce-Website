<?php

if(isset($_POST['add_to_wishlist'])){

   if($id_utilisateur == ''){
      header('location:utilisateur_login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $nom = $_POST['name'];
      $nom = filter_var($nom, FILTER_SANITIZE_STRING);
      $prix = $_POST['price'];
      $prix = filter_var($prix, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);

      $check_liste_souhait_némuro = $conn->prepare("SELECT * FROM `liste` WHERE nom = ? AND id_utilisateur = ?");
      $check_liste_souhait_némuro->execute([$nom, $id_utilisateur]);

      $check_panier_numbers = $conn->prepare("SELECT * FROM `panier` WHERE nom = ? AND id_utilisateur = ?");
      $check_panier_numbers->execute([$nom, $id_utilisateur]);

      if($check_liste_souhait_némuro->rowCount() > 0){
         $message[] = 'déjà ajouté à la liste de souhaits !';
      }elseif($check_panier_numbers->rowCount() > 0){
         $message[] = 'déjà ajouté au panier !';
      }else{
         $insert_wishlist = $conn->prepare("INSERT INTO `liste`(id_utilisateur, pid, nom, prix, image) VALUES(?,?,?,?,?)");
         $insert_wishlist->execute([$id_utilisateur, $pid, $nom, $prix, $image]);
         $message[] = 'ajouté à la liste de souhaits !';
      }

   }

}

if(isset($_POST['add_to_cart'])){

   if($id_utilisateur == ''){
      header('location:utilisateur_login.php');
   }else{

      $pid = $_POST['pid'];
      $pid = filter_var($pid, FILTER_SANITIZE_STRING);
      $nom = $_POST['name'];
      $nom = filter_var($nom, FILTER_SANITIZE_STRING);
      $prix = $_POST['price'];
      $prix = filter_var($prix, FILTER_SANITIZE_STRING);
      $image = $_POST['image'];
      $image = filter_var($image, FILTER_SANITIZE_STRING);
      $quantité = $_POST['qty'];
      $quantité = filter_var($quantité, FILTER_SANITIZE_STRING);

      $check_panier_numbers = $conn->prepare("SELECT * FROM `panier` WHERE nom = ? AND id_utilisateur = ?");
      $check_panier_numbers->execute([$nom, $id_utilisateur]);

      if($check_panier_numbers->rowCount() > 0){
         $message[] = 'déjà ajouté au panier !';
      }else{

         $check_liste_souhait_némuro = $conn->prepare("SELECT * FROM `liste` WHERE nom = ? AND id_utilisateur = ?");
         $check_liste_souhait_némuro->execute([$nom, $id_utilisateur]);

         if($check_liste_souhait_némuro->rowCount() > 0){
            $effacer_liste_souhaits = $conn->prepare("DELETE FROM `liste` WHERE nom = ? AND id_utilisateur = ?");
            $effacer_liste_souhaits->execute([$nom, $id_utilisateur]);
         }

         $ajouter_panier = $conn->prepare("INSERT INTO `panier`(id_utilisateur, pid, nom, prix, quantité, image) VALUES(?,?,?,?,?,?)");
         $ajouter_panier->execute([$id_utilisateur, $pid, $nom, $prix, $quantité, $image]);
         $message[] = 'ajouté au panier !';
         
      }

   }

}

?>