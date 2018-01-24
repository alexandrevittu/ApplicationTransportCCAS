<?php
include_once '../fonctions/fonctions.php';
// Hachage du mot de passe
$pass_hache = hash('sha256',$_POST['mdp']);
$pseudo = $_POST['pseudo'];
echo $pass_hache;
$checkCompte = getCompte($pseudo,$pass_hache);

if (!$checkCompte)

{

    echo 'Mauvais identifiant ou mot de passe !';

}

else

{

    session_start();

    $_SESSION['id'] = $checkCompte['id'];

    $_SESSION['pseudo'] = $pseudo;

    echo 'Vous êtes connecté !';}
 ?>
