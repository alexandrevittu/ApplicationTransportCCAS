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
   <select name="année" id="année" onchange="submit();">
     <option value="0">sélectionner une année
     <option value="1"><?php echo $annéeencours; ?>
     <option value="2"><?php echo $annéeencours-1; ?>
     <option value="3"><?php echo $annéeencours-2; ?>
   </select>
   <select name="type" id="type" onchange="submit();">
     <option value="0">sélectioner type
     <option value="1">courts
     <option value="2">moyens
     <option value="3">longs
     <option value="4">Somme facturation
    </select>
  </form>
  <?php

    echo"<script>";
    if($_POST['année']==1)
    {
      echo"document.getElementById('année').value='1'";
    }
    elseif($_POST['année']==2)
    {
      echo"document.getElementById('année').value='2'";
    }
    elseif($_POST['année']==3)
    {
      echo"document.getElementById('année').value='3'";
    }
    if($_POST['type']==1)
    {

    }
    elseif($_POST['type']==2)
    {

    }
    elseif($_POST['type']==3)
    {

    }
    elseif($_POST['type']==4)
    {

    }
    echo"</script>";
  ?>
</body>

</html>
