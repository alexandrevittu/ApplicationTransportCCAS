<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="style.css"/>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <title>Transport CCAS</title>
  <div id="logoTrnsport"><a href="accueil.php"><img src="../img/logo-LCA.png" alt="Logo application" id="logo"/></a></div>
  <meta http-equiv=”refresh” content="5"/>
  <style>
    #erreur{
      display: none;
    }
  </style>
</head>
<?php

include_once "../fonctions/fonctions.php";  //inclut l'en-tete
?>

<body>

    <form id=connexionForm method="POST" action="">
      <h2 style="text-align:center;color:#6FC6E4;">Connexion</h2>
      <hr class="style-ligne" id="ligne">
      <div class="logoUser">
        <img src="../img/logoUser.png" alt="logo" class="logo">
      </div>
      <div class="saisieUser">
        <label><b>Login</b></label><br>
        <input type="text" placeholder="Enter votre nom d'utilisateur" name="pseudo" required><br>
        <label><b>Mot de passe</b></label><br>
        <input type="password" placeholder="Entrer le mot de passe" name="mdp" required><br>
        <div class="alert alert-danger" id="erreur"></div>
        <button type="submit">Se connecter</button>
        <input
      </div>
    </form>
    <div class="saisieUser">
    <button type="button" class="btn btn-danger" onclick="history.go(-1);">retour</button>
    </div>
    <?php
    if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {

      $pass_hache = hash('sha256',$_POST['mdp']); // Hachage du mot de passe
      $pseudo = $_POST['pseudo'];
      $checkCompte = getCompte($pseudo,$pass_hache);

      if (!$checkCompte)
      {
        echo '<style>#erreur{display:block;}</style>';
        echo '<script>document.getElementById("erreur").innerHTML = "Login ou mot de passe incorrecte.";</script>';
      }
      else
      {
          session_start();
          $_SESSION['id'] = $checkCompte['id'];
          $_SESSION['pseudo'] = $pseudo;
          header('Location: accueil.php');
        }
    }
    ?>
</body>
</html>
