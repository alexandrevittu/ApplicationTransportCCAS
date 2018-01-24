<?php
include_once '../fonctions/fonctions.php';
// Hachage du mot de passe
$pass_hache = password_hash($_POST['pass'], PASSWORD_DEFAULT);

$checkCompte

if (!$resultat)

{

    echo 'Mauvais identifiant ou mot de passe !';

}

else

{

    session_start();

    $_SESSION['id'] = $resultat['id'];

    $_SESSION['pseudo'] = $pseudo;

    echo 'Vous êtes connecté !';
 ?>
