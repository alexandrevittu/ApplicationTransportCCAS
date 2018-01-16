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
    <form action="Trimestre.php">
        <input class="accueil" type="submit" value="Trimestre">
    </form>
    <form action="Facturation.php">
        <input class="accueil" type="submit" value="Facturation">
    </form>
    <form action="report.php">
        <input class="accueil" type="submit" value="Report">
    </form>
    </fieldset>
  </div>
  <div id="export">
    <fieldset>
      <legend>Export :</legend>
      <form action="ImpressionDesAdherents.php">
          <input class="accueil" type="submit" value="Impression des adhérents">
      </form>
      <form action="#">
          <input class="accueil" type="submit" value="Publipostage ré-adhésion">
      </form>
    </fieldset>
  </div>
  <div id="trimestre">
    <?php
    $mois = date('m');
    //$mois = 02;
    if($mois>=01 && $mois<=03)
    {
      echo '<label>Trimestre en cours :Janvier/Fevrier/Mars</label>';
    }
    elseif($mois>=04 && $mois<=06)
    {
      echo '<label>Trimestre en cours :Avril/Mai/Juin</label>';
    }
    elseif($mois>=10 && $mois<=12)
    {
      echo '<label>Trimestre en cours :Octobre/Novembre/Decembre</label>';
    }
    else
    {
      echo '<label>Trimestre en cours :Juillet/Aout/Septembre</label>';
    }

    ?>
  </div>
  </body>
</html>
