<!DOCTYPE html>
<html>
<head>
<title>Trimestre</title>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";

?>
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
  <div class="content-loader" style="width: 70%;margin:5% 13%;">
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">
      <thead>
        <tr>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse</th>
          <th>Ajout</th>
        </tr>
      </thead>
  <?php
  if(isset($_POST['trimestre']))
  {
    echo $_POST["trimestre"];
    $lesAdherents = ListerAdherent();

    foreach($lesAdherents as $unAdherent)
    {
      echo '<td>'.$unAdherent['nom'].'</td>';
      echo '<td>'.$unAdherent['prenom'].'</td>';
      echo '<td>'.$unAdherent['adresse'].'</td>';
    }

  }

   ?>
</body>

</html>
