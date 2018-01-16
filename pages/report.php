<!DOCTYPE html>
<html>
<head>
  <title>Report</title>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";
  ?>
</head>
<body>
  <div class="content-loader" style="width: 70%;margin:5% 13%;">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse</th>
          <th>Somme</th>
          <th>Date dernier trajet</th>
        </tr>
      </thead>
      <tbody>
        <div>
          <?php
          $lesAdherents = ListerAdherent();

          $seuil = getSeuil();

          $prixCourt = Getprixtrajetlong();
          $prixMoyen = Getprixtrajetmoyen();
          $prixLong = Getprixtrajetcours();

          /*var_dump((double)$prixCourt['prix']);
          var_dump((double)$prixMoyen['prix']);
          var_dump((double)$prixLong['prix']);
          var_dump((double)$seuil['prix']);*/

          $court = (double)$prixCourt['prix'];
          $long = (double)$prixLong['prix'];
          $moyen = (double)$prixMoyen['prix'];


          foreach($lesAdherents as $unAdherent){

            $adhesion = 0;

            $adTrajetCours = getNbTrajetCourtAdherent($unAdherent['id']);
            $adTrajetMoyen = getNbTrajetMoyenAdherent($unAdherent['id']);
            $adTrajetLong = getNbTrajetLongAdherent($unAdherent['id']);

            $trCourt = (double)$adTrajetCours['nbTrajetCourt'];
            $trMoy = (double)$adTrajetMoyen['nbTrajetCourt'];
            $trLong = (double)$adTrajetLong['nbTrajetCourt'];

            $total = ($trCourt*$court)+($trMoy*$moyen)+($trLong*$long);

            var_dump($total);

          }
          ?>
        </div>
      </tbody>
      <tfoot>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Adresse</th>
        <th>Somme</th>
        <th>Date dernier trajet</th>  
      </tfoot>
    </table>
  </div> 
</body>
</html>
