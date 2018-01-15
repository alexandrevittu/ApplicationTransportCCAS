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

          foreach($lesAdherents as $unAdherent){

            $getCourt = getNbTrajetCourtAdherent($unAdherent['id']);
            $courtTotal = $getCourt * $prixCourt;
            $moyenTotal = getNbTrajetMoyenAdherent($unAdherent['id'])*$prixMoyen;
            $longTotal = getNbTrajetLongAdherent($unAdherent['id'])*$prixLong;
            
            var_dump($courtTotal+$moyenTotal+$longTotal);

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
