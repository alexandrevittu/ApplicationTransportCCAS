<!DOCTYPE html>
<html>
<head>
  <title>Requêtes multicritères</title>
</head>
<body>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";
  ?>
 <?php
  $annéeencours = date('Y');
 ?>
 <h2 style="text-align:center;">Statistique</h2>
 <form method="POST" style='width: 70%;margin:5% 35%'>        <!--selection de l'année et du type-->
   <select name="année" id="année" >
     <option value="0">Sélectionner une année
     <option value="<?php echo $annéeencours;?>"><?php echo $annéeencours; ?>
     <option value="<?php echo $annéeencours-1; ?>"><?php echo $annéeencours-1; ?>
     <option value="<?php echo $annéeencours-2; ?>"><?php echo $annéeencours-2; ?>
   </select>
   <select name="type" id="type" >
     <option value="0">Sélectioner type
     <option value="2">Court
     <option value="3">Moyen
     <option value="4">Long
     <option value="5">Somme Facturation
    </select>
    <input class="btn btn-info" type='submit' value="Valider"/>
    <input  class="btn btn-info" onclick="window.location.href='accueil.php'" type="button"  value="Accueil">
  </form>
  <?php
    if(isset($_POST['type']) && $_POST['type']<=4)    //recuperation des nombre de trajet
    {
      $datedebut = $_POST['année'].'-01-01';
      $datefin = $_POST['année'].'-12-31';
      $trajetentableau = getTrajetMulticriteres($_POST['type'],$datedebut,$datefin);
      ?>
      <div style="text-align:center;margin-top:10%;border:1px solid black;width:50%;margin-left:auto;margin-right:auto;"><p style="font-weight:bold;font-size:1.5em;">
      <?php
      if($trajetentableau['nb']==0)
      {
        echo 'il n\'y a aucun trajet de se type pour cette année.';
      }
      if($_POST['type']==2 && $trajetentableau['nb']!=0)
      {
      echo 'Le nombre de trajet courts pour l\'année '.$_POST['année'].' est de : '.$trajetentableau['nb'];
      }
      if($_POST['type']==3 && $trajetentableau['nb']!=0)
      {
      echo 'Le nombre de trajet moyens pour l\'année '.$_POST['année'].' est de : '.$trajetentableau['nb'];
      }
      if($_POST['type']==4 && $trajetentableau['nb']!=0)
      {
      echo 'Le nombre de trajet longs pour l\'année '.$_POST['année'].' est de : '.$trajetentableau['nb'];
      }
      echo '</div>';
    }

    elseif(isset($_POST['type']))   //recuperation de la facture
    {
      $datedebut = $_POST['année'].'-01-01';
      $datefin = $_POST['année'].'-12-31';
      $sommefactuentableau = getTotalFactureAnneEnCours($datedebut,$datefin);
      ?>
      <div style="text-align:center;margin-top:10%;border:1px solid black;width:50%;margin-left:auto;margin-right:auto;"><p style="font-weight:bold;font-size:1.5em;">
      <?php
      if($sommefactuentableau['produit']!=0)
      {
        echo 'La somme des facturations pour l\'année '.$_POST['année'].' est de : '.$sommefactuentableau['produit'].'</div>';
      }
      else
      {
        echo 'il n\'y a aucune facture pour cette année</div>';
      }
    }
   ?>
</body>

</html>
