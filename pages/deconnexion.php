<?php
session_start();
session_destroy();  //detruit la session est retourne vers accueil
header('Location: accueil.php');

 ?>
