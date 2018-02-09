<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Facturation</title>
</head>
<body>

<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";
$lesAdherents = ListerAdherent();
$seuil = getSeuil();
?>

  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <script  src="assets/datatables.min.js"></script> <!-- ici-->
  <script  src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script  src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

<h2 style="text-align:center;">Facturation</h2>
<script>    <!--configuration du tableau -->
  $(document).ready(function() {
    $('#example').dataTable( {
      "footerCallback": function ( tfoot, data, start, end, display ) {
          var api = this.api(), data;           <!--fonction calcul le total de tout les adherents -->

          var intVal = function ( i ) {
            return typeof i === 'string' ?        <!--test du type + convertion en int -->
              i.replace(/[\€,]/g, '')*1 :
              typeof i === 'number' ?
                i : 0;
          };

          total = api
            .column( 7 )                           <!--addition des totals de chaque adherent -->
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );

            $( api.column( 7 ).footer() ).html(       <!--affichage dans le footer -->
              total.toFixed(2)+'€'
            );
          },

          buttons: [
            { extend: 'print', text: '<span class="glyphicon glyphicon-print"></span> Imprimer' , className: 'btn btn-info', footer:true,title: 'Facturation'},
          ],
          pagingType: "simple_numbers",
          lengthMenu:[5,10,15,20,25],
          pageLength: 20,
          "dom": '<"top"lfi>rt<"bottom"Bp>',  <!-- Positionnement des boutons en fonction du tableau -->
    });
  });
