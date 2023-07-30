<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
};

if(isset($_POST['submit'])){

   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_utilisateur = $conn->prepare("SELECT * FROM `utilisateurs` WHERE email = ? AND mot_de_pass = ?");
   $select_utilisateur->execute([$email, $pass]);
   $row = $select_utilisateur->fetch(PDO::FETCH_ASSOC);

   if($select_utilisateur->rowCount() > 0){
      $_SESSION['id_utilisateur'] = $row['id'];
      header('location:accuel.php');
   }else{
      $message[] = 'Identifiant ou mot de passe incorrect!';
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>connexion</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="form-container">

   <form action="" method="post">
      <h3>connectere-toi maintenant</h3>
      <input type="email" name="email" required placeholder="entrer votre email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="tapez votre mot de passe" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="se connecterer" class="btn" name="submit">
      <p>vous n'avez pas de compte ?</p>
      <a href="utilisateur_registre.php" class="option-btn">S'inscrire maintenant</a>
   </form>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>