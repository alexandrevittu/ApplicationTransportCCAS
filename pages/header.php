<?php session_start(); ?>
<header>
  <link rel="stylesheet" href="style.css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <h1><a href="accueil.php" id="titre">Transport CCAS</a></h1>
  <form method="POST" action="deconnexion.php">
  <input class="btn btn-info" style="float:right;margin-right:40px;" type="submit" id="deconnexion" value="Se déconnecter">
  </form>
  <div id="logoTrnsport"><a href="accueil.php"><img src="../img/logo-LCA.png" alt="Logo application" id="logo"/></a></div>
  <?php
    if(isset($_SESSION['id']))
    {
        var_dump($_SESSION);
    }
    else {
      header('Location: connexion.php');
    }
   ?>
</header>
