<?php

function connexion(){
    $dsn='mysql:dbname=transport_ccas;host=localhost';
    $username='root';
    $passwd='';

    try{
        $dbh=new PDO($dsn,$username,$passwd);
    } catch (Exception $e) {
        echo 'Connexion �chou�e : '.$e->getMessage();
    }
    return $dbh;
}

function AjoutAdherent($nom,$prenom,$adresse,$dateadhesion,$remarque){
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into adherents values (NULL,:nom,:prenom,:adresse,:dateadhesion,:remarque)");
  $PdoStatement->bindvalue("nom",$nom);
  $PdoStatement->bindvalue("prenom",$prenom);
  $PdoStatement->bindvalue("adresse",$adresse);
  $PdoStatement->bindvalue("dateadhesion",$dateadhesion);
  $PdoStatement->bindvalue("remarque",$remarque);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
}
else{
    throw new Exception("Erreur ajout d'adherent");
}
}

function ListerAdherent(){

  $dbh = connexion();
  try {

  $pdoStatement = $dbh->prepare("select * from adherents");
  $pdoStatement->execute();

  $result = $pdoStatement->fetchAll();
  return $result;
  } catch (Exception $e) {

    throw new Exception("erreur lors de la recuperation des adhérents " . $ex);

  }

}

?>
