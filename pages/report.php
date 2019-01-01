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
          $lesAdherents = ListerAdherent(); // on appel la fonction qui liste tout les adherents

          $seuil = getSeuil(); // retourne le sueil actuel
          $leSeuil = (double)$seuil['prix']; //casté en double

          $prixCourt = Getprixtrajetcours();
          $prixMoyen = Getprixtrajetmoyen();  // 3 fonctions qui retourne le tarifs court,moyen et long
          $prixLong = Getprixtrajetlong();
          $court = (double)$prixCourt['prix'];
          $long = (double)$prixLong['prix'];    //catés en double
          $moyen = (double)$prixMoyen['prix'];


          foreach($lesAdherents as $unAdherent){
            // updateReport($unAdherent['id'],0);
            $adhesion = 0;
            $trimestreActuel = getTrimestre(); // retourne le trimestre actuel

            if ($trimestreActuel == 1) {
              $trimestreAvant = 4;
            }elseif ($trimestreActuel == 2) {
              $trimestreAvant = 1;
            }elseif ($trimestreActuel == 3) {
              $trimestreAvant = 2;
            }
            else {
              $trimestreAvant = 3;
            }

            $adTrajetCours = getNbTrajetCourtAdherentTrimestreActuel($unAdherent['id'],$trimestreAvant);
            $adTrajetMoyen = getNbTrajetMoyenAdherentTrimestreActuel($unAdherent['id'],$trimestreAvant);    //affichage du nombre de trajet court,moyen et long par adhérent.
            $adTrajetLong = getNbTrajetLongAdherentTrimestreActuel($unAdherent['id'],$trimestreAvant);

            $trCourt = (double)$adTrajetCours['nbTrajetCourt'];
            $trMoy = (double)$adTrajetMoyen['nbTrajetCourt'];            //On caste ceci en double
            $trLong = (double)$adTrajetLong['nbTrajetCourt'];

            $total = ($trCourt*$court)+($trMoy*$moyen)+($trLong*$long);      //l'addition des produits de trajet court, moyen et long

            $dateAdhesion = getDateAdhesion($unAdherent['id']); //retourne la date d'adhésion de l'adherent passé en paramètre.
            $dateAdhesionTrimestre = getTrimestreDate($dateAdhesion); //retourne le trimestre en fonction de la date saisie

            $prixAdhe = Getprixadhesion(); //retourne le prix de l'adhesion

             $prixDouble = (double)$prixAdhe['prix'];
               // if($dateAdhesionTrimestre == $trimestreActuel){  // Verifie si  la date d'adhesion a ete fait dans le trimestre actuel si oui on ajoute le prix de l'adhesion
               //   $total += $prixDouble;
               // }
              $annee = date('Y');

             if($trimestreAvant == 1){
               if ($dateAdhesion['dateAdhesion']>=$annee."-01-01" && $dateAdhesion['dateAdhesion'] <= $annee."-03-31") {
                 $total += $prixDouble;
               }
             }
             else if ($trimestreAvant == 2) {
               if ($dateAdhesion['dateAdhesion']>=$annee."-04-01" && $dateAdhesion['dateAdhesion'] <= $annee."-06-30") {
                 $total += $prixDouble;
               }
             }
             else if ($trimestreAvant == 3) {
               if ($dateAdhesion['dateAdhesion']>=$annee."-07-01" && $dateAdhesion['dateAdhesion'] <= $annee."-09-30") {
                 $total += $prixDouble;
               }
             }
             elseif ($trimestreAvant == 4) {
               if ($dateAdhesion['dateAdhesion']>=$annee."-10-01" && $dateAdhesion['dateAdhesion'] <= $annee."-12-31") {
                 $total += $prixDouble;
               }
             }

             $prix = getreportparadherent($unAdherent['id'],$trimestreAvant);
             $total += $prix['prixReport'];

             if($total > 15)
             {
               updateReport($unAdherent['id'],0,$trimestreActuel);

             }

            if ($total < $leSeuil && $total != 0) {  //On affiche si seulement si le total est en dessous du sueil et que le total est different de 0
              updateReport($unAdherent['id'],$total,$trimestreActuel);

              echo '<tr>';
              echo '<td>'.$unAdherent['nom'].'</td>';
              echo '<td>'.$unAdherent['prenom'].'</td>';
              echo '<td>'.$unAdherent['adresse'].'</td>';
              echo '<td>'.$total.' €</td>';
              $datederniertrajet = getDateDernierTrajet($unAdherent['id']);  // retourne la date du dernier trajet effecetué
              if (!empty($datederniertrajet['dateDernierTrajet'])) {
              echo '<td>'.$datederniertrajet['dateDernierTrajet'].'</td>';
              } else {
              echo '<td>Aucune date saisie</td>'; //gerer exception si jamais il n'y a pas de date.
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
