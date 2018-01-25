<!DOCTYPE html>
<html>
<head>
  <title>inscription</title>
  <link rel="stylesheet" href="style.css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <h1><a href="accueil.php" id="titre">Transport CCAS</a></h1>
  <div id="logoTrnsport"><a href="accueil.php"><img src="../img/logo-LCA.png" alt="Logo application" id="logo"/></a></div>
  <?php
  include_once "../fonctions/fonctions.php";
  ?>
</head>
<body>
  <form method="POST" style='width: 70%;margin:5% 35%'>
    <label for="identifiant">identifiant :</label>
    <input type='text' name="nom" required/></br>
    <label for="mdp">Mot de passe :</label>
    <input type="password" name="mdp" required/></br>
    <label type="mdp2">Confirmer votre mot de passe :</label>
    <input type="password" name="mdp2" required/></br>
    <label for="mail">mail :</label>
    <input type="text" name="mail" required /></br>
    <input class="btn btn-info" type="submit" value="Valider"/>
  </form>
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
        echo 'mdp different';
      }
    }
    ?>
</body>

</html>
