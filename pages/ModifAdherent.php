<!DOCTYPE html>
<html>
<head>
<title>Modification d'un adherent</title>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";
$ladherent = GetAdherent($_POST['id']);
?>

<body>
  <div class="content-loader" style="width: 70%;margin:5% 20%;">
    <form id="modifadherent" method="POST">
      nom :<input type="text" name="nom" id="nom"/></br>
      prenom :<input type="text" name="prenom" id="prenom"/></br>
      adresse :<input type="text" name="adresse" id="adresse"/></br>
      date adhesion :<input type="text" name="date" id="date"/></br>
      remarque :<input type="text" name="remarque" id="remarque"/></br>
      <input class="btn btn-default" type="submit" value="Modifier"/>
</body>

</html>
