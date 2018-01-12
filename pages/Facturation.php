<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Facturation</title>
</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";
$lesAdherents = ListerAdherent();
?>
<body>
  <div class="content-loader" style="width: 70%;margin:5% 13%;">
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

    echo '<td>'.$unAdherent['nom'].'</td>';
    echo '<td>'.$unAdherent['prenom'].'</td>';
    echo '<td>'.$unAdherent['adresse'].'</td>';

    foreach($adhesion as $nbadhesion)
    {
      if($nbadhesion['idAdherent'] == $unAdherent['id'])
      {
        if($nbadhesion['nbTrajet'] == 1)
        {
          $prixtotal += $prixadhesion['prix'];
          echo '<td>x</td>';
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
        //echo '</br>'.$prixtotal = $nbtrajetcourtparadherent['nbTrajet'] * $prixtrajetcours['prix'];
        echo '<td>'.$nbtrajetcourtparadherent['nbTrajet'].'</td>';
       }
     }
     foreach($nbtrajetmoyen as $nbtrajetmoyenparadherent)
     {
       if($nbtrajetmoyenparadherent['idAdherent'] == $unAdherent['id'])
       {
         $prixtotal += $nbtrajetmoyenparadherent['nbTrajet']*$prixtrajetmoyen['prix'];
         echo '<td>'.$nbtrajetmoyenparadherent['nbTrajet'].'</td>';
       }
     }
     foreach($nbtrajetlong as $nbtrajetlongparadherent)
     {
       if($nbtrajetlongparadherent['idAdherent'] == $unAdherent['id'])
       {
         $prixtotal += $nbtrajetlongparadherent['nbTrajet']*$prixtrajetlong['prix'];
         echo '<td>'.$nbtrajetlongparadherent['nbTrajet'].'</td>';
         echo '<td>'.$prixtotal.' €</td>';
         echo '</tr>';
         $prixglobal += $prixtotal;
       }
     }


    }
    echo'</table>';
    echo "<p id='prixglobal'>Total global : $prixglobal €</p>";
?>
<form action="accueil.php" id="annulerfacturation">
    <input class="btn btn-default" type="submit" value="accueil">
    <a class="btn btn-default" href="#" onclick="window.print(); return false;">Imprimer cette page</a>
</form>
</body>

</html>
