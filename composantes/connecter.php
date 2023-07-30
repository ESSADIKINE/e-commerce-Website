<?php

$nom_database = 'mysql:host=localhost;dbname=shop';
$nom_utilisateur = 'root';
$mot_pass_utilisateur = '';

$conn = new PDO($nom_database, $nom_utilisateur, $mot_pass_utilisateur);

?>