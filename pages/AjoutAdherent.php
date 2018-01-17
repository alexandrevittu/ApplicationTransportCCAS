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
  <div class="container">
    <form id="ajoutadherent" method="POST">
      <label for="fnom">Nom</label><br>
      <input type="text" name="nom" id="fnom" /><br>
      <label for="fprenom">Prénom</label><br>
      <input type="text" name="prenom" id="fprenom" /><br>
      <label for="fnom">Adresse</label><br>
      <input type="text" name="adresse" id="fadresse" /><br>
      <label for="fnom">Date d'adhésion</label><br>
      <input type="text" id="datepicker" name="date"><br>
      <label for="fnom">Remarques</label><br>
      <input type="text" name="remarque" id="fremarque" /><br>
      <p><input class="" type="submit" value="Valider"/><br>
    </form>

    <?php

    if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["date"]) &&  isset($_POST["remarque"]))
    {

     if($_POST["nom"]==NULL || $_POST["prenom"]==NULL || $_POST["adresse"]==NULL)
     {
       echo"<script>alert('Saisir les champs obligatoire (Nom,prenom,adresse,date)');history.go(-1);</script>";
     }
     else{
       $dateactuel = date_create(date('Y-m-d'));
       $datesaisie = date_create(($_POST["date"]));
       $diff = date_diff($datesaisie,$dateactuel);
       $nb= (int)$diff->format('%R%a');
       if((int)$nb>=0)
       {
         AjoutAdherent(($_POST["nom"]),($_POST["prenom"]),($_POST["adresse"]),($_POST["date"]),($_POST["remarque"]));
         $id = Getidadherent($_POST["nom"],$_POST["prenom"]);
         $trimestre = getTrimestre();
         $nbtrajet =0;
         for($i=1;$i<=4;$i++)
         {
           ajouttrajetcourtparadherent($id['id'],$i,$nbtrajet);
           ajouttrajetmoyenparadherent($id['id'],$i,$nbtrajet);
           ajouttrajetlongparadherent($id['id'],$i,$nbtrajet);
         }
         ajoutadhesionparadherent($id['id'],$trimestre);
         echo"<script>alert('Adherent ajouter !')</script>";
       }
       else
       {
        echo"<script>alert('Date supérieur a celle d\'aujourd\'hui');history.go(-1);</script>";

      }

    }
  };

  ?>


  <input  id="btn_ajout" class="" onclick="history.go(-1)" type="submit" value="Retour" class="buttonadherent">
</div>
</body>
</html>
