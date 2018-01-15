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
  <div class="content-loader" style="width: 70%;margin:5% 20%;">
  <form id="ajoutadherent" method="POST">
    Nom :<input type="text" name="nom" id="nom" /></br>
    Prenom :<input type="text" name="prenom" /></br>
    Adresse :<input type="text" name="adresse"/></br>
    Date adhesion :<input type="text" id="datepicker" name="date"></br>
    Remarque :<input type="text" name="remarque"/></br>
    <p><input class="btn btn-default" type="submit" value="Valider"/></p>
  </form>
  <?php


    if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["date"]) &&  isset($_POST["remarque"]))
   {

     if($_POST["nom"]==NULL || $_POST["prenom"]==NULL || $_POST["adresse"]==NULL)
     {
       echo"<script>alert('Saisir les champs obligatoire (Nom,prenom,adresse,date)')</script>";
     }
     else{
     $dateactuel = date_create(date('Y-m-d'));
     $datesaisie = date_create(($_POST["date"]));
     $diff = date_diff($datesaisie,$dateactuel);
     $nb= (int)$diff->format('%R%a');
     if((int)$nb>0)
     {
       AjoutAdherent(($_POST["nom"]),($_POST["prenom"]),($_POST["adresse"]),($_POST["date"]),($_POST["remarque"]));
       $id = Getidadherent($_POST["nom"],$_POST["prenom"]);
       $trimestre = getTrimestre();
       for($i=1;$i<=4;$i++)
       {
       ajouttrajetcourtparadherent($id['id'],$i);
       ajouttrajetmoyenparadherent($id['id'],$i);
       ajouttrajetlongparadherent($id['id'],$i);
       }
       ajoutadhesionparadherent($id['id'],$trimestre);
       echo"<script>alert('Adherent ajouter !')</script>";
     }
     else
     {
      echo"<script>alert('Date supérieur a celle d\'aujourd\'hui')</script>";
     }

  }
};



   ?>

  <form action="accueil.php">
      <input class="btn btn-default" type="submit" value="Annuler" class="buttonadherent">
  </form>
</div>
</body>
</html>
