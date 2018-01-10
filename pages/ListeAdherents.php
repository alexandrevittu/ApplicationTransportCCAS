
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ajout d'un adherent</title>

  <link rel="stylesheet" href="style.css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen"> 
  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
  <script type="text/javascript">

  $(document).ready(function() {
    $('#example').DataTable();
} );

  
  $("#btn-view").hide();
  
  $("#btn-add").click(function(){
    $(".content-loader").fadeOut('slow', function()
    {
      $(".content-loader").fadeIn('slow');
      $(".content-loader").load('AjoutAdherent.php');
      $("#btn-add").hide();
      $("#btn-view").show();
    });
  });
  
  $("#btn-view").click(function(){
    
    $("body").fadeOut('slow', function()
    {
      $("body").load('accueil.php');
      $("body").fadeIn('slow');
      window.location.href="accueil.php";
    });
  });

  </script>
  <script type="text/javascript">
      $('#example').DataTable( {
          "aaSorting": [[5,'asc']],
          "aoColumns": [
              null,
              null,
              { "sType": "date-uk" },
              null,
              { "sType": "date-uk" },
              { "sType": "date-uk" },
              null,
              null,
              null,
              null
          ]
      });
    $('#example')
    .removeClass( 'display' )
    .addClass('table table-bordered');
  });
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

            if ($difference > 365) {

              echo '<tr id="couleur">';        
              echo '<td>'.$unAdherent['nom'].'</td>';
              echo '<td>'.$unAdherent['prenom'].'</td>';
              echo '<td>'.$unAdherent['adresse'].'</td>';
              echo '<td>'.$unAdherent['dateAdhesion'].'</td>';
              echo '<td>'.$unAdherent['remarque'].'</td>';
              echo '<td><a href="AjoutAdherent.php">Ajouter</a>/<a href="#">Modifier</a>';
              echo '</tr>';   

            }else if ($difference < 305) {

              echo '<tr>';        
              echo '<td>'.$unAdherent['nom'].'</td>';
              echo '<td>'.$unAdherent['prenom'].'</td>';
              echo '<td>'.$unAdherent['adresse'].'</td>';
              echo '<td>'.$unAdherent['dateAdhesion'].'</td>';
              echo '<td>'.$unAdherent['remarque'].'</td>';
              echo '<td><a href="AjoutAdherent.php">Ajouter</a>/<a href="#">Modifier</a>';
              echo '</tr>'; 
            }
            else{
              echo '<tr style=background-color:orange;>';        
              echo '<td>'.$unAdherent['nom'].'</td>';
              echo '<td>'.$unAdherent['prenom'].'</td>';
              echo '<td>'.$unAdherent['adresse'].'</td>';
              echo '<td>'.$unAdherent['dateAdhesion'].'</td>';
              echo '<td>'.$unAdherent['remarque'].'</td>';
              echo '<td><a href="AjoutAdherent.php">Ajouter</a>/<a href="#">Modifier</a>';
              echo '</tr>'; 
            }
            }
          ?>
        </div>   
      </tbody>
    </table>
  </div>
</div>
</body>
</html>
