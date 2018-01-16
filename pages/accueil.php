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
      <legend><span class="glyphicon glyphicon-user"></span>&nbsp; Adhérent :</legend>
        <form  action="AjoutAdherent.php">
          <!-- <input class="accueil" type="submit" value="Ajout d'un adhérent"> -->
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-plus"></span> &nbsp; Ajout d'un adhérent</button>
        </form>
        <form  action="ListeAdherents.php">

          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-th-list"></span> &nbsp; Liste des adhérents</button>
        </form>
    </fieldset>
  </div>
  <div id="facturation">
    <fieldset>
      <legend><span class="glyphicon glyphicon-euro" ></span> &nbsp; Facturation :</legend>
    <form action="Tarif.php">
        <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-euro" ></span> &nbsp; Tarifs</button>
    </form>

    <form action="Trimestre.php">
        <button class="btn btn-info" type="submit" id="accueil"> <span class=" glyphicon glyphicon-option-horizontal" ></span> &nbsp; Trimestre</button>
    </form>
    <form action="Facturation.php">
        <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-shopping-cart" ></span> &nbsp; Facturation</button>
    </form>
    <form action="report.php">
        <button class="btn btn-info" type="submit" id="accueil"> <span class=" glyphicon glyphicon-option-horizontal" ></span> &nbsp; Report</button>
    </form>
    </fieldset>
  </div>
  <div id="export">
    <fieldset>
      <legend><span class="glyphicon glyphicon-print" ></span> &nbsp; Export :</legend>
      <form action="ImpressionDesAdherents.php">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-print" ></span> &nbsp; Impression des adherents</button>
      </form>
      <form action="#">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-save-file" ></span> &nbsp; Publipostage ré-adhésion</button>
      </form>
    </fieldset>
  </div>
  <div id="trimestre">
    <?php
    $mois = date('m');
    //$mois = 02;
    if($mois>=01 && $mois<=03)
    {
      echo "<label>Trimestre en cours :Janvier/Fevrier/Mars</label>";
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
