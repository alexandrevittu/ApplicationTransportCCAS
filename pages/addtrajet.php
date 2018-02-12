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
  <script language="javascript" type="text/javascript">

  $(document).ready(function() {


  $( "#ajouttrajet" ).submit(function( event ) {
  if (confirm("Êtes vous sûr de vouloir ajouter ces trajets ?")==true) {    //confirmation de l'ajout de trajet
    window.location = 'Trimestre.php';
    $(document).on('submit', '#ajouttrajet', function () {

      $.post("Trimestre.php", $(this).serialize())
      .done(function (data) {
        $("#dis").fadeOut();
        $("#dis").fadeIn('slow', function () {
          if (data === "Ajout reussie") {
            $("#dis").html('<div class="alert alert-info">' + data + '</div>');
          } else {
            $("#dis").html('<div class="alert alert-danger">' + data + '</div>');
          }
          $("#ajouttrajet")[0];
        });
      });
      return false;
    });
  }
  event.preventDefault();
});
} );
</script>
</head>
<body>
  <h2 style="text-align:center;">Ajout trajets</h2>

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
      <button class="btn btn-info" type="submit" >Valider</button>
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
