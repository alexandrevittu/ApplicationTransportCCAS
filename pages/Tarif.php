<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Tarifs</title>
</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";
?>

<body>
  <form id="tarif" method="POST">
    <label>Seuil du report du trimestre : </label><input type="number" name="seuil" step="0.1" id="seuil"/></br>
    <label>Tarif trajet court : </label><input type="number" name="trajetcourt" step="0.1" id="court"/></br>
    <label>Tarif trajet moyen : </label><input type="number" name="trajetmoyen" step="0.1" id="moyen"/></br>
    <label>Tarif trajet long : </label><input type="number" name="trajetlong" step="0.1" id="long"/></br>
    <label>Tarif de l'adhésion : </label><input type="number" name="tarifadhesion" step="0.1" id="adhesion"/></br>
    <p><input type="submit" value="Valider"/></p>
  </form>
  <?php
  if(isset($_POST["trajetcourt"]))
  {
    ModifSeuil($_POST["seuil"]);
    ModifTarifCourt($_POST["trajetcourt"]);
    ModifTarifMoyen($_POST["trajetmoyen"]);
    ModifTarifLong($_POST["trajetlong"]);
    ModifTarifAdhesion($_POST["tarifadhesion"]);
    $i=0;
    $lestarifs = GetTarif();
    foreach ($lestarifs as $tarif)
    {
      echo'<script>';
      if($i==0){
      echo"document.getElementById('seuil').value=".$tarif['prix'];
      }
      if($i==1){
      echo"document.getElementById('court').value=".$tarif['prix'];
      }
      if($i==2){
      echo"document.getElementById('moyen').value=".$tarif['prix'];
      }
      if($i==3){
      echo"document.getElementById('long').value=".$tarif['prix'];
      }
      if($i==4){
      echo"document.getElementById('adhesion').value=".$tarif['prix'];
      }
      echo'</script>';
      $i++;
    }
  }

  ?>
  <form action="accueil.php">
      <input type="submit" value="Annuler">
  </form>
<?php
$i=0;
$lestarifs = GetTarif();
foreach ($lestarifs as $tarif)
{
  echo'<script>';
  if($i==0){
  echo"document.getElementById('seuil').value=".$tarif['prix'];
  }
  if($i==1){
  echo"document.getElementById('court').value=".$tarif['prix'];
  }
  if($i==2){
  echo"document.getElementById('moyen').value=".$tarif['prix'];
  }
  if($i==3){
  echo"document.getElementById('long').value=".$tarif['prix'];
  }
  if($i==4){
  echo"document.getElementById('adhesion').value=".$tarif['prix'];
  }
  echo'</script>';
  $i++;
}
?>

</body>
</html>
