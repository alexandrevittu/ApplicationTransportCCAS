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
<script>
    setTimeout("window.location='deconnexion.php'",7200000);

    $(document).ready(function(){
      location.reload(true);
    });

</script>
  <div id="centrerAccueil">
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
            ?>
            <button class="btn btn-info" type="submit" id="accueil"> <span class=" glyphicon glyphicon-option-horizontal" ></span> &nbsp; Trimestres</button>
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
            <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-print" ></span> &nbsp; Impression des adhérents</button>
          </form>
          <form action="PubliPostageCSV.php">
            <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-save-file" ></span> &nbsp; Publipostage ré-adhésion</button>
          </form>
          <form action="importCSV.php">
            <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-save-file" ></span> &nbsp; Importer des adhérents</button>
          </form>
      </fieldset>
    </div>
  </div>
<!--recupération du trimestre avec la date du jour -->
  <div id="trimestre">
    <?php
    $mois = date('m');
    //$mois = 12;
    $annee =date('Y');
    if($mois>=01 && $mois<=03)
    {
      echo "<label>Trimestre en cours : Janvier/Fevrier/Mars ".$annee."</label>";
    }
    elseif($mois>=04 && $mois<=06)
    {
      echo '<label>Trimestre en cours : Avril/Mai/Juin '.$annee.'</label>';
    }
    elseif($mois>=10 && $mois<=12)
    {
      echo '<label>Trimestre en cours : Octobre/Novembre/Decembre '.$annee.'</label>';
    }
    else
    {
      echo '<label>Trimestre en cours : Juillet/Aout/Septembre '.$annee.'</label>';
    }

/***** Pour recepurer le nombre de renouvellement d'adhesion passée dans la variable $_SESSIOn, ainsi on recuperer de page en page.******/

    if (isset($_SESSION['nbLigne'])) {
      if ($_SESSION['nbLigne'] != 0) {
        if ($_SESSION['nbLigne'] == 1) {
            echo '<a class="renouvellementAccueil" href="PubliPostageCSV.php">Il y a '.$_SESSION['nbLigne'].' renouvellement d\'adhesion.</a>';
        }
        else {
          echo '<a class="renouvellementAccueil" href="PubliPostageCSV.php">Il y a '.$_SESSION['nbLigne'].' renouvellements d\'adhesion.</a>';
        }
      }
    }

    if (isset($_SESSION['retour'])) {
      if ($_SESSION['retour'] == -1) {
        header('Location: ListeAdherents.php');
      }
    }

    ?>

  </div>
<!--Button statistique -->
  <div id="statistique">
    <fieldset>
      <legend><span class="glyphicon glyphicon-eye-open" ></span> &nbsp; Statistiques :</legend>
        <form action="requeteFixeNbTrajet.php">
          <button class="btn btn-info" type="submit"> <span class="glyphicon glyphicon-stats" ></span> &nbsp; Nombre de trajets depuis un an</button>
        </form>
        <form action="RequeteFixeFacture.php">
          <button class="btn btn-info" type="submit"> <span class="glyphicon glyphicon-stats" ></span> &nbsp; Total facturation depuis un an</button>
        </form>
        <form action="requetesMulticriteres.php">
          <button class="btn btn-info" type="submit"> <span class="glyphicon glyphicon-stats" ></span> &nbsp; Requêtes multicritères</button>
        </form>
    </fieldset>
  </div>
  <?php
$lesAdherents = ListerAdherent();
foreach($lesAdherents as $unAdherent)
{
  $dateadhesion = $unAdherent['dateAdhesion'];
  $datetoday = date("Y-m-d");
  $dateadd = date_create($dateadhesion);
  $dateactueldatetime = date_create($datetoday);
  $diff = date_diff($dateadd,$dateactueldatetime);

  $difference = (int)$diff->format('%R%a');
  if($difference > 730)
  {
    SupprimerAdherent($unAdherent['id']);
  }
}
 ?>
</body>
</html>
