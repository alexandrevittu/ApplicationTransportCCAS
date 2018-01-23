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
      $datenow = date('Y');                     //gestion de année passer a l'année suivante automatiquement
      $datedebutannée = $datenow.'-01-01';
      $datefinannée = $datenow.'-12-31';
      $nb = getNbTrajetParAn($datedebutannée,$datefinannée);
      echo $nb['nb'];

      
  ?>
</body>

</html>
