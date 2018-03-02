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
    $annee = date('Y');
    $datedebut = $annee.'-01-01';
    $datefin = date('Y-m-d');

    $nb = getTotalFactureAnneEnCours($datedebut,$datefin);

   ?>
   <h2 style="text-align:center;">Statistique</h2>
   <div id="nbtrajetparan"  style="text-align:center;margin-top:15%;border:1px solid black;width:50%;margin-left:auto;margin-right:auto;">
     <?php
     echo '<p style="font-weight:bold;font-size:1.5em;">Facturation de janvier à aujourd\'hui : '.$nb['produit'].' €</p>';
     ?>
   </div>
   <form action="accueil.php"  id="annulerfacturation">
       <input style="margin-left:45%;margin-top:10px;" class="btn btn-info" onclick="history.go(-1)" type="submit" value="Retour">
   </form>
</body>
</html>
