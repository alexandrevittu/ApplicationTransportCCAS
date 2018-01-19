<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="style.css"/>
  <title>Transport CCAS</title>
  <meta http-equiv=”refresh” content="5"/>
</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";  //inclut l'en-tete
?>
<script type="text/javascript">

    $(document).ready(function(){
      location.reload(true);
    });

</script>
<body>

<!--Button adherent -->

  <div id="adherent">
    <fieldset>
      <legend><span class="glyphicon glyphicon-user"></span>&nbsp; Adhérent :</legend>
        <form  action="AjoutAdherent.php">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-plus"></span> &nbsp; Ajout d'un adhérent</button>
        </form>
        <form  action="ListeAdherents.php">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-th-list"></span> &nbsp; Liste des adhérents</button>
        </form>
    </fieldset>
  </div>

<!--Button facturation -->


  <div id="facturation">
    <fieldset>
      <legend><span class="glyphicon glyphicon-euro" ></span> &nbsp; Facturation :</legend>
        <form action="Tarif.php">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-euro" ></span> &nbsp; Tarifs</button>
        </form>
        <form action="Trimestre.php" method="POST">
          <?php
            $trimestre = getTrimestre();
            echo '<input type="hidden" name="trimestre" value='.$trimestre.'>';
          ?>
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

<!--Button export -->

  <div id="export">
    <fieldset>
      <legend><span class="glyphicon glyphicon-print" ></span> &nbsp; Export :</legend>
        <form action="ImpressionDesAdherents.php">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-print" ></span> &nbsp; Impression des adherents</button>
        </form>
        <form action="PubliPostageCSV.php">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-save-file" ></span> &nbsp; Publipostage ré-adhésion</button>
        </form>
    </fieldset>
  </div>

<!--recupération du trimestre avec la date du jour -->

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

    $Nbligne = file_get_contents('store');
    $recupLigne = unserialize($Nbligne);
    echo '<a id="renouvellementAccueil"href="PubliPostageCSV.php">Il y a '.$recupLigne.' renouvellement d\'adhesion.</a>';
    ?>

  </div>


<!--Button statistique -->


  <div id="statistique">
    <fieldset>
      <legend><span class="glyphicon glyphicon-eye-open" ></span> &nbsp; Statistique :</legend>
        <form action="#">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-print" ></span> &nbsp; Nombre de trajets depuis un an</button>
        </form>
        <form action="#">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-print" ></span> &nbsp; Total facturation depuis un an</button>
        </form>
        <form action="#">
          <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-print" ></span> &nbsp; Requêtes multicritères</button>
        </form>
    </fieldset>
  </div>
</body>
</html>
