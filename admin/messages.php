<?php

include '../composantes/connecter.php';

session_start();

$id_admin = $_SESSION['admin_id'];

if(!isset($id_admin)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $effacer_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$effacer_id]);
   header('location:messages.php');
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>messages</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <link rel="stylesheet" href="../css/admin_style.css">

</head>
<body>

<?php include '../composantes/en-tete_admin.php'; ?>

<section class="contacts">

<h1 class="heading">messages</h1>

<div class="box-container">

   <?php
      $select_messages = $conn->prepare("SELECT * FROM `messages`");
      $select_messages->execute();
      if($select_messages->rowCount() > 0){
         while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
   ?>
   <div class="box">
   <p> id d'utilisateur : <span><?= $fetch_message['id_utilisateur']; ?></span></p>
   <p> nom d'utilisateur : <span><?= $fetch_message['nom']; ?></span></p>
   <p> email : <span><?= $fetch_message['email']; ?></span></p>
   <p> numéro : <span><?= $fetch_message['némuro']; ?></span></p>
   <p> message : <span><?= $fetch_message['message']; ?></span></p>
   <a href="messages.php??delete=<?= $fetch_message['id']; ?>" onclick="return confirm('supprimer ce message?');" class="delete-btn">supprimer</a>
   </div>
   <?php
         }
      }else{
         echo '<p class="empty">pas de messages</p>';
      }
   ?>

</div>

</section>

<script src="../js/admin_script.js"></script>
   
</body>
</html>