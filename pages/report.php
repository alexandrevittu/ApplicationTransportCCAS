<!DOCTYPE html>
<html>
<head>
  <title>Report</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";
  ?>
</head>
<script>
$(document).ready(function() {
  $('#example').DataTable({
    pagingType: "simple_numbers",
    lengthMenu:[5,10,15,20,25],       //affichage par default a 20 puis selection possible a 5,10,15,20,25
    pageLength: 20,
    fixedHeader: true,
  });
});
</script>
<body>
  <h2 style="text-align:center">Report</h2>
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

            if ($total < $leSeuil && $total != 0) {
              echo '<tr>';
              echo '<td>'.$unAdherent['nom'].'</td>';
              echo '<td>'.$unAdherent['prenom'].'</td>';
              echo '<td>'.$unAdherent['adresse'].'</td>';
              echo '<td>'.$total.' €</td>';
              $datederniertrajet = getDateDernierTrajet($unAdherent['id']);
              if (!empty($datederniertrajet['dateDernierTrajet'])) {
              echo '<td>'.$datederniertrajet['dateDernierTrajet'].'</td>';
              } else {
              echo '<td>Aucune date saisie</td>';
              }
            }

          }
          ?>
        </div>
      </tbody>
    </table>
    <form action="accueil.php" id="annulerfacturation">
      <input class="btn btn-info" onclick="history.go(-1)" type="submit" value="Retour">
    </form>
  </div>
</body>
</html>
