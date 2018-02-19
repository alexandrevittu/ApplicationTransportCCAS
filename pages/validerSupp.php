<?php
session_start();
include_once('../fonctions/fonctions.php');

$id = $_POST['id'];
try {
    SupprimerAdherent($id);
    $_SESSION['nbLigne'] = -2;
    echo 'Suppression Réussie';
    echo '<script>location.reload()</script>';
    header('Location: PubliPostageCSV.php');
    exit();

} catch (Exception $e) {
    echo $e->getMessage();
}
