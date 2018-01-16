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
<<<<<<< HEAD
  <div class="content-loader" style="width: 50%;margin:5% 20%;">
    <hr class="style-ligne">
    <form id="tarif" method="POST">
      <label for="fseuil">Seuil du report du trimestre</label><br>
      <input type="number" name="seuil" step="0.1" id="seuil"/></br>
      <label for="fcourt">Tarif trajet court</label><br> 
      <input type="number" name="trajetcourt" step="0.1" id="court"/></br>
      <label for="fmoyen">Tarif trajet moyen</label><br>
      <input type="number" name="trajetmoyen" step="0.1" id="moyen"/></br>
      <label for="flong">Tarif trajet long</label><br>
      <input type="number" name="trajetlong" step="0.1" id="long"/></br>
      <label for="fadhesion">Tarif de l'adhésion</label><br>
      <input type="number" name="tarifadhesion" step="0.1" id="adhesion"/></br>
      <p><input class="" type="submit" value="Valider"/></p>
    </form>
    <?php
    if(isset($_POST["trajetcourt"]))
    {
      ModifSeuil($_POST["seuil"]);
      ModifTarifCourt($_POST["trajetcourt"]);
      ModifTarifMoyen($_POST["trajetmoyen"]);
      ModifTarifLong($_POST["trajetlong"]);
      ModifTarifAdhesion($_POST["tarifadhesion"]);
      echo'<script>';
      echo"window.setTimeout(location=('accueil.php'), 6)";
      echo'</script>';
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

    <input class="" id="btn_tarifRetour" type="submit" onclick="history.go(-1)" value="Retour">

    <?php
=======
  <div class="content-loader" style="width: 70%;margin:5% 20%;">
  <form id="tarif" method="POST">
    Seuil du report du trimestre :<input type="number" name="seuil" step="0.1" id="seuil"/></br>
    Tarif trajet court :<input type="number" name="trajetcourt" step="0.1" id="court"/></br>
    Tarif trajet moyen :<input type="number" name="trajetmoyen" step="0.1" id="moyen"/></br>
    Tarif trajet long :<input type="number" name="trajetlong" step="0.1" id="long"/></br>
    Tarif de l'adhésion :<input type="number" name="tarifadhesion" step="0.1" id="adhesion"/></br>
    <p><input class="btn btn-default" type="submit" value="Valider"/></p>
  </form>
  <?php
  if(isset($_POST["trajetcourt"]))
  {
    ModifSeuil($_POST["seuil"]);
    ModifTarifCourt($_POST["trajetcourt"]);
    ModifTarifMoyen($_POST["trajetmoyen"]);
    ModifTarifLong($_POST["trajetlong"]);
    ModifTarifAdhesion($_POST["tarifadhesion"]);
    echo'<script>';
    echo"window.setTimeout(location=('accueil.php'), 10)";
    echo'</script>';
>>>>>>> 3213b3b776eab15642c707e9dc4cd0c74bb88f73
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
  <hr class="style-ligne">
  </div>
</body>
</html>
