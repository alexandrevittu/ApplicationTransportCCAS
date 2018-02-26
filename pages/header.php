<?php session_start();
 ?>
<header>
  <link rel="stylesheet" href="style.css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <h1><a href="accueil.php" id="titre">Transport PA CCAS</a></h1>
  <button type="submit" id="deconnexion" onclick="window.location='deconnexion.php';">Se déconnecter</button>
  <div id="logoTrnsport">
    <a href="accueil.php"><img src="../img/logo-LCA.png" alt="Logo application" id="logo"/></a>
  </div>
  <?php
    if($_SESSION['id']==1)
    {
      ?>
      <div class="saisieUser">
        <button id="gestioncompte" type="submit" onclick="window.location='gestionCompte.php';">Gestion des compte</button>
        <button id="inscription" onclick="window.location='inscription.php';">Inscription</button>
      </div>
      <?php
      $date = date('d/m/Y');
      echo '<h3>'.$date.'</h3>';
       ?>
      <?php
    }
    elseif($_SESSION['id']>1)
    {

    }
    else {
      header('Location: connexion.php');
    }
   ?>
<script>
    setTimeout("window.location='deconnexion.php'",7200000);
</script>
</header>
