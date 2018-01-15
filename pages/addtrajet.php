<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>add trajet</title>
    <?php
    include_once "header.php";
    include_once "../fonctions/fonctions.php";


    $ladherent = GetAdherent($_POST['id']);
    $idadherent =$_POST['id'];
    $trimestre =$_POST['trimestre'];

    ?>
</head>
<body>
  <div class="content-loader" style="width: 70%;margin:5% 20%;">
  <form id="ajouttrajet" method="POST">
    <input type="hidden" name="id" id="id" value="<?php echo$idadherent?>"/></br>
    <input type="hidden" name="trimestre" id="trimestre" value="<?php echo$trimestre?>"/></br>
    Nombre de trajet court :<input type="number" name="trajetcourt" id="trajetcourt"/></br>
    Nombre de trajet moyen :<input type="number" name="trajetmoyen" id="trajetmoyen"/></br>
    Nombre de trajet long :<input type="number" name="trajetlong" id="trajetlong"/></br>
    <input class="btn btn-default" type="submit" value="Valider"/>
  </form>
  <?php
    $nbtrajetmoyen = Getnbtrajetmoyenparadherent($idadherent,$trimestre);
    $nbtrajetcourt = Getnbtrajetcourtparadherent($idadherent,$trimestre);
    $nbtrajetlong = Getnbtrajetlongparadherent($idadherent,$trimestre);
    echo $nbtrajetmoyen['nbTrajet'];
    echo $nbtrajetcourt['nbTrajet'];
    echo $nbtrajetlong['nbTrajet'];
    echo"<script>document.getElementById('trajetcourt').value=".$nbtrajetcourt['nbTrajet']."</script>";
    echo"<script>document.getElementById('trajetmoyen').value=".$nbtrajetmoyen['nbTrajet']."</script>";
    echo"<script>document.getElementById('trajetlong').value=".$nbtrajetlong['nbTrajet']."</script>";

    if(isset($_POST['trajetcourt']))
    {
    ModifTrajetCourtParAdherent($_POST['id'],$_POST['trimestre'],$_POST['trajetcourt']);
    }


  ?>
</body>

</html>
