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
     <option value="1"><?php echo $annéeencours; ?>
     <option value="2"><?php echo $annéeencours-1; ?>
     <option value="3"><?php echo $annéeencours-2; ?>
   </select>
   <select name="type" id="type" >
     <option value="0">sélectioner type
     <option value="1">courts
     <option value="2">moyens
     <option value="3">longs
     <option value="4">Somme facturation
    </select>
    <input class="btn btn-info" type='submit' value="Valider"/>
  </form>
</body>

</html>
