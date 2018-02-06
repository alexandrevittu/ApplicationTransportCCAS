<!DOCTYPE html>
<html>
<head>
  <title>nombre de trajet depuis un an</title>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";
  ?>
</head>
<body>
  <?php
      $annéenow = date('Y');
      $moisjournow = date('m-d');
      $annéedebut = $annéenow -1 ;
      $datedebut = $annéedebut.'-'.$moisjournow;
      $datefinannée = date('Y-m-d');
      $nb = getTotalFactureAnneEnCours($datedebut,$datefinannée);
  ?>
  <div style="text-align:center;margin-top:15%;border:1px solid black;width:50%;margin-left:auto;margin-right:auto;"><p style="font-weight:bold;font-size:1.5em;">Le totale de la facturation de cette année s'éléve à <?php echo $nb['produit'] ?> €</div>
  <form action="accueil.php"  id="annulerfacturation">
      <input style="margin-left:45%;margin-top:10px;" class="btn btn-info" onclick="history.go(-1)" type="submit" value="Retour">
  </form>
</body>

</html>
