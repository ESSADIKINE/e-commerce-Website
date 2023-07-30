<?php

include '../composantes/connecter.php';

session_start();

$id_admin = $_SESSION['admin_id'];

if(!isset($id_admin)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $nom = $_POST['name'];
   $nom = filter_var($nom, FILTER_SANITIZE_STRING);

   $mise_jour_profil_name = $conn->prepare("UPDATE `admins` SET nom = ? WHERE id = ?");
   $mise_jour_profil_name->execute([$nom, $id_admin]);

   $vider_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass == $vider_pass){
      $message[] = 'veuillez saisir ancien mot de passe !';
   }elseif($old_pass != $prev_pass){
      $message[] = 'ancien mot de passe ne correspond pas !';
   }elseif($new_pass != $confirm_pass){
      $message[] = 'confirmer le mot de passe ne correspond pas !';
   }else{
      if($new_pass != $vider_pass){
         $mise_jour_pass_admin = $conn->prepare("UPDATE `admins` SET mot_de_pass = ? WHERE id = ?");
         $mise_jour_pass_admin->execute([$confirm_pass, $id_admin]);
         $message[] = 'Mot de passe mis à jour avec succès!';
      }else{
         $message[] = 'veuillez saisir un nouveau mot de passe !';
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
   <title>mettre à jour le profil</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>mettre à jour le profil</h3>
      <input type="hidden" name="prev_pass" value="<?= $chercher_profil['mot_de_pass']; ?>">
      <input type="text" name="name" value="<?= $chercher_profil['nom']; ?>" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="old_pass" placeholder="entrer l'ancien mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="Entrez un nouveau mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="confirm_pass" placeholder="confirmer le nouveau mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Mettez à jour maintenant" class="btn" name="submit">
   </form>

</section>


<script src="../js/admin_script.js"></script>
   
</body>
</html>