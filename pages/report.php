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
  <div class="content-loader"  style="width: 70%;margin:10% 13%;">
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
          $leSeuil = (double)$seuil['prix'];
          $prixCourt = Getprixtrajetcours();
          $prixMoyen = Getprixtrajetmoyen();
          $prixLong = Getprixtrajetlong();

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

            $adhesionPayee = adhesionPayee($unAdherent['id']);
            $adhPay = (double)$adhesionPayee['nbTrajet'];

            if ($adhesionPayee == '1') {
              $total = $total + $adhPay;
            }

            if ($total < $leSeuil) {
              echo '<tr>';
              echo '<td>'.$unAdherent['nom'].'</td>';
              echo '<td>'.$unAdherent['prenom'].'</td>';
              echo '<td>'.$unAdherent['adresse'].'</td>';
              echo '<td>'.$total.'</td>';
              echo '<td>En cours</td></tr>';
            }

          }
          ?>
        </div>
      </tbody>
    </table>
    <form>
      <input id="retourReport" class="btn btn-info" type="button" value="Retour" onclick="history.go(-1)">
      <a class="btn btn-info" href="#" onclick="window.print(); return false;">Imprimer cette page</a>
    </form>
  </div>
</body>
</html>
