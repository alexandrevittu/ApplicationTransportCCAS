<!DOCTYPE html>
<html>
<head>
<title>Modif mot de passe</title>
<?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";  //inclut l'en-tete
  $uti = getcompteutilisateur($_POST['id']);
  $id = $uti['id'];
?>
</head>
<body>
  <div id="conteneur">
  <h2 style="text-align:center;">Modification mot de passe</h2>
  <form method="POST" style=";margin:0 auto;padding-top:15px;text-align:center;" id="ajoutadherent">
    <?php
    echo '<label>Utilisateur selectionné : '.$uti['Pseudo'].'</label><br>';
    echo '<label>Nouveau mot de passe : </label><br>';
    echo '<input type="hidden" name="id" value='.$id.'/>';
     ?>
     <input type="password" size="10px;" style="padding:5px;" name="mdp" required/></br>
     <input type="submit" value="Valider"/>
  </form>
</div>
  <?php
  if(isset($_POST['mdp']))
  {
      if(Modifmdp($_POST['mdp'],$_POST['id']))
      {
        echo"<script>alert('Votre mot de passe a été modifié !');";
        echo "window.location.href='gestionCompte.php';";
        echo "</script>";
      }
      else
      {
        echo"<script>alert('Vous avez entré le même mot de passe.');</script>";
      }
    }
    else
    {

    }
?>
  <form action="gestionCompte.php" style="text-align:center;">
    <input type="submit" value="Annuler" id="btn_ajout2"/>
  </form>
</body>

</html>
