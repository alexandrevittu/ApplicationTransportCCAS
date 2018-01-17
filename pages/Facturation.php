<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Facturation</title>
  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>

</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";
$lesAdherents = ListerAdherent();
?>
<script language="javascript" type="text/javascript">
$(document).ready(function() {
  $('#example').dataTable( {
  "dom": 'lrtip'
} );

} );
</script>
<body>
  <div class="content-loader" style="width: 70%;margin:10% 13%;">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">
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
<?php
  $trimestre = getTrimestre();
  $prixtrajetcours = Getprixtrajetcours();
  $prixtrajetmoyen = Getprixtrajetmoyen();
  $prixtrajetlong = Getprixtrajetlong();
  $prixadhesion = Getprixadhesion();
  $prixglobal = 0;
  foreach($lesAdherents as $unAdherent)
  {
    $prixtotal = 0;
    $nbtrajetcourt = Getnbtrajetcours($trimestre);
    $nbtrajetmoyen = Getnbtrajetmoyen($trimestre);
    $nbtrajetlong = Getnbtrajetlong($trimestre);
    $adhesion = Getadhesion();


    foreach($adhesion as $nbadhesion)
    {
      if($nbadhesion['idAdherent'] == $unAdherent['id'])
      {
        if($nbadhesion['nbTrajet'] == 1)
        {
          $prixtotal += $prixadhesion['prix'];
        }

       else
       {
         echo'<td></td>';
       }
     }
   }
    foreach($nbtrajetcourt as $nbtrajetcourtparadherent)
    {
      if($nbtrajetcourtparadherent['idAdherent'] == $unAdherent['id'])
      {
        $prixtotal += $nbtrajetcourtparadherent['nbTrajet']*$prixtrajetcours['prix'];
       }
     }
     foreach($nbtrajetmoyen as $nbtrajetmoyenparadherent)
     {
       if($nbtrajetmoyenparadherent['idAdherent'] == $unAdherent['id'])
       {
         $prixtotal += $nbtrajetmoyenparadherent['nbTrajet']*$prixtrajetmoyen['prix'];

       }
     }
     foreach($nbtrajetlong as $nbtrajetlongparadherent)
     {
       if($nbtrajetlongparadherent['idAdherent'] == $unAdherent['id'])
       {
         $prixtotal += $nbtrajetlongparadherent['nbTrajet']*$prixtrajetlong['prix'];
       }

     }
     if($prixtotal >= 15)
     {
       echo '<td>'.$unAdherent['nom'].'</td>';
       echo '<td>'.$unAdherent['prenom'].'</td>';
       echo '<td>'.$unAdherent['adresse'].'</td>';
       echo '<td>x</td>';
       foreach($nbtrajetcourt as $nbtrajetcourtparadherent)
       {
         if($nbtrajetcourtparadherent['idAdherent'] == $unAdherent['id'])
         {
           echo '<td>'.$nbtrajetcourtparadherent['nbTrajet'].'</td>';
          }
        }
        foreach($nbtrajetmoyen as $nbtrajetmoyenparadherent)
        {
          if($nbtrajetmoyenparadherent['idAdherent'] == $unAdherent['id'])
          {
            echo '<td>'.$nbtrajetmoyenparadherent['nbTrajet'].'</td>';
          }
        }
        foreach($nbtrajetlong as $nbtrajetlongparadherent)
        {
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
    echo'</table>';
    echo "<p id='prixglobal'>Total global : $prixglobal €</p>";
?>
<form action="accueil.php" id="annulerfacturation">
    <input type="button" value="Retour" class="btn btn-info" onclick="history.go(-1)">
    <a class="btn btn-info" href="#" onclick="window.print(); return false;">Imprimer cette page</a>
</form>
</body>

</html>
