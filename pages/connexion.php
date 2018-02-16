<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="style.css"/>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <h1><a href="accueil.php" id="titre">Transport PA CCAS</a></h1>
  <div id="logoTrnsport"><a href="accueil.php"><img src="../img/logo-LCA.png" alt="Logo application" id="logo"/></a></div>
  <style>
    #erreur{
      display: none;
    }
  </style>
</head>
<?php
 include_once "../fonctions/fonctions.php";
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

    </form>

    </div>
    <?php
    if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {

      $pass_hache = hash('sha256',$_POST['mdp']); // Hachage du mot de passe
      $pseudo = $_POST['pseudo'];
      $checkCompte = getCompte($pseudo,$pass_hache); //retourne booleen

      if (!$checkCompte) //check si le compte existe
      {
        echo '<style>#erreur{display:block;}</style>';
        echo '<script>document.getElementById("erreur").innerHTML = "Login ou mot de passe incorrect.";</script>'; //retourne message d'erreur si jamais le compte est associé  a personne
      }
      else
      {
          session_start();
          $_SESSION['id'] = $checkCompte['id'];  //ouvre une session grace a session_start()
          $_SESSION['pseudo'] = $pseudo;
          $_SESSION['nbLigne'] = -1;
          header('Location: PubliPostageCSV.php');

        }
    }

  ?>



</body>
</html>
