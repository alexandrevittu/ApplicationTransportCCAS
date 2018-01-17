<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Trimestre</title>

  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->

  <script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";

?>
<script language="javascript" type="text/javascript">
    $(document).ready(function() {
      $('#example').DataTable();
    } );
</script>
</head>
<body>
  <form method="post" id="listetrimestre">
    <select name="trimestre" onchange="submit();">
      <option value="0">Choisir trimestre
      <option value="1">Janvier/Fevrier/Mars
      <option value="2">Avril/Mai/Juin
      <option value="3">Juillet/Aout/Septembre
      <option value="4">Octobre/Novembre/Decembre
    </select>
  </form>
  <?php
if(isset($_POST['trimestre']))
{
    echo"<div class='content-loader' style='width: 70%;margin:5% 13%;'>";
    echo "<table cellpadding='0' cellspacing='0' border='0' class='table table-striped table-hover table-responsive no-footer table-bordered' id='example'>";
    echo "<thead>";
    echo "<tr><th>Nom</th><th>Prénom</th><th>Adresse</th><th>Ajout</th></tr></thead>";

    $lesAdherents = ListerAdherent();

    foreach($lesAdherents as $unAdherent)
    {
      $id=$unAdherent['id'];
      echo '<td>'.$unAdherent['nom'].'</td>';
      echo '<td>'.$unAdherent['prenom'].'</td>';
      echo '<td>'.$unAdherent['adresse'].'</td>';
      echo '<td><form action="addtrajet.php" id="addtrajet" method="POST"><input type="hidden" name="id" value='.$id.'><input type="hidden" name="trimestre" value='.$_POST["trimestre"].'><button class="btn btn-info" id="btn-view" type="submit"><span class=" glyphicon glyphicon-plus" ></span> &nbsp;Ajout</form></td>';
      echo '</tr>';
    }
}


   ?>
  </table>
  <form action="accueil.php">
      <input class="btn btn-info" type="submit" value="Annuler">
  </form>
</body>

</html>
