<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Liste adherents</title>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";

  ?>
  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>


  <script language="javascript" type="text/javascript">  <!-- affichage du tableau avec DataTable et des boutons imprimer et sortie format csv -->
  $(document).ready(function() {
      $('#example').DataTable({


              buttons: [
                {
                  extend: 'print',                                                  //btn impression
                  text: '<span class="glyphicon glyphicon-print"></span> Imprimer',
                  className: 'btn btn-info',
                },
                { extend: 'csv',                                                    //btn format CSV
                  text: '<span class=" glyphicon glyphicon-paperclip"></span> Sortie format csv',
                  className: 'btn btn-info'
                }
              ],

              pagingType: "simple_numbers",
              lengthMenu:[5,10,15,20,25],          //affichage par default a 20 puis selection possible a 5,10,15,20,25
              pageLength: 20,
              dom: '<"top"lf>rt<"bottom"iBp>',  <!-- Positionnement des boutons en fonction du tableau -->


      });


  });
  </script>
</head>
<body>
  <h2 style="text-align:center">Impression des adherents</h2>
  <div class="content-loader" style="width: 70%;margin:5% 13%;">    <!-- Creation du tableau -->
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse</th>
          <th>Date d'adhésion</th>
          <th>Remarques</th>
        </tr>
      </thead>
  </div>

  <?php
  $lesAdherents = ListerAdherent();  //affichage des adherents dans le tableau
  foreach($lesAdherents as $unAdherent)
  {
    echo '<td>'.$unAdherent['nom'].'</td>';
    echo '<td>'.$unAdherent['prenom'].'</td>';
    echo '<td>'.$unAdherent['adresse'].'</td>';
    echo '<td>'.DateFr($unAdherent['dateAdhesion']).'</td>';  //dateFr est une fonction qui permet de retourner les dates en dates francaises 
    echo '<td>'.$unAdherent['remarque'].'</td>';
    echo '</tr>';
  }

  ?>

</table>
  <form action="accueil.php" id="btnimpression" class="testtest">
    <input class="btn btn-info" type="submit" value="Accueil">
  </form>
</body>

</html>
