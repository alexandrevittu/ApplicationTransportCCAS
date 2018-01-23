<!DOCTYPE html>
<html>
<head>
  <title>nombre de trajet depuis un an</title>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";
  ?>
</head>
<body>
  <?php
      $annéenow = date('Y');
      $moisjournow = date('m-d');
      $annéedebut = $annéenow -1 ;
      $datedebut = $annéedebut.'-'.$moisjournow;
      $datefinannée = date('Y-m-d');
      $nb = getNbTrajetParAn($datedebut,$datefinannée);
  ?>
  <div id="nbtrajetparan" style="width: 70%;margin:5% 20%;">
    <?php
    echo '<label>Nombre de trajet depuis un an : '.$nb['nb'].'</label>';
    ?>
  </div>
</body>

</html>
