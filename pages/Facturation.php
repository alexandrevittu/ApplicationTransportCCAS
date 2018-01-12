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
  var_dump( $trimestre);

  foreach($lesAdherents as $unAdherent)
  {

    $nbtrajetcourt = Getnbtrajetcours($trimestre);
    echo '<td>'.$unAdherent['nom'].'</td>';
    echo '<td>'.$unAdherent['prenom'].'</td>';
    echo '<td>'.$unAdherent['adresse'].'</td>';
    $i ='fjabj';
    $j = null;
    $fin = null;
    foreach($nbtrajetcourt as $nbtrajetcourtparadherent)
    {
      //var_dump($nbtrajetcourtparadherent);

      if($nbtrajetcourtparadherent['idAdherent'] == $unAdherent['id'])
      {

        var_dump($nbtrajetcourtparadherent);
        echo '<td>'.$nbtrajetcourtparadherent['nbTrajet'].'</td>';
        $i = null;
      }
      elseif($nbtrajetcourtparadherent['idAdherent'] != $unAdherent['id'])
      {
        /*if($i == null && $j !=null)
        {
          echo '<td>0</td>';
          $j = 'aze';
        }
        elseif($i != null && $j ==null && $fin == null)
        {
          $fin = 'aze';
        }
        elseif($i == null && $j ==null)
        {
        }
        elseif ($fin != null)
        {
          echo '<td>1</td>';
          $fin = null;
        }
        else
        {
        }*/
      }
      }

    }



?>

</body>

</html>
