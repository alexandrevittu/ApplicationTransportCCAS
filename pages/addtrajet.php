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
    $libelleTrimestre = getTrimestreLib($_POST['trimestre']);
    var_dump($libelleTrimestre);
  ?>
</head>
<body>
  <div id="conteneur">
    <!--Creation du formulaire -->
    <form action="Trimestre.php" id="ajouttrajet" method="POST">
      <hr class="style-ligne">
      <h4><?php echo $_POST['nom']." ".$_POST['prenom']."<br>".utf8_encode($libelleTrimestre['libelle']); ?> </h4>
      <input type="hidden" name="id" id="id" value="<?php echo$idadherent?>"/></br>
      <input type="hidden" name="trimestre" id="trimestre" value="<?php echo$trimestre?>"/></br>
      <label for="trajetcourt">Nombre de trajet court : </label></br>
      <input type="number" name="trajetcourt" id="trajetcourt"/></br>
      <label for="trajetmoyen">Nombre de trajet moyen : </label></br>
      <input type="number" name="trajetmoyen" id="trajetmoyen"/></br>
      <label for="trajetlong">Nombre de trajet long : </label></br>
      <input type="number" name="trajetlong" id="trajetlong"/></br>
      <?php
      //echo '<input type="hidden" name="trimestre" value='.$_POST['trimestre'].'>';
      ?>
      <input class="btn btn-info" type="submit" value="Valider"/>

    </form>
    <form action="Trimestre.php" id="ajouttrajet" method="POST">
      <?php
        echo '<input type="hidden" name="trimestre" value='.$trimestre.'>';
      ?>
      <button class="btn btn-info" type="submit">Retour</button>
    </form>
    <hr class="style-ligne">
  </div>
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
