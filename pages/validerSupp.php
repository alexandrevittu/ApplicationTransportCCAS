<?php
session_start();
include_once('../fonctions/fonctions.php');
$id = $_POST['id'];
try {
    SupprimerAdherent($id);
    echo 'Suppression Réussie';
    echo '<form id="formLigne3" action="PubliPostageCSV.php" method="POST"><input type="hidden" id="nbLigne3" name="nbLigne3" value="0"></form>';
    echo '<script>document.getElementById("formLigne3").submit(); </script>';
} catch (Exception $e) {
    echo $e->getMessage();
}
