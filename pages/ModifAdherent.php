<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Modification d'un adherent</title>
<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";


$ladherent = GetAdherent($_POST['id']);

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
    <form id="modifadherent" method="POST">
      <input type="hidden" name="id" id="id" value="<?php echo$ladherent['id']?>"/></br>
      nom :<input type="text" name="nom" id="nom" value="<?php echo$ladherent['nom']?>"/></br>
      prenom :<input type="text" name="prenom" id="prenom" value="<?php echo$ladherent['prenom']?>"/></br>
      adresse :<input type="text" name="adresse" id="adresse" value="<?php echo$ladherent['adresse']?>"/></br>
      date adhesion :<input type="text" name="dateAdhesion" id="datepicker" value="<?php echo$ladherent['dateAdhesion']?>"/></br>
      remarque :<input type="text" name="remarque" id="remarque" value="<?php echo$ladherent['remarque']?>"/></br>
      <input class="btn btn-default" type="submit" value="Modifier"/>
    </form>
      <?php
      if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["dateAdhesion"]) && isset($_POST["remarque"]))
      {
        if($_POST["nom"]==NULL || $_POST["prenom"]==NULL || $_POST["adresse"]==NULL)
        {
          echo"<script>alert('Saisir les champs obligatoire (Nom,prenom,adresse,date)')</script>";
        }
        else{
        $dateactuel = date_create(date('Y-m-d'));
        $datesaisie = date_create(($_POST["dateAdhesion"]));
        $diff = date_diff($datesaisie,$dateactuel);
        $nb= (int)$diff->format('%R%a');
        if((int)$nb>=0)
        {
          ModifAdherent($_POST["id"],($_POST["nom"]),($_POST["prenom"]),($_POST["adresse"]),($_POST["dateAdhesion"]),($_POST["remarque"]));
          echo'<script>';
          echo"window.setTimeout(location=('ListeAdherents.php'), 10)";
          echo'</script>';
        }
        else
        {
         echo"<script>alert('Date supérieur a celle d\'aujourd\'hui')</script>";
        }

      }
    }
      ?>
      <form action="ListeAdherents.php">
          <input class="btn btn-info" type="submit" value="Annuler" class="buttonannulmodif">
      </form>
</body>

</html>
