<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="style.css"/>
  <title>Transport CCAS</title>
</head>
<body>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";  //inclut l'en-tete
  ?>
  <div id="conteneur">
    <form id="ajoutadherent" method="POST" action="receptionBDD.php" enctype="multipart/form-data">
      <label for="fichier">Veuillez importer la base de donnée (sous format <strong>.xls</strong>)</label><br><br>
      <input type="file" name="fichier" id="fichier" style="border:1px solid black;display:inline;"><br><br>
      <input type="submit" name="submit" value="Envoyez"/><br>
    </form>
      <input  id="btn_ajout" class="" onclick="window.location.href='accueil.php'" type="submit" value="Retour" class="buttonadherent">
  </div>
</body>
