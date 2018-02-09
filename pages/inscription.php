<!DOCTYPE html>
<html>
<head>
  <title>inscription</title>
  <style>
    #erreur{
      display: none;
    }
  </style>
  <?php
  include_once "header.php";

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
      <form action="accueil.php">
        <button >Retour</button>
      </form>
    </div>
  <?php
    if(isset($_POST['nom']) && isset($_POST['mdp']) && isset($_POST['mdp2']) && isset($_POST['mail']))
    {
      if($_POST['mdp']==$_POST['mdp2'])
      {
        if(inscription($_POST['nom'],$_POST['mdp'],$_POST['mail']))
          {
            header('Location: accueil.php');
          }
          else
          {
            echo '<style>#erreur{display:block;}</style>';
            echo '<script>document.getElementById("erreur").innerHTML = "Identifiant ou mail deja existant.";</script>';
          }
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
