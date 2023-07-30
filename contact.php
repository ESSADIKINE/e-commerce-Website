<?php

include 'composantes/connecter.php';

session_start();

if(isset($_SESSION['id_utilisateur'])){
   $id_utilisateur = $_SESSION['id_utilisateur'];
}else{
   $id_utilisateur = '';
};

if(isset($_POST['send'])){

   $nom = $_POST['name'];
   $nom = filter_var($nom, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $Numéro = $_POST['number'];
   $Numéro = filter_var($Numéro, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);

   $select_message = $conn->prepare("SELECT * FROM `messages` WHERE nom = ? AND email = ? AND némuro = ? AND message = ?");
   $select_message->execute([$nom, $email, $Numéro, $msg]);

   if($select_message->rowCount() > 0){
      $message[] = 'message déjà envoyé!';
   }else{

      $ajouter_message = $conn->prepare("INSERT INTO `messages`(id_utilisateur, nom, email, némuro, message) VALUES(?,?,?,?,?)");
      $ajouter_message->execute([$id_utilisateur, $nom, $email, $Numéro, $msg]);

      $message[] = 'message envoyé avec succès!';

   }

}


?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Contactez</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'composantes/en-tête_utilisateur.php'; ?>

<section class="contact">

   <form action="" method="post">
      <h3>entrer en contact</h3>
      <input type="text" name="name" placeholder="entrez votre nom" required maxlength="20" class="box">
      <input type="email" name="email" placeholder="entrer votre email" required maxlength="50" class="box">
      <input type="number" name="number" min="0" max="9999999999" placeholder="entrez votre numéro" required onkeypress="if(this.value.length == 10) return false;" class="box">
      <textarea name="msg" class="box" placeholder="entrez votre message" cols="30" rows="10"></textarea>
      <input type="submit" value="envoyer le message" name="send" class="btn">
   </form>

</section>

<?php include 'composantes/bas_page.php'; ?>

<script src="js/script.js"></script>

</body>
</html>