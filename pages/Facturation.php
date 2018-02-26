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

  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css">
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen">
  <script  src="assets/datatables.min.js"></script>
  <script  src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script  src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

  <h2 style="text-align:center;">Facturation</h2>
<script>                                                  <!--configuration du tableau -->
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

            $( api.column( 7 ).footer() ).html(       <!--affichage dans le footer a la collone numero 7 -->
              total.toFixed(2)+'€'
            );
          },

          buttons: [
            { extend: 'print', text: '<span class="glyphicon glyphicon-print"></span> Imprimer' , className: 'btn btn-info', footer:true,title: 'Facturation'},
          ],
          pagingType: "simple_numbers",
          lengthMenu:[5,10,15,20,25],         <!-- affichage possible a 5,10,15,20 et 25 par pages -->
          pageLength: 20,                     <!-- par default afficher a 20 ligne -->
          "dom": '<"top"lfi>rt<"bottom"Bp>',  <!-- Positionnement des boutons en fonction du tableau -->
          "oLanguage": {
      "sInfo": "Il y a un total de  _TOTAL_ adhérents (_START_ à _END_)"
        },
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
      $annee = date('Y');
      $trimestreavant = 0;
      $prixtrajetcours = Getprixtrajetcours();
      $prixtrajetmoyen = Getprixtrajetmoyen();
      $prixtrajetlong = Getprixtrajetlong();
      $prixadhesion = Getprixadhesion();    //recuperation dans la bdd des prix actuel
      $prixglobal = 0;                      //initialisation variable prix global a zero

        $trimestre = getTrimestre();    //recupere le trimestre en cours

        if($trimestre == 1)         //affiche le trimestre en cours
        {
          echo 'Trimestre actuel : Janvier/Fevrier/Mars '.$annee."";
          $trimestreavant = 4;
          echo '<br>';
          $annee = $annee -1;
          echo 'Facturation trimestre : Octobre/Novembre/Décembre '.$annee.'';
        }
        elseif($trimestre == 2)
        {
          echo 'Trimestre actuel : Avril/Mai/Juin '.$annee."";
          $trimestreavant = 1;
          echo 'Facturation trimestre : Janvier/Fevrier/Mars '.$annee.'';

        }
        elseif($trimestre == 3)
        {
          echo 'Trimestre actuel : Juillet/Aout/Septembre '.$annee."";
          $trimestreavant = 2;
          echo 'Facturation trimestre : Avril/Mai/Juin '.$annee.'';
        }
        elseif($trimestre == 4)
        {
          echo 'Trimestre actuel : Octobre/Novembre/Décembre '.$annee."";
          $trimestreavant = 3;
          echo 'Facturation trimestre : Juillet/Aout/Septembre '.$annee.'';
        }

      foreach($lesAdherents as $unAdherent)       //parcours des adherents
      {
        $prixreport = getreportparadherent($unAdherent['id'],$trimestreavant);

        $test = false;
        $année=date('Y');
        if($trimestre ==1)
        {
          $année = $année-1;
        }


        $prixtotal = 0;
        if ($prixreport > 0) {
          $prixtotal += $prixreport['prixReport'];
        }
        $nbtrajetcourt = Getnbtrajetcours($trimestreavant);            //recuperation du nombre de trajet (court,moyen,long) et si il est adheret
        $nbtrajetmoyen = Getnbtrajetmoyen($trimestreavant);
        $nbtrajetlong = Getnbtrajetlong($trimestreavant);
        $adhesion = Getadhesion();
        foreach($adhesion as $nbadhesion)
        {
          if($nbadhesion['idAdherent'] == $unAdherent['id'])  //ajout du prix de l'adhesion seulement si l'adhesion a eu lieux pendant ce trimestre
          {
            if($nbadhesion['nbTrajet'] == 1)    //regarde si il est adheret
            {
              if($trimestreavant == 1)
              {
                if($unAdherent['dateAdhesion'] > $année."-01-01" && $unAdherent['dateAdhesion'] < $année."-03-31")    //verifie si c'est bien pour le trimestre actuel
                {
                  $prixtotal += $prixadhesion['prix'];    //ajout prix

                }
              }
              if($trimestreavant == 2)
              {
                if($unAdherent['dateAdhesion'] > $année."-04-01" && $unAdherent['dateAdhesion'] < $année."-06-30")
                {
                  $prixtotal += $prixadhesion['prix'];
                }
              }
              if($trimestreavant == 3)
              {
                if($unAdherent['dateAdhesion'] > $année."07-01" && $unAdherent['dateAdhesion'] < $année."-09-30")
                {
                  $prixtotal += $prixadhesion['prix'];
                }
              }
              if($trimestreavant == 4)
              {
                if($unAdherent['dateAdhesion'] > $année."-10-01" && $unAdherent['dateAdhesion'] < $année."-12-31")
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
            if($trimestreavant == 1)
            {
            echo '<td>x</td>';
            }
            else {
              echo'<td></td>';

            }
          }
          elseif($unAdherent['id'] == $unadherent['id'] && $unadherent['dateAdhesion'] > $année."-04-01" && $unadherent['dateAdhesion'] < $année."-06-30")
          {
            if($trimestreavant == 2)
            {
            echo '<td>x</td>';
            }
            else {
            echo'<td></td>';
            }
          }
          elseif($unAdherent['id'] == $unadherent['id'] && $unadherent['dateAdhesion'] > $année."07-01" && $unadherent['dateAdhesion'] < $année."-09-30")
          {
            if($trimestreavant == 3)
            {
            echo '<td>x</td>';
            }
            else {
            echo'<td></td>';
            }
          }
          elseif($unAdherent['id'] == $unadherent['id'] && $unAdherent['dateAdhesion'] > $année."-10-01" && $unAdherent['dateAdhesion'] < $année."-12-31")
          {
            if($trimestreavant == 4)
            {
            echo '<td>x</td>';
            }
            else {
            echo'<td></td>';
            }
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
