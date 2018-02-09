<?php session_start();
 ?>
<header>
  <link rel="stylesheet" href="style.css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <h1><a href="accueil.php" id="titre">Transport Personne Agée</a></h1>
  <button type="submit" id="deconnexion" onclick="window.location='deconnexion.php';">Se déconnecter</button>
  <button id="gestioncompte" type="submit" onclick="window.location='gestionCompte.php';">Gestion du compte</button>
  <div id="logoTrnsport">
    <a href="accueil.php"><img src="../img/logo-LCA.png" alt="Logo application" id="logo"/></a>
  </div>
  <?php
    if($_SESSION['id']==1)
    {
      ?>
      <div class="saisieUser">
        <button id="inscription" onclick="window.location='inscription.php';">Inscription</button>
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
