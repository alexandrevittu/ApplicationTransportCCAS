<?php
include_once('../fonctions/fonctions.php');

$id = $_POST['id'];
try {
    SupprimerAdherent($id);
    
} catch (Exception $e) {
    echo $e->getMessage();
}

