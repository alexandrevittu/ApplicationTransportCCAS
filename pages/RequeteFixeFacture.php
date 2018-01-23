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
      $nb = getTotalFactureAnneEnCours($datedebut,$datefinannée);
      var_dump($nb);
  ?>

</body>

</html>
