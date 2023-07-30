<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
};

if(isset($_POST['submit'])){

   $nom = $_POST['name'];
   $nom = filter_var($nom, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);

   $mise_jour_profil = $conn->prepare("UPDATE `utilisateurs` SET name = ?, email = ? WHERE id = ?");
   $mise_jour_profil->execute([$nom, $email, $id_utilisateur]);

   $vider_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   if($old_pass == $vider_pass){
      $message[] = 'Veuillez saisir l ancien mot de passe!';
   }elseif($old_pass != $prev_pass){
      $message[] = 'Ancien mot de passe ne correspond pas!';
   }elseif($new_pass != $cpass){
      $message[] = 'confirmer le mot de passe ne correspond pas !';
   }else{
      if($new_pass != $vider_pass){
         $mise_jour_pass_admin = $conn->prepare("UPDATE `utilisateurs` SET password = ? WHERE id = ?");
         $mise_jour_pass_admin->execute([$cpass, $id_utilisateur]);
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
   <title>S'inscrire</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>Mettez à jour maintenant</h3>
      <input type="hidden" name="prev_pass" value="<?= $chercher_profil["password"]; ?>">
      <input type="text" name="name" required placeholder="entrez votre nom d'utilisateur" maxlength="20"  class="box" value="<?= $chercher_profil["name"]; ?>">
      <input type="email" name="email" required placeholder="entrer votre email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')" value="<?= $chercher_profil["email"]; ?>">
      <input type="password" name="old_pass" placeholder="entrez votre ancien mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="new_pass" placeholder="entrez votre nouveau mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" placeholder="confirmer votre nouveau mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="Mettez à jour maintenant" class="btn" name="submit">
   </form>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>