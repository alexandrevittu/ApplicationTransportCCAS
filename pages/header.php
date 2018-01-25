<?php session_start(); ?>
<header>
  <link rel="stylesheet" href="style.css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <h1><a href="accueil.php" id="titre">Transport CCAS</a></h1>
  <form  id="deconnexionForm" method="POST" action="deconnexion.php">
  <input type="submit" id="deconnexion" value="Se déconnecter">
  </form>
  <form action="gestionCompte.php" action="POST">
  <button id="gestioncompte"  type="submit">Gestion du compte</button>
  </form>
  <div id="logoTrnsport"><a href="accueil.php"><img src="../img/logo-LCA.png" alt="Logo application" id="logo"/></a></div>
  <?php

    if($_SESSION['id']==1)
    {
      ?>
      <div class="saisieUser">
      <form    action="inscription.php">
        <button id="inscription">Inscription</button>
      </form>
    </div>
      <?php
    }
    elseif($_SESSION['id']>1)
    {

    }
    else {
      header('Location: connexion.php');
    }
   ?>
</header>
