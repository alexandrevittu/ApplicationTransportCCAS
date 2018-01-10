<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="style.css"/>
  <title>Transport CCAS</title>
</head>
<?php
include_once "header.php";
?>
<body>
  <div id="adherent">
    <fieldset>
      <legend>Adhérent :</legend>
        <form  action="AjoutAdherent.php">
          <input class="accueil" type="submit" value="Ajout d'un adhérent">
        </form>
        <form  action="ListeAdherents.php">
          <input class="accueil" type="submit" value="Liste des adhérent">
        </form>
    </fieldset>
  </div>
  <div id="facturation">
    <fieldset>
      <legend>Facturation :</legend>
    <form action="Tarif.php">
        <input class="accueil" type="submit" value="Tarifs">
    </form>
    <form action="AjoutAdherent.php">
        <input class="accueil" type="submit" value="Trimestre">
    </form>
    <form action="AjoutAdherent.php">
        <input class="accueil" type="submit" value="Facturation">
    </form>
    <form action="AjoutAdherent.php">
        <input class="accueil" type="submit" value="Report">
    </form>
    </fieldset>
  </div>
  <div id="export">
    <fieldset>
      <legend>Export :</legend>
      <form action="AjoutAdherent.php">
          <input class="accueil" type="submit" value="Impression des adhérents">
      </form>
      <form action="AjoutAdherent.php">
          <input class="accueil" type="submit" value="Publipostage ré-adhésion">
      </form>
    </fieldset>
  </div>
  </body>
</html>
