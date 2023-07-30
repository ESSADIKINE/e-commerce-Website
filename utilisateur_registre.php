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
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_utilisateur = $conn->prepare("SELECT * FROM `utilisateurs` WHERE email = ?");
   $select_utilisateur->execute([$email,]);
   $row = $select_utilisateur->fetch(PDO::FETCH_ASSOC);

   if($select_utilisateur->rowCount() > 0){
      $message[] = 'email existe déjà!';
   }else{
      if($pass != $cpass){
         $message[] = 'Confirmer le mot de passe ne correspond pas!';
      }else{
         $ajouter_utilisateur = $conn->prepare("INSERT INTO `utilisateurs`(nom, email, mot_de_pass) VALUES(?,?,?)");
         $ajouter_utilisateur->execute([$nom, $email, $cpass]);
         $message[] = "enregistré avec succès, connectez-vous maintenant s'il vous plaît!";
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
      <h3>S'inscrire maintenant</h3>
      <input type="text" name="name" required placeholder="entrez votre nom d'utilisateur" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="entrer votre email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="tapez votre mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirmer votre mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="S'inscrire maintenant" class="btn" name="submit">
      <p>Vous avez déjà un compte?</p>
      <a href="utilisateur_login.php" class="option-btn">se connecterer</a>
   </form>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>