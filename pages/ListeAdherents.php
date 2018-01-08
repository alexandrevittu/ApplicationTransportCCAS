<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ajout d'un adherent</title>
  <link rel="stylesheet" href="style.css">

</head>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";

$lesAdherents = ListerAdherent();
?>
<body>
  <table id="tableAdherent">
    <tr>
      <th>Nom</th>
      <th>Prénom</th>
      <th>Adresse</th>
      <th>Date d'adhésion</th>
      <th>Remarques</th>
      <th>Modifier/Supprimer</th>
    </tr>
  <?php
      echo '<tr>';

      foreach($lesAdherents as $unAdherent){

      echo '<td>'.$unAdherent['nom'].'</td>';
      echo '<td>'.$unAdherent['prenom'].'</td>';
      echo '<td>'.$unAdherent['adresse'].'</td>';
      if ($unAdherent['dateAdhesion']) {
        # code...
      }
      echo '<td>'.$unAdherent['dateAdhesion'].'</td>';
      echo '<td>'.$unAdherent['remarque'].'</td>';
      }

     echo '<td><a href="#">Ajouter</a>/<a href="#">Modifier</a>';
     echo '</tr>';

  ?>

  </table>
</body>
</html>
