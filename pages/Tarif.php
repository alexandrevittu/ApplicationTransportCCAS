<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tarifs</title>
</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php"
?>

<body>
  <form id="tarif" method="POST">
    <label>Seuil du report du trimestre : </label><input type="number" name="seuil" /></br>
    <label>Tarif trajet court : </label><input type="number" name="trajetcourt" /></br>
    <label>Tarif trajet moyen : </label><input type="number" name="trajetmoyen" /></br>
    <label>Tarif trajet long : </label><input type="number" name="trajetlong" /></br>
    <label>Tarif de l'adhésion : </label><input type="number" name="tarifadhesion" /></br>
    <p><input type="submit" value="Valider"/></p>
  </form>
  <form action="accueil.php">
      <input type="submit" value="Annuler">
  </form>
</body>

</html>
