<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ajout d'un adherent</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php"
?>

<script src="https://code.jquery.com/jquery-1.12.4.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>
$( function() {
  $( "#datepicker" ).datepicker({
altField: "#datepicker",
closeText: 'Fermer',
prevText: 'Précédent',
nextText: 'Suivant',
currentText: 'Aujourd\'hui',
monthNames: ['Janvier', 'Février', 'Mars', 'Avril', 'Mai', 'Juin', 'Juillet', 'Août', 'Septembre', 'Octobre', 'Novembre', 'Décembre'],
monthNamesShort: ['Janv.', 'Févr.', 'Mars', 'Avril', 'Mai', 'Juin', 'Juil.', 'Août', 'Sept.', 'Oct.', 'Nov.', 'Déc.'],
dayNames: ['Dimanche', 'Lundi', 'Mardi', 'Mercredi', 'Jeudi', 'Vendredi', 'Samedi'],
dayNamesShort: ['Dim.', 'Lun.', 'Mar.', 'Mer.', 'Jeu.', 'Ven.', 'Sam.'],
dayNamesMin: ['D', 'L', 'M', 'M', 'J', 'V', 'S'],
weekHeader: 'Sem.',
dateFormat: 'yy-mm-dd'
});
});
</script>

<body>
  <form id="ajoutadherent" method="POST">
    <label>Nom :</label><input type="text" name="nom" /></br>
    <label>Prenom :</label><input type="text" name="prenom" /></br>
    <label>Adresse :</label><input type="text" name="adresse"/></br>
    <label>Date adhesion :</label><input type="text" id="datepicker" name="date"></br>
    <label>Remarque :</label><input type="text" name="remarque"/></br>
    <p><input type="submit" value="Envoyer"/></p>
  </form>
  <?php
    if(isset($_POST["nom"]) AND isset($_POST["prenom"]) AND isset($_POST["adresse"]) AND isset($_POST["date"]) AND isset($_POST["remarque"]))
   {

    AjoutAdherent(($_POST["nom"]),($_POST["prenom"]),($_POST["adresse"]),($_POST["date"]),($_POST["remarque"]));
  };
   ?>

  <form action="accueil.php">
      <input type="submit" value="Annuler" id="annulerajout">
  </form>
</body>
</html>
