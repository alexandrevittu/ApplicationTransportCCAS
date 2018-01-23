<!DOCTYPE html>
<html>
<head>
  <title>Requêtes multicritères</title>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";
  ?>
</head>
<body>
 <?php
  $annéeencours = date('Y');
 ?>
 <form method="POST" style='width: 70%;margin:5% 13%'>
   <select name="année" id="année" >
     <option value="0">sélectionner une année
     <option value="<?php echo $annéeencours;?>"><?php echo $annéeencours; ?>
     <option value="<?php echo $annéeencours-1; ?>"><?php echo $annéeencours-1; ?>
     <option value="<?php echo $annéeencours-2; ?>"><?php echo $annéeencours-2; ?>
   </select>
   <select name="type" id="type" >
     <option value="0">sélectioner type
     <option value="2">courts
     <option value="3">moyens
     <option value="4">longs
     <option value="5">Somme facturation
    </select>
    <input class="btn btn-info" type='submit' value="Valider"/>
  </form>
  <?php
    if(isset($_POST['type']) && $_POST['type']<=4)
    {
      $datedebut = $_POST['année'].'-01-01';
      $datefin = $_POST['année'].'-12-31';
      $trajetentableau = getTrajetMulticriteres($_POST['type'],$datedebut,$datefin);
      echo $trajetentableau['nb'];
    }
    elseif(isset($_POST['type']))
    {
      $datedebut = $_POST['année'].'-01-01';
      $datefin = $_POST['année'].'-12-31';
      $sommefactuentableau = getTotalFactureAnneEnCours($datedebut,$datefin);
      if($sommefactuentableau['produit'] != 0)
      {
        echo $sommefactuentableau['produit'];
      }
      else
      {
        echo '0';
      }
    }
   ?>
</body>

</html>
