<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>add trajet</title>
    <?php
    include_once "header.php";
    include_once "../fonctions/fonctions.php";

    
    $ladherent = GetAdherent($_POST['id']);


    ?>
</head>
<body>
  <div class="content-loader" style="width: 70%;margin:5% 20%;">
  <form id="ajouttrajet" method="POST">
    Nombre de trajet court :<input type="number" name="trajetcourt" id="trajetcourt"/></br>
    Nombre de trajet moyen :<input type="number" name="trajetmoyen" id="trajetmoyen"/></br>
    Nombre de trajet long :<input type="number" name="trajetlong" id="trajetlong"/></br>
    <input class="btn btn-default" type="submit" value="Valider"/>
  </form>
  <?php
    $nbtrajetmoyen = Getnbtrajetmoyenparadherent($_POST['id'],$_POST['trimestre']);
    $nbtrajetcourt = Getnbtrajetcourtparadherent($_POST['id'],$_POST['trimestre']);
    $nbtrajetlong = Getnbtrajetlongparadherent($_POST['id'],$_POST['trimestre']);
    echo $nbtrajetmoyen['nbTrajet'];
    echo $nbtrajetcourt['nbTrajet'];
    echo $nbtrajetlong['nbTrajet'];
    echo"<script>document.getElementById('trajetcourt').value=".$nbtrajetcourt['nbTrajet']."</script>";
    echo"<script>document.getElementById('trajetmoyen').value=".$nbtrajetmoyen['nbTrajet']."</script>";
    echo"<script>document.getElementById('trajetlong').value=".$nbtrajetlong['nbTrajet']."</script>";


  ?>
</body>

</html>
