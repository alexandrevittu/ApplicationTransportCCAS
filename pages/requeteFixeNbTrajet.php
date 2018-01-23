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
  <div id="nbtrajetparan"  style="text-align:center;margin-top:25%;border:1px solid black;width:50%;margin-left:auto;margin-right:auto;">
    <?php
    echo '<p style="font-weight:bold;font-size:1.5em;">Nombre de trajet depuis un an : '.$nb['nb'].'</p>';
    ?>
  </div>
</body>

</html>
