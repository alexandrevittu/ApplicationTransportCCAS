<!DOCTYPE html>
<html>
<head>
  <title>inscription</title>
  <link rel="stylesheet" href="style.css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <h1><a href="accueil.php" id="titre">Transport CCAS</a></h1>
  <div id="logoTrnsport"><a href="accueil.php"><img src="../img/logo-LCA.png" alt="Logo application" id="logo"/></a></div>
  <style>
    #erreur{
      display: none;
    }
  </style>
  <?php
  include_once "../fonctions/fonctions.php";
  ?>
</head>
<body>
  <form method="POST" id="inscriptionForm">
    <h2 style="text-align:center;color:#6FC6E4;">Inscription</h2>
    <hr class="style-ligne" id="ligne">
    <div class="logoUser">
      <img src="../img/logoUser.png" alt="logo" class="logo">
    </div>
    <div class="saisieUser">
      <label for="identifiant">Identifiant</label><br>
      <input type='text' name="nom" placeholder="Ex: Jean" required/></br>
      <label for="mdp">Mot de passe</label><br>
      <input type="password" name="mdp" required/></br>
      <label type="mdp2">Confirmer votre mot de passe</label><br>
      <input type="password" name="mdp2" required/></br>
      <label for="mail">Adresse Mail</label><br>
      <input type="text" name="mail" placeholder="Ex: exemple@exemple.fr" required /></br>
      <div class="alert alert-danger" id="erreur"></div>
      <button type="submit"/>Validez</button>

      </form>
      <form id=inscription action="connexion.php">
        <button >Retour</button>
      </form>
    </div>
  <?php
    if(isset($_POST['nom']) && isset($_POST['mdp']) && isset($_POST['mdp2']) && isset($_POST['mail']))
    {
      if($_POST['mdp']==$_POST['mdp2'])
      {
      inscription($_POST['nom'],$_POST['mdp'],$_POST['mail']);
      header('Location: connexion.php');
      }
      else
      {
        echo '<style>#erreur{display:block;}</style>';
        echo '<script>document.getElementById("erreur").innerHTML = "Mot de passe different.";</script>';
      }
    }
    ?>
</body>

</html>
