<?php
session_start();
include_once('../fonctions/fonctions.php');

$id = $_POST['id'];
try {
    SupprimerAdherent($id);
    echo 'Suppression Réussie';
    echo '<script>location.reload()</script>';
    header('Location: ListeAdherents.php');
    exit();

} catch (Exception $e) {
    echo $e->getMessage();
}
