<!DOCTYPE html>
<html>
<head>
<title>Gestion compte</title>
<?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";  //inclut l'en-tete
  getcompteutilisateur($_SESSION['id']);
?>
</head>
<body>
          <form  method="GET">
            <input type="hidden" name="modif" value="1">
            <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Modifier identifiant</button>
          </form>

          <form  method="GET">
            <input type="hidden" name="modif" value="2">
            <button class="btn btn-info" type="submit" id="accueil"> <span class="glyphicon glyphicon-pencil"></span> &nbsp; Modifier mot de passe</button>
          </form>
<?php
  if(isset($_GET['modif']) && $_GET['modif']==1)
  {
    ?>
    <form method="POST" style="width: 50%;margin:5% 20%;">
      <label>nouvelle identifiant : </label><br>
      <input type="text" name="pseudo"/></br>
      <input class="btn btn-info" type="submit" value="valider"/>
    </form>
    <?php
      if(isset($_POST['pseudo']))
      {
          if(Modifpseudo($_POST['pseudo'],$_SESSION['id']))
          {
            echo"<script>alert('votre pseudo a ete modifier !');</script>";
          }
          else
          {
            echo"<script>alert('ce pseudo est deja utiliser');</script>";
          }
      }
      else
      {

      }

  }
  elseif(isset($_GET['modif']) && $_GET['modif']==2)
  {
    ?>
    <form method="POST" style="width: 50%;margin:5% 20%;">
      <label>nouveau mot de passe : </label><br>
      <input type="text" name="mdp"/></br>
      <input class="btn btn-info" type="submit" value="valider"/>
    </form>
    <?php
    if(isset($_POST['mdp']))
    {
        if(Modifmdp($_POST['mdp'],$_SESSION['id']))
        {
          echo"<script>alert('votre mdp a ete modifier !');</script>";
        }
        else
        {
          echo"<script>alert('votre mot de passe est le meme');</script>";
        }
    }
    else
    {

    }
  }

 ?>
</body>

</html>
