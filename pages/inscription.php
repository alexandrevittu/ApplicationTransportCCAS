<!DOCTYPE html>
<html>
<head>
  <title>inscription</title>
  <?php
  include_once "header.php";
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
      }
      else
      {
        echo 'mdp different';
      }
    }
    ?>
</body>

</html>
