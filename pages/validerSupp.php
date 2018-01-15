<?php
include_once('../fonctions/fonctions.php');

$id = $_POST['id'];
try {
    SupprimerAdherent($id);
    header('Location: accueil.php');
    exit();
    
} catch (Exception $e) {
    echo $e->getMessage();
}

