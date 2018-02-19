<!DOCTYPE html>
<html>
<head>
<title>Modif mot de passe</title>
<?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";  //inclut l'en-tete
  $uti = getcompteutilisateur($_POST['id']);
  $id = $uti['id'];
  $oldmdp = $uti['Mdp'];
?>
<script>
  function affichernewmdp() {
      var x = document.getElementById("newmdp");
      if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }
    function afficheroldmdp()
    {
      var x = document.getElementById("oldmdp");
      if (x.type === "password") {
          x.type = "text";
        } else {
          x.type = "password";
        }
      }

</script>
</head>
<body>
  <div id="conteneur">
  <h2 style="text-align:center;">Modification mot de passe</h2>
  <form method="POST" style=";margin:0 auto;padding-top:15px;text-align:center;" id="ajoutadherent">
    <?php
    echo '<label>Utilisateur selectionné : '.$uti['Pseudo'].'</label><br>';
    echo '<label>Saisir le mot de passe actuel : </label><br>';
    echo '<input type="password" size="10px;" style="padding:5px;" name="saisieoldmdp" id="oldmdp" required/>';
    echo '<input type="checkbox" onclick="afficheroldmdp()"> Afficher le mot de passe<br>';
    echo '<label>Nouveau mot de passe : </label><br>';
    echo '<input type="hidden" name="oldmdp" value='.$oldmdp.'>';
    echo '<input type="hidden" name="id" value='.$id.'/>';
     ?>
     <input type="password" size="10px;" style="padding:5px;" name="mdp" id="newmdp" required/>
     <input type="checkbox" onclick="affichernewmdp()"> Afficher le mot de passe</br>
     <input type="submit" value="Valider"/>
  </form>
</div>
  <?php
  if(isset($_POST['mdp']))
  {
    $saisieoldmdp = hash('sha256',$_POST['saisieoldmdp']);
    if($saisieoldmdp == $_POST['oldmdp'])
    {
      if(Modifmdp($_POST['mdp'],$_POST['id']))
      {
        echo"<script>alert('Le mot de passe a été modifié !');";
        echo "window.location.href='gestionCompte.php';";
        echo "</script>";
      }
    }
    else
    {
      echo"<script>alert('mot de passe actuel incorrect !');";
      echo "</script>";
    }
  }
?>
  <form action="gestionCompte.php" style="text-align:center;">
    <input type="submit" value="Annuler" id="btn_ajout2"/>
  </form>
</body>

</html>
