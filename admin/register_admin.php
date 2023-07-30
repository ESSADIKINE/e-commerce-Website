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
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE nom = ?");
   $select_admin->execute([$nom]);

   if($select_admin->rowCount() > 0){
      $message[] = "nom d'utilisateur existe déjà!";
   }else{
      if($pass != $cpass){
         $message[] = 'confirmer le mot de passe ne correspond pas!';
      }else{
         $ajouter_admin = $conn->prepare("INSERT INTO `admins`(nom, mot_de_pass) VALUES(?,?)");
         $ajouter_admin->execute([$nom, $cpass]);
         $message[] = 'nouvel administrateur enregistré avec succès!';
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
   <title>s'inscrire admin</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>s'inscrire admin</h3>
      <input type="text" name="name" required placeholder="entrez votre nom d'utilisateur" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="tapez votre mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirmer votre mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="S'inscrire maintenant" class="btn" name="submit">
   </form>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>