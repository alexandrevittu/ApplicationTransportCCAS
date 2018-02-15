<!DOCTYPE html>
<html>
<head>
<title>Modif pseudo</title>
<?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";  //inclut l'en-tete
  $uti = getcompteutilisateur($_POST['id']);
  $id = $uti['id'];
?>
</head>
<body>
 <h2 style="text-align:center;">Modification identifiant</h2>
 <form method="POST" style=";margin:0 auto;padding-top:15px;text-align:center;">
   <?php
   echo '<label>Utilisateur selectionné : '.$uti['Pseudo'].'</label><br>';
   echo '<label>Nouvel identifiant : </label><br>';
   echo '<input type="hidden" name="id" value='.$id.'/>';
    ?>
   <input type="text" name="pseudo"  required/></br>
   <input class="btn btn-info" type="submit" value="valider"/>
 </form>
 <?php
 if(isset($_POST['pseudo']))
 {
     if(Modifpseudo($_POST['pseudo'],$_POST['id']))
     {
       echo"<script>alert('Votre identifiant a été modifié !');";
       echo "window.location.href='gestionCompte.php';";
       echo "</script>";
     }
     else
     {
       echo"<script>alert('Cet identifiant est déjà utilisé.');</script>";
     }
 }
 else
 {
 }
 ?>
 <form action="gestionCompte.php" style="text-align:center;">
  <input type="submit" value="Annuler" class="btn btn-info"/>
</form>
</body>

</html>
