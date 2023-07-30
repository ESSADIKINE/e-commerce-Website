<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<header class="header">

   <section class="flex">

      <a href="accuel.php" class="logo">FST <span>tech</span></a>

      <nav class="navbar">
         <a href="accuel.php">accueil</a>
         <a href="a_propos.php">à propos</a>
         <a href="ordres.php">ordres</a>
         <a href="magasin.php">magasin</a>
         <a href="contact.php">contactez</a>
      </nav>

      <div class="icons">
         <?php
            $count_elements_liste_souhaite = $conn->prepare("SELECT * FROM `liste` WHERE id_utilisateur = ?");
            $count_elements_liste_souhaite->execute([$id_utilisateur]);
            $total_liste_souhait_counts = $count_elements_liste_souhaite->rowCount();

            $count_element_panier = $conn->prepare("SELECT * FROM `panier` WHERE id_utilisateur = ?");
            $count_element_panier->execute([$id_utilisateur]);
            $total_panier_counts = $count_element_panier->rowCount();
         ?>
         <div id="menu-btn" class="fas fa-bars"></div>
         <a href="page_recherche.php"><i class="fas fa-search"></i></a>
         <a href="liste_souhaits.php"><i class="fas fa-heart"></i><span>(<?= $total_liste_souhait_counts; ?>)</span></a>
         <a href="panier.php"><i class="fas fa-shopping-cart"></i><span>(<?= $total_panier_counts; ?>)</span></a>
         <a href="utilisateur_login.php"><div id="user-btn" class="fas fa-user"></div></a>
         <a href="composantes/utilisateur_logout.php"><i class="fa fa-sign-out"></i></a>
      </div>

      <div class="profile">
         <?php          
            $select_profile = $conn->prepare("SELECT * FROM `utilisateurs` WHERE id = ?");
            $select_profile->execute([$id_utilisateur]);
            if($select_profile->rowCount() > 0){
            $chercher_profil = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $chercher_profil["name"]; ?></p>
         <a href="mise_jour_utilisateurs.php" class="btn">mettre à jour le profil</a>
         <div class="flex-btn">
            <a href="utilisateur_registre.php" class="option-btn">S'inscrire</a>
            <a href="utilisateur_login.php" class="option-btn">connexion</a>
         </div>
         <a href="composantes/utilisateur_logout.php" class="delete-btn" onclick="return confirm('se déconnecterer du site ?');">Se déconnecterer</a> 
         <?php
            }else{
         ?>
         <p>connecterez-vous ou inscrivez-vous d'abord s'il vous plaît!</p>
         <div class="flex-btn">
            <a href="utilisateur_registre.php" class="option-btn">S'inscrire</a>
            <a href="utilisateur_login.php" class="option-btn">connexion</a>
         </div>
         <?php
            }
         ?>      
         
         
      </div>

   </section>

</header>