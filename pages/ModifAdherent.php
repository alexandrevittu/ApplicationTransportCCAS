<!DOCTYPE html>
<html>
<head>
<title>Modification d'un adherent</title>
<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";


$ladherent = GetAdherent($_POST['id']);


?>

<body>
  <div class="content-loader" style="width: 70%;margin:5% 20%;">
    <form id="modifadherent" method="POST">
      nom :<input type="text" name="nom" id="nom" value="<?php echo$ladherent['nom']?>"/></br>
      prenom :<input type="text" name="prenom" id="prenom" value="<?php echo$ladherent['prenom']?>"/></br>
      adresse :<input type="text" name="adresse" id="adresse" value="<?php echo$ladherent['adresse']?>"/></br>
      date adhesion :<input type="text" name="date" id="date" value="<?php echo$ladherent['dateAdhesion']?>"/></br>
      remarque :<input type="text" name="remarque" id="remarque" value="<?php echo$ladherent['remarque']?>"/></br>
      <input class="btn btn-default" type="submit" value="Modifier"/>
    </form>
      <?php
      if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]))
      {



        ModifAdherent(($ladherent["id"]),($_POST["nom"]),($_POST["prenom"]),($_POST["adresse"]),($_POST["date"]),($_POST["remarque"]));
        $ladherent = GetAdherent($ladherent['id']);

      }
      ?>
</body>

</html>