</script>

  <div id="conteneur">   <!--creation du tableau -->
    <table   class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse</th>
          <th>Adhesion</th>
          <th>Nombre de trajet court</th>
          <th>Nombre de trajet moyen</th>
          <th>Nombre de trajet long</th>
          <th>Total</th>
        </tr>
      </thead>
      <tfoot>
        <tr>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th></th>
          <th  style="text-align:right">Total:</th>
          <th></th>
        </tr>
      </tfoot>
      <tbody>
        <tr>
      <?php
      $prixtrajetcours = Getprixtrajetcours();
      $prixtrajetmoyen = Getprixtrajetmoyen();
      $prixtrajetlong = Getprixtrajetlong();
      $prixadhesion = Getprixadhesion();    //recuperation dans la bdd des prix actuel
      $prixglobal = 0;
      
        $trimestre = getTrimestre();

        if($trimestre == 1)         //affiche le trimestre en cours
        {
          echo 'Trimestre actuel : Janvier/Fevrier/Mars';
        }
        elseif($trimestre == 2)
        {
          echo 'Trimestre actuel : Avril/Mai/Juin';
        }
        elseif($trimestre == 3)
        {
          echo 'Trimestre actuel : Juillet/Aout/Septembre';
        }
        elseif($trimestre == 4)
        {
          echo 'Trimestre actuel : Octobre/Novembre/Décembre';
        }

      foreach($lesAdherents as $unAdherent)
      {
        $test = false;

        $année=date('Y');

        $prixtotal = 0;
        $nbtrajetcourt = Getnbtrajetcours($trimestre);
        $nbtrajetmoyen = Getnbtrajetmoyen($trimestre);
        $nbtrajetlong = Getnbtrajetlong($trimestre);
        $adhesion = Getadhesion();
        foreach($adhesion as $nbadhesion)
        {
          if($nbadhesion['idAdherent'] == $unAdherent['id'])  //ajout du prix de l'adhesion seulement si l'adhesion a eu lieux pendant ce trimestre
          {
            if($nbadhesion['nbTrajet'] == 1)
            {
              if($trimestre == 1)
              {
                if($unAdherent['dateAdhesion'] > $année."-01-01" && $unAdherent['dateAdhesion'] < $année."-03-31")
                {
                  $prixtotal += $prixadhesion['prix'];
                }
              }
              if($trimestre == 2)
              {
                if($unadherent['dateAdhesion'] > $année."-04-01" && $unadherent['dateAdhesion'] < $année."-06-30")
                {
                  $prixtotal += $prixadhesion['prix'];
                }
              }
              if($trimestre == 3)
              {
                if($unadherent['dateAdhesion'] > $année."07-01" && $unadherent['dateAdhesion'] < $année."-09-30")
                {
                  $prixtotal += $prixadhesion['prix'];
                }
              }
              if($trimestre == 4)
              {
                if($unadherent['dateAdhesion'] > $année."-10-01" && $unadherent['dateAdhesion'] < $année."-12-31")
                {
                  $prixtotal += $prixadhesion['prix'];
                }
              }
            }
            else
            {
            }
          }
        }
        foreach($nbtrajetcourt as $nbtrajetcourtparadherent) //calcul prix des trajet court
        {
          if($nbtrajetcourtparadherent['idAdherent'] == $unAdherent['id'])
          {
            $prixtotal += $nbtrajetcourtparadherent['nbTrajet']*$prixtrajetcours['prix'];
          }
        }
        foreach($nbtrajetmoyen as $nbtrajetmoyenparadherent) //calcul prix des trajet moyen
        {
          if($nbtrajetmoyenparadherent['idAdherent'] == $unAdherent['id'])
          {
            $prixtotal += $nbtrajetmoyenparadherent['nbTrajet']*$prixtrajetmoyen['prix'];
          }
        }
        foreach($nbtrajetlong as $nbtrajetlongparadherent) //calcul prix des trajet long
        {
          if($nbtrajetlongparadherent['idAdherent'] == $unAdherent['id'])
          {
            $prixtotal += $nbtrajetlongparadherent['nbTrajet']*$prixtrajetlong['prix'];
          }
        }
        if($prixtotal >= $seuil['prix'])  //affichage seulement si pris supérieur a seuil
        {
          echo '<td>'.$unAdherent['nom'].'</td>';
          echo '<td>'.$unAdherent['prenom'].'</td>';
          echo '<td>'.$unAdherent['adresse'].'</td>';

          foreach($lesAdherents as $unadherent) //affiche de "x" si adhesion est a paye ce mois ci
          {
          if($unAdherent['id'] == $unadherent['id'] && $unadherent['dateAdhesion'] > $année."-01-01" && $unadherent['dateAdhesion'] < $année."-03-31")
          {
            echo '<td>x</td>';
          }
          elseif($unAdherent['id'] == $unadherent['id'] && $unadherent['dateAdhesion'] > $année."-04-01" && $unadherent['dateAdhesion'] < $année."-06-30")
          {
            echo '<td>x</td>';
          }
          elseif($unAdherent['id'] == $unadherent['id'] && $unadherent['dateAdhesion'] > $année."07-01" && $unadherent['dateAdhesion'] < $année."-09-30")
          {
            echo '<td>x</td>';
          }
          elseif($unAdherent['id'] == $unadherent['id'] && $unadherent['dateAdhesion'] > $année."-10-01" && $unadherent['dateAdhesion'] < $année."-12-31")
          {
            echo '<td>x</td>';
          }
          elseif($unAdherent['id'] == $unadherent['id'] && $test == false )
          {
              echo'<td></td>';
              $test = true;
          }
          }
          foreach($nbtrajetcourt as $nbtrajetcourtparadherent)
          {                                                           //affichage nombre de trajet court
            if($nbtrajetcourtparadherent['idAdherent'] == $unAdherent['id'])
            {
              echo '<td>'.$nbtrajetcourtparadherent['nbTrajet'].'</td>';
            }
          }
          foreach($nbtrajetmoyen as $nbtrajetmoyenparadherent)
          {                                                           //affichage nombre de trajet moyen
            if($nbtrajetmoyenparadherent['idAdherent'] == $unAdherent['id'])
            {
              echo '<td>'.$nbtrajetmoyenparadherent['nbTrajet'].'</td>';
            }
          }
          foreach($nbtrajetlong as $nbtrajetlongparadherent)
          {                                                           //affichage nombre de trajet long et du prix total
            if($nbtrajetlongparadherent['idAdherent'] == $unAdherent['id'])
            {
              echo '<td>'.$nbtrajetlongparadherent['nbTrajet'].'</td>';
              echo '<td>'.$prixtotal.' €</td>';
              echo '</tr>';
              $prixglobal += $prixtotal;
            }
          }
        $prixtotal = 0;
      }
      }
    ?>

  </tbody>
    </table>
    <input class="btn btn-info" onclick="window.location.href='accueil.php'" type="submit" value="Retour" class="buttonadherent">
  </div>
</body>
</html>
