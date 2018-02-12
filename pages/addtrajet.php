<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>add trajet</title>
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
<script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
  <?php
    include_once "header.php";
    include_once "../fonctions/fonctions.php";

    $ladherent = GetAdherent($_POST['id']);   //recuperation de l'adherent et du trimestre
    $idadherent =$_POST['id'];
    $trimestre =$_POST['trimestre'];
    $libelleTrimestre = getTrimestreLib($_POST['trimestre']);
  ?>
  <script>
    $(function() {
     $("#testbtn").click(function(){
       if(confirm("Etes vous sur de vouloir ajouter ces trajets ?")==true)
       {
          $("#ajouttrajet").submit();
       }
       else {
       }
     });
    });
    </script>
</head>
<body>
  <h2 style="text-align:center;">Ajout trajets</h2>
  <div id="dis"></div>


  <div id="conteneur">
    <!--Creation du formulaire -->
    <form action="Trimestre.php" id="ajouttrajet" method="POST">
      <h4><strong><?php echo "Nom : ".$_POST['nom']."<br> Prenom : ".$_POST['prenom'] ?><strong></h4>
      <hr class="style-ligne">
      <h4><?php echo utf8_encode($libelleTrimestre['libelle']); ?> </h4>
      <input type="hidden" name="id" id="id" value="<?php echo$idadherent?>"/></br>
      <input type="hidden" name="trimestre" id="trimestre" value="<?php echo$trimestre?>"/></br>
      <label for="trajetcourt">Nombre de trajet court : </label></br>
      <input type="number" name="trajetcourt" id="trajetcourt"/></br>
      <label for="trajetmoyen">Nombre de trajet moyen : </label></br>
      <input type="number" name="trajetmoyen" id="trajetmoyen"/></br>
      <label for="trajetlong">Nombre de trajet long : </label></br>
      <input type="number" name="trajetlong" id="trajetlong"/></br>
      <input type="hidden" name="tri" value="1"/>
      <?php
      //echo '<input type="hidden" name="trimestre" value='.$trimestre.'>';
      ?>
      <input  id="testbtn" class="btn btn-info" type="button" value="Valider">
      <!--    <button id="testbtn" class="btn btn-info" >Valider</button>     -->
    </form>

    <form action="Trimestre.php" method="POST">
      <?php
        echo '<input type="hidden" name="trimestre" value='.$trimestre.'>';
      ?>
      <br><button class="btn btn-info" type="submit">Retour</button>
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
