<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ajout d'un adherent</title>
  <link rel="stylesheet" href="style.css">

</head>
<?php
include_once "header.php";
?>
<body>
  <form method="POST" actions="AjoutAdherent">
    <label>Nom :</label><input type="text" name="nom"/></br>
    <label>Prenom :</label><input type="text" name="nom"/></br>
    <label>Adresse :</label><input type="text" name="adresse"/></br>
    <label>Date adhesion :</label><input type="date" name="date" placeholder="aaaa-mm-jj h:mim:sec"/></br>
    <label>Remarque :</label><input type="text" name="remarque"/></br>
    <p><input type="submit" value="Envoyer"/></p>
  </form>
</body>
</html>
