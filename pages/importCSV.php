<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <link type="text/css" rel="stylesheet" href="style.css"/>
  <title>Transport CCAS</title>
</head>
<body>
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";  //inclut l'en-tete
  ?>
  <div id="conteneur">
    <form id="ajoutadherent" method="POST" enctype="multipart/form-data">
      <span style="font-weight:bold;">Veuillez importer la base de donnée (sous format .csv)</span><br><br>
      <input type="file" name="fichier" id="fichier" style="border:1px solid black;display:inline;"/><br><br>
      <input type="submit" name="envoie" value="Envoyez"/><br>
    </form>
      <input  id="btn_ajout" class="" onclick="window.location.href='accueil.php'" type="submit" value="Retour" class="buttonadherent">
  </div>
  <?php

  if(isset($_POST['envoie']))
  {

    $filename=$_FILES["fichier"]["tmp_name"];
    //$file = fopen($filename,"r");
    $prenom = array();
    //$nom = array();
    $lignes = array();
    $nbtrajet =0;
    $trimestre = getTrimestre();


    $row = 1;
if (($handle = fopen($filename, "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $num = count($data);

        $row++;
        for ($c=0; $c < $num; $c++) {
          $nom[$c] = $data[$c];

        }
        AjoutAdherent(($nom[0]),($nom[1]),($nom[2]),($nom[3]),($nom[4]));
        $id = Getidadherent(($nom[0]),($nom[1]));
        for($i=1;$i<=4;$i++)     //ajoute des trajet court,moyen,long avec nbtrahet=0 pour chaque adherent crée pour chaque trimestre
        {
          ajouttrajetcourtparadherent($id['id'],$i,$nbtrajet);
          ajouttrajetmoyenparadherent($id['id'],$i,$nbtrajet);
          ajouttrajetlongparadherent($id['id'],$i,$nbtrajet);
        }
        ajoutadhesionparadherent($id['id'],$trimestre,($nom[3]));
        echo '<script>';
        echo "window.location = 'accueil.php'";
        echo '</script>';
  }
}
}
   ?>
</body>
</html>
