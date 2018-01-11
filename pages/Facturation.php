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
<?php
  foreach($lesAdherents as $unAdherent)
  {
    echo $unAdherent['nom'];
    $nbtrajetcourt = Getnbtrajetcours($unAdherent['id']);
    var_dump ($nbtrajetcourt);
  }

?>

</body>

</html>
