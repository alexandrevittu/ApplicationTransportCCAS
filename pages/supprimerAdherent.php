<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Transport CCAS</title>
  <script type="text/javascript">
    $(function() // execute once the DOM has loaded
    {
      $("#supprimerA").click(function(event)
      {
        print(',lgflgflf'); 
        window.setTimeout("location=('accueil.php');",1500);
      });

    </script>
  </head>
  <?php
  include 'header.php';
  include '../fonctions/fonctions.php';

  $idAdherentSupp = GetAdherent($_POST['id']);
  ?>
  <body>
    <div class="content-loader" style="width: 70%;margin:5% 20%;">
      <div id="dis">
      </div>
      <form method='POST' action="" id='formSupp';">

        <fieldset>
          <legend>Suppresion de l'adherent choisie</legend>
          <p><strong>Nom : </strong><?php
          echo $idAdherentSupp['nom'];?></p>

          <p><strong>Prenom :  </strong><?php
          echo $idAdherentSupp['prenom'];
          ?></p>

          <p><strong>Adresse :  </strong><?php
          echo $idAdherentSupp['adresse'];
          ?></p>

          <p><strong>Date de son adhésion : </strong><?php
          echo $idAdherentSupp['dateAdhesion'];
          ?></p>

          <p><strong>Remarque sur l'adhérent : </strong><?php
          echo $idAdherentSupp['remarque'];
          ?></p> 

        </fieldset>      

        <input type="checkbox" id="valide" name="valide" required> &nbsp;Vous affirmez vouloir supprimer cet adhérent
        <button type="" class="btn btn-danger" name="supprimerA" id="supprimerA" >Supprimer</button>
        <script type="text/javascript">

        </script>
        <hr color="blue" size="4" style="border:1px solid #e5e5e5">
      </form>
    </div>
    <script type="text/javascript" src="../fonctions/fonction.js"></script>
  </body>
  </html>
