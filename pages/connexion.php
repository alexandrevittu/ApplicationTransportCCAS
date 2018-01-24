<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="style.css"/>
  <title>Transport CCAS</title>
  <meta http-equiv=”refresh” content="5"/>
</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";  //inclut l'en-tete
?>
<body>
  <h2>Connexion</h2>
    <form id=connexionForm method="POST" action="verifConnexion.php">
      <div class="logoUser">
        <img src="../img/logoUser.png" alt="logo" class="logo">
      </div>
      <div class="saisieUser">
        <label><b>Login</b></label><br>
        <input type="text" placeholder="Enter votre nom d'utilisateur" name="pseudo" required><br>

        <label><b>Mot de passe</b></label><br>
        <input type="password" placeholder="Entrer le mot de passe" name="mdp" required><br>

        <button type="submit">Se connecter</button>
      </div>
    </form>
    <div class="saisieUser">
    <button type="button" class="btn btn-danger" onclick="history.go(-1);">Retour</button>
    </div>
</body>
</html>
