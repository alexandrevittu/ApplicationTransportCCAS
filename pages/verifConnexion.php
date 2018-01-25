<?php
include_once '../fonctions/fonctions.php';

if (isset($_POST['pseudo']) && isset($_POST['mdp'])) {

  $pass_hache = hash('sha256',$_POST['mdp']); // Hachage du mot de passe
  $pseudo = $_POST['pseudo'];
  echo $pass_hache;
  $checkCompte = getCompte($pseudo,$pass_hache);

  if (!$checkCompte)
  {
      echo '<script>document.getElementById("")';
  }
  else
  {
      session_start();
      $_SESSION['id'] = $checkCompte['id'];
      $_SESSION['pseudo'] = $pseudo;
      header('accueil.php');
    }
}else {
  echo 'Les variables du formulaires ne sont pas déclarées ..';
}

 ?>
