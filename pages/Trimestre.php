<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Trimestre</title>
  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <script   src="assets/datatables.min.js"></script> <!-- ici-->
  <script   src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script   src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
  <script   src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
</head>
<body>
    <?php
      include_once "header.php";
      include_once "../fonctions/fonctions.php";
      $trimestre = getTrimestre();
      $libelleTrimestre = getTrimestreLib($trimestre);
      $libelleTr = utf8_encode($libelleTrimestre['libelle']);

      $triTrimestre = orderTrimestre();
      $n1 = $triTrimestre[1]['idTrimestre'];
      $n2 = $triTrimestre[2]['idTrimestre'];
      $n3 = $triTrimestre[3]['idTrimestre'];
      $n4 = $triTrimestre[4]['idTrimestre'];
    ?>
  <div id="conteneur">
    <h2 style="text-align:center;">Trimestre</h2>
    <div id="debut">
      <form method="POST" id="listetrimestre">  <!--liste déroulante des trimestre-->
        <select id="selecttrimestre" name="trimestre" >
          <option value=<?php echo $n1; ?>><?php echo $triTrimestre[1]['libelle'].' '.$triTrimestre[1]['annee'] ?>
          <option value=<?php echo $n2; ?>><?php echo $triTrimestre[2]['libelle'].' '.$triTrimestre[2]['annee'] ?>
          <option value=<?php echo $n3; ?>><?php echo $triTrimestre[3]['libelle'].' '.$triTrimestre[3]['annee'] ?>
          <option value=<?php echo $n4; ?>><?php echo $triTrimestre[4]['libelle'].' '.$triTrimestre[4]['annee'] ?>
        </select>
        <input class="btn btn-info" id="btnenvoyer" type="submit" value="Envoyer">
      </form>
  </div></div>
    <script > <!--affichage du tableau avec DataTable -->
        $(document).ready(function() {
          $('#example').DataTable({

          pagingType: "simple_numbers",
          lengthMenu:[5,10,15,20,25],
          pageLength: 20,

          });
        } );
         document.getElementById("selecttrimestre").selectedIndex = "3";
    </script>

    <?php

    if(isset($_POST['trajetcourt']))
    {
      $datemtn = date('Y-m-d');
      ModifTrajetCourtParAdherent($_POST['id'],$_POST['trimestre'],$_POST['trajetcourt'],$datemtn); //envoie a la bdd
      ModifTrajetMoyenParAdherent($_POST['id'],$_POST['trimestre'],$_POST['trajetmoyen'],$datemtn);
      ModifTrajetLongParAdherent($_POST['id'],$_POST['trimestre'],$_POST['trajetlong'],$datemtn);
    }
    if(isset($_POST['trimestre']) && $_POST['trimestre']==1)
    {
      $annee = $triTrimestre[4]['annee'];
      $libelleTrimestre = getTrimestreLib($_POST['trimestre']);
      $libelleTr = utf8_encode($libelleTrimestre['libelle']);
      echo"<h4 style='text-align: center;'>Trimestre selectionné : ".$libelleTr." ".$annee." </h4>";
      echo "<script>";
      echo "document.getElementById('selecttrimestre').style.display = 'none';";
      echo "document.getElementById('btnenvoyer').style.display = 'none';";
      echo'</script>';

    }
    elseif(isset($_POST['trimestre']) && $_POST['trimestre']==2)
    {
      $annee = $triTrimestre[3]['annee'];
      $libelleTrimestre = getTrimestreLib($_POST['trimestre']);
      $libelleTr = utf8_encode($libelleTrimestre['libelle']);
      echo"<h4 style='text-align: center;'>Trimestre selectionné : ".$libelleTr." ".$annee." </h4>";
      echo "<script>";
      echo "document.getElementById('selecttrimestre').style.display = 'none';";
      echo "document.getElementById('btnenvoyer').style.display = 'none';";
      echo'</script>';
    }
    elseif(isset($_POST['trimestre']) && $_POST['trimestre']==3)
    {
      $annee = $triTrimestre[2]['annee'];
      $libelleTrimestre = getTrimestreLib($_POST['trimestre']);
      $libelleTr = utf8_encode($libelleTrimestre['libelle']);
      echo"<h4 style='text-align: center;'>Trimestre selectionné : ".$libelleTr." ".$annee." </h4>";
      echo "<script>";
      echo "document.getElementById('selecttrimestre').style.display = 'none';";
      echo "document.getElementById('btnenvoyer').style.display = 'none';";
      echo'</script>';
    }
    elseif(isset($_POST['trimestre']) && $_POST['trimestre']==4)
    {
      $annee = $triTrimestre[1]['annee'];
      $libelleTrimestre = getTrimestreLib($_POST['trimestre']);
      $libelleTr = utf8_encode($libelleTrimestre['libelle']);
      echo"<h4 style='text-align: center;'>Trimestre selectionné : ".$libelleTr." ".$annee." </h4>";
      echo "<script>";
      echo "document.getElementById('selecttrimestre').style.display = 'none';";
      echo "document.getElementById('btnenvoyer').style.display = 'none';";
      echo'</script>';
    }
      if(isset($_POST['trimestre']))  //creation du tableau
      {

        echo"<div class='content-loader' style='width: 70%;margin:5% 13%;'>";
        echo "<table class='table table-striped table-hover table-responsive no-footer table-bordered' id='example'>";
        echo "<thead>";
        echo "<tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Ajout</th></tr></thead>";

        $lesAdherents = ListerAdherent();

        foreach($lesAdherents as $unAdherent)
        {
          $dateadhesion = $unAdherent['dateAdhesion'];
          $datetoday = date("Y-m-d");
          $dateadd = date_create($dateadhesion);
          $dateactueldatetime = date_create($datetoday);
          $diff = date_diff($dateadd,$dateactueldatetime);
          $difference = (int)$diff->format('%R%a');

          if($difference < 365)
          {

          $id=$unAdherent['id'];
          echo '<tr>';
          echo '<td>'.$unAdherent['nom'].'</td>';
          echo '<td>'.$unAdherent['prenom'].'</td>';
          echo '<td>'.$unAdherent['adresse'].'</td>';
          echo '<td><form action="addtrajet.php"  method="POST"><input type="hidden" name="prenom" value='.$unAdherent['prenom'].'><input type="hidden" name="nom" value='.$unAdherent['nom'].'><input type="hidden" name="id" value='.$id.'><input type="hidden" name="trimestre" value='.$_POST["trimestre"].'><input type="hidden" name="annee" value='.$annee.'><button class="btn btn-info" id="btn-view" type="submit"><span class=" glyphicon glyphicon-plus" ></span> &nbsp;Ajout</button></form></td>';
          $trimestresuivant = getTrimestreSuivantNb();
          $test = getTrimestre();
          ModifTrajetCourtParAdherent($unAdherent['id'],$trimestresuivant,0,null);
          ModifTrajetMoyenParAdherent($unAdherent['id'],$trimestresuivant,0,null);
          ModifTrajetLongParAdherent($unAdherent['id'],$trimestresuivant,0,null);
          updateReport($unAdherent['id'],0,$trimestresuivant);
          }

        }
      }

      echo '</table>';


    ?>
    <form style="text-align:center;">
  <!--  <input   class="btn btn-info" onclick="window.location.href='trimestre.php'" type="button" value="Retour" id="btnretoureee"> <!-- Boutton annuler -->
    <?php
      if(isset($_POST['trimestre']))
      {
        ?>
        <input class="btn btn-info" onclick="window.location.href='Facturation.php'" type="button" value="Facturation">

        <input   class="btn btn-info" onclick="window.location.href='trimestre.php'" type="button" value="Retour au choix du trimestre" id="btnretoureee">
        <?php
      }
     ?>

    <input  class="btn btn-info" onclick="window.location.href='accueil.php'" type="button"  value="Accueil">
  </form>
  </div>
</body>
</html>
