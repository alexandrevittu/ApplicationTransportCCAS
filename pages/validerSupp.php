<?php
include_once('../fonctions/fonctions.php');

$id = $_POST['id'];
try {
    SupprimerAdherent($id);
    echo 'Suppression Réussie';
    header('Location: ListeAdherents.php');
    exit();
    
} catch (Exception $e) {
    echo $e->getMessage();
}

