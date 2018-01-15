
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ajout d'un adherent</title>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
  <script language="javascript" type="text/javascript">

    $(document).ready(function() {
      $('#example').DataTable();
    } );

    function verifAdh(id){
      if (confirm("Are you sure?")==true) {
        window.setTimeout(RedirectionJavascript(),3000);
        return true;
      }
      return false;
    }

    function RedirectionJavascript(){
      document.location.href="ModifAdherent.php";
    }

/*
  $('#example').DataTable( {
    buttons: [
        {
            extend: 'pdf',
            text: 'Save current page',
            exportOptions: {
                modifier: {
                    page: 'current'
                }
            }
        }
    ]
} );
*/
</script>
</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";
$lesAdherents = ListerAdherent();
?>
<body>
  <div class="content-loader" style="width: 70%;margin:5% 13%;">
    <div class="col-sm-12">
      <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Date d'adhésion</th>
            <th>Remarques</th>
            <th>Modifier/Supprimer</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Date d'adhésion</th>
            <th>Remarques</th>
            <th>Modifier/Supprimer</th>
          </tr>
        </tfoot>
        <tbody>
          <div>
            <?php


            foreach($lesAdherents as $unAdherent){

              $dnow = $unAdherent['dateAdhesion'];
              $dafter = date("Y-m-d");
              $date1=date_create($dnow);
              $date2=date_create($dafter);
              $diff=date_diff($date1,$date2);
              $difference = (int)$diff->format('%R%a');
              $id=$unAdherent['id'];

              if ($difference > 365) {

                echo '<tr id="couleur">';
                echo '<td>'.$unAdherent['nom'].'</td>';
                echo '<td>'.$unAdherent['prenom'].'</td>';
                echo '<td>'.$unAdherent['adresse'].'</td>';
                echo '<td>'.$unAdherent['dateAdhesion'].'</td>';
                echo '<td>'.$unAdherent['remarque'].'</td>';
                echo '<td><form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-default" id="btn-view" type="submit" value="Modifier"/></form><form action="validerSupp.php" method="POST"><input type="hidden" name="id" value='.$id.'><button class="btn btn-default" type="submit" id="btn-view" onclick="verifAdh()">Supprimer</button></form></td>';
                echo '</tr>';

              }else if ($difference < 305) {

                echo '<tr>';
                echo '<td>'.$unAdherent['nom'].'</td>';
                echo '<td>'.$unAdherent['prenom'].'</td>';
                echo '<td>'.$unAdherent['adresse'].'</td>';
                echo '<td>'.$unAdherent['dateAdhesion'].'</td>';
                echo '<td>'.$unAdherent['remarque'].'</td>';
                echo '<td>'.'<form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-default" id="btn-view" type="submit" value="Modifier"/></form><form action="validerSupp.php" method="POST" ><input type="hidden" name="id" value='.$id.'><button class="btn btn-default" type="submit" id="btn-view" onclick="verifAdh()">Supprimer</button></form></td>';
                echo '</tr>';
              }
              else{
                echo '<tr style=background-color:orange;>';
                echo '<td>'.$unAdherent['nom'].'</td>';
                echo '<td>'.$unAdherent['prenom'].'</td>';
                echo '<td>'.$unAdherent['adresse'].'</td>';
                echo '<td>'.$unAdherent['dateAdhesion'].'</td>';
                echo '<td>'.$unAdherent['remarque'].'</td>';
                echo '<td><form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-default" id="btn-view" type="submit" value="Modifier"/></form><form action="validerSupp.php" method="POST" id=suppAdherent action="validerSupp.php"><input type="hidden" name="id" value='.$id.'><button class="btn btn-default" type="submit" id="btn-view" onclick="verifAdh()">Supprimer</button></form></td>';
                echo '</tr>';
              }
            }
            ?>
          </div>
        </tbody>
      </table>
    </div>
  </div>
  <form action="accueil.php" id="annulerfacturation">
      <input class="btn btn-default" type="submit" value="accueil">     
  </form>

</body>
</html>
