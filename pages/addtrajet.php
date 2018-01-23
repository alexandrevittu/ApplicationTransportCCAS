<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>add trajet</title>
  <?php
    include_once "header.php";
    include_once "../fonctions/fonctions.php";

    $ladherent = GetAdherent($_POST['id']);   //recuperation de l'adherent et du trimestre
    $idadherent =$_POST['id'];
    $trimestre =$_POST['trimestre'];
  ?>
</head>
<body>
  <div class="content-loader" style="width: 70%;margin:5% 20%;">
    <hr class="style-ligne">    <!--Creation du formulaire -->
    <form action="Trimestre.php" id="ajouttrajet" method="POST">
      <input type="hidden" name="id" id="id" value="<?php echo$idadherent?>"/></br>
      <input type="hidden" name="trimestre" id="trimestre" value="<?php echo$trimestre?>"/></br>
      Nombre de trajet court : <input type="number" name="trajetcourt" id="trajetcourt"/></br>
      Nombre de trajet moyen : <input type="number" name="trajetmoyen" id="trajetmoyen"/></br>
      Nombre de trajet long : <input type="number" name="trajetlong" id="trajetlong"/></br>
      <?php
      //echo '<input type="hidden" name="trimestre" value='.$_POST['trimestre'].'>';
      ?>
      <input class="btn btn-info" type="submit" value="Valider"/>
      <button class="btn btn-danger" type="button" onclick="history.go(-1);"/>Retour</button>
    </form>
    <?php
      $nbtrajetmoyen = Getnbtrajetmoyenparadherent($idadherent,$trimestre); //recuperation des nombre de trajet de l'adherent
      $nbtrajetcourt = Getnbtrajetcourtparadherent($idadherent,$trimestre);
      $nbtrajetlong = Getnbtrajetlongparadherent($idadherent,$trimestre);
      echo"<script>document.getElementById('trajetcourt').value=".$nbtrajetcourt['nbTrajet']."</script>"; //affichage dans le formulaire
      echo"<script>document.getElementById('trajetmoyen').value=".$nbtrajetmoyen['nbTrajet']."</script>";
      echo"<script>document.getElementById('trajetlong').value=".$nbtrajetlong['nbTrajet']."</script>";


    ?>
</body>
</html>
