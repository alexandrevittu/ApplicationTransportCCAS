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
  <div id="conteneur">
<h2 style="text-align:center;">Modification identifiant</h2>
 <form method="POST" id="ajoutadherent">
   <?php
   echo '<label>Utilisateur selectionné : '.$uti['Pseudo'].'</label><br>';
   echo '<label>Nouvel identifiant : </label><br>';
   echo '<input type="hidden" name="id" value='.$id.'/>';
    ?>
   <input type="text" name="pseudo"  required/></br>
   <input type="submit" value="valider"/>
 </form>
</div>
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
  <input type="submit" value="Annuler" id="btn_ajout2" class="buttonadherent"/>
</form>
</body>

</html>
