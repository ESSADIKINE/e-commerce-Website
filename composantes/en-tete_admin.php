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

      <a href="../admin/tableau_bord.php" class="logo"><span>Panneau d'</span>Admin</a>

      <nav class="navbar">
         <a href="../admin/tableau_bord.php">accueil</a>
         <a href="../admin/produits.php">produits</a>
         <a href="../admin/commandes_passées.php">ordres</a>
         <a href="../admin/comptes_admin.php">admins</a>
         <a href="../admin/comptes_utilisateur.php">utilisateurs</a>
         <a href="../admin/messages.php">messages</a>
      </nav>
      
      <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
      <a href="admin_login.php"><div id="user-btn" class="fas fa-user"></div></a>
      <a href="../composantes/admin_logout.php" ><div class="fa fa-sign-out"></div></a>
      </div>

      <div class="profile">
         <?php
            $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
            $select_profile->execute([$id_admin]);
            $chercher_profil = $select_profile->fetch(PDO::FETCH_ASSOC);
         ?>
         <p><?= $chercher_profil['nom']; ?></p>
         <a href="../admin/mise_jour_profil.php" class="btn">mettre à jour le profil</a>
         <div class="flex-btn">
            <a href="../admin/register_admin.php" class="option-btn">S'inscrire</a>
            <a href="../admin/admin_login.php" class="option-btn">connexion</a>
         </div>
         <a href="../composantes/admin_logout.php" class="delete-btn" onclick="return confirm('se déconnecterer du site ?');">Se déconnecterer</a> 
      </div>

   </section>

</header>