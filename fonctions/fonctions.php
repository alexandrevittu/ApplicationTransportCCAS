<?php

function connexion(){
    $dsn='mysql:dbname=transport_ccas;host=localhost';
    $username='root';
    $passwd='';

    try{
        $dbh=new PDO($dsn,$username,$passwd);
    } catch (Exception $e) {
        echo 'Connexion échouée : '.$e->getMessage();
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
function ModifAdherent($id,$nom,$prenom,$adresse,$date,$remarque)
{
  $dbh = connexion();
  $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
  $pdoStatement = $dbh->prepare("update adherents set nom =:nom,prenom =:prenom,adresse =:adresse,dateAdhesion = :dateAdhesion,remarque = :remarque where id = :id ");
  $pdoStatement->bindvalue("nom",$nom);
  $pdoStatement->bindvalue("prenom",$prenom);
  $pdoStatement->bindvalue("adresse",$adresse);
  $pdoStatement->bindvalue("dateAdhesion",$date);
  $pdoStatement->bindvalue("remarque",$remarque);
  $pdoStatement->bindvalue("id",$id);
  if($pdoStatement->execute())
  {

  $pdoStatement->closeCursor();
  $dbh=null;
  }
  else
  {
  throw new Exception("Erreur modification d'adherent");
  }
}

function ModifTarifCourt($prix)
{
  $dbh = connexion();
  $pdoStatement = $dbh ->prepare("update typetrajet set prix = :trajetcourt WHERE id='2'");
  $pdoStatement->bindvalue("trajetcourt",$prix);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
  }
    else
  {
    throw new Exception("Erreur modif prix trajet court");
  }
}
function ModifTarifMoyen($prix)
{
  $dbh = connexion();
  $pdoStatement = $dbh ->prepare("update typetrajet set prix = :trajetmoyen WHERE id='3'");
  $pdoStatement->bindvalue("trajetmoyen",$prix);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
  }
    else
  {
    throw new Exception("Erreur modif prix trajet moyen");
  }
}
function ModifTarifLong($prix)
{
  $dbh = connexion();
  $pdoStatement = $dbh ->prepare("update typetrajet set prix = :trajetlong WHERE id='4'");
  $pdoStatement->bindvalue("trajetlong",$prix);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
  }
    else
  {
    throw new Exception("Erreur modif prix trajet long");
  }
}
function ModifTarifAdhesion($prix)
{
  $dbh = connexion();
  $pdoStatement = $dbh ->prepare("update typetrajet set prix = :tarifadhesion WHERE id='5'");
  $pdoStatement->bindvalue("tarifadhesion",$prix);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
  }
    else
  {
    throw new Exception("Erreur modif prix adhésion");
  }
}
function ModifSeuil($prix)
{
  $dbh = connexion();
  $pdoStatement = $dbh ->prepare("update typetrajet set prix = :seuil WHERE id='1'");
  $pdoStatement->bindvalue("seuil",$prix);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
  }
    else
  {
    throw new Exception("Erreur modif prix du seuil");
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

function GetTarif()
{
  $dbh = connexion();
  try{

    $pdoStatement = $dbh->prepare("select prix from typetrajet");
    $pdoStatement->execute();

    $result = $pdoStatement->fetchAll();
    return $result;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation des tarif ");
  }

}

function getDateDepasse(){
  $dbh = connexion();
  try{

    $pdoStatement = $dbh->prepare("");
    $pdoStatement->execute();

    $result = $pdoStatement->fetch();
    return $result;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation des tarif ");
  }
}

function Getidadherent($nom,$prenom)
{
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select id from adherents where nom=:nom and prenom=:prenom");
    $pdoStatement->bindvalue("nom",$nom);
    $pdoStatement->bindvalue("prenom",$prenom);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'id de l'adherent ");
  }
}
function ajouttrajetcourtparadherent($idadherent,$trimestre)
{
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into tarifs values (NULL,0,:idadherent,2,:idtrimestre)");
  $PdoStatement->bindvalue("idadherent",$idadherent);
  $PdoStatement->bindvalue("idtrimestre",$trimestre);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
    }
    else{
    throw new Exception("Erreur ajout trajet cours d'adherent");
    }
}
function ajoutadhesionparadherent($idadherent,$trimestre)
{
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into tarifs values (NULL,1,:idadherent,5,:idtrimestre)");
  $PdoStatement->bindvalue("idadherent",$idadherent);
  $PdoStatement->bindvalue("idtrimestre",$trimestre);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
    }
    else{
    throw new Exception("Erreur ajout trajet cours d'adherent");
    }
}
function ajouttrajetmoyenparadherent($idadherent,$trimestre)
{
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into tarifs values (NULL,0,:idadherent,3,:idtrimestre)");
  $PdoStatement->bindvalue("idadherent",$idadherent);
  $PdoStatement->bindvalue("idtrimestre",$trimestre);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
    }
    else{
    throw new Exception("Erreur ajout trajet moyen d'adherent");
    }
}
function ajouttrajetlongparadherent($idadherent,$trimestre)
{
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into tarifs values (NULL,0,:idadherent,4,:idtrimestre)");
  $PdoStatement->bindvalue("idadherent",$idadherent);
  $PdoStatement->bindvalue("idtrimestre",$trimestre);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
    }
    else{
    throw new Exception("Erreur ajout trajet long d'adherent");
    }
}
function GetAdherent($id)
{
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select * from adherents where id=:id");
    $pdoStatement->bindvalue("id",$id);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'adherent ");
  }
}

function pdfAdherent(){

  $dbh = connexion();

  $ListerAdherent = ListerAdherent();

  $pdf = new PDF();
  $pdf->addPage();

}


function SupprimerAdherent($idAdherentSupp){
    $pdo = connexion();
    $requete=$pdo->prepare("DELETE from adherents WHERE id= :idAdherentSupp ");
    $requete->bindValue(":idAdherentSupp",$idAdherentSupp);
    $requete->execute();
    }


function Getnbtrajetcours($id)
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select nbTrajet,idAdherent from tarifs inner join adherents on tarifs.idAdherent = adherents.id where idTypetrajet = 2 AND idTrimestre =:id");
    $pdoStatement->bindvalue("id",$id);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll();
    return $result;
    $dbh=null;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'adherent ");
  }
}
function Getadhesion()
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select nbTrajet,idAdherent from tarifs inner join adherents on tarifs.idAdherent = adherents.id where idTypetrajet = 5");
    //$pdoStatement->bindvalue("id",$id);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll();
    return $result;
    $dbh=null;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'adherent ");
  }
}
function Getnbtrajetmoyen($id)
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select nbTrajet,idAdherent from tarifs inner join adherents on tarifs.idAdherent = adherents.id where idTypetrajet = 3 AND idTrimestre =:id");
    $pdoStatement->bindvalue("id",$id);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll();
    return $result;
    $dbh=null;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'adherent ");
  }
}
function Getnbtrajetmoyenparadherent($id,$trimestre)
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select nbTrajet from tarifs where idTypetrajet = 3 AND idTrimestre =:trimestre AND idAdherent =:id");
    $pdoStatement->bindvalue("trimestre",$trimestre);
    $pdoStatement->bindvalue("id",$id);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh=null;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'adherent ");
  }
}
function Getnbtrajetcourtparadherent($id,$trimestre)
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select nbTrajet from tarifs where idTypetrajet = 2 AND idTrimestre =:trimestre AND idAdherent =:id");
    $pdoStatement->bindvalue("trimestre",$trimestre);
    $pdoStatement->bindvalue("id",$id);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh=null;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'adherent ");
  }
}
function Getnbtrajetlongparadherent($id,$trimestre)
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select nbTrajet from tarifs where idTypetrajet = 4 AND idTrimestre =:trimestre AND idAdherent =:id");
    $pdoStatement->bindvalue("trimestre",$trimestre);
    $pdoStatement->bindvalue("id",$id);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh=null;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'adherent ");
  }
}
function Getnbtrajetlong($id)
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select nbTrajet,idAdherent from tarifs inner join adherents on tarifs.idAdherent = adherents.id where idTypetrajet = 4 AND idTrimestre =:id");
    $pdoStatement->bindvalue("id",$id);
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll();
    return $result;
    $dbh=null;

  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de l'adherent ");
  }
}
function getTrimestre()
{
  $mois = date('m');
  $result;
  if($mois>=01 && $mois<=03)
  {
    $result = 1;
  }
  elseif($mois>=04 && $mois<=06)
  {
    $result = 2;
  }
  elseif($mois>=10 && $mois<=12)
  {
    $result = 4;
  }
  else
  {
    $result = 3;
  }
  return $result;
}

function Getprixtrajetcours()
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select prix from typetrajet where id =2");
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh=null;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation du prix d'un trajet cours");
  }
}
function Getprixtrajetmoyen()
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select prix from typetrajet where id =3");
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh=null;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation du prix d'un trajet moyen");
  }
}
function Getprixtrajetlong()
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select prix from typetrajet where id =4");
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh=null;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation du prix d'un trajet long");
  }
}
function Getprixadhesion()
{
  $dbh = connexion();
  try
  {
    $pdoStatement = $dbh->prepare("select prix from typetrajet where id =5");
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh=null;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation du prix d'une adhesion");
  }
}


function getNbTrajetAdherent($idAdherent){
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select SUM(nbTrajet) AS nbTrajetCourt FROM tarifs WHERE idAdherent = 28 AND idTypetrajet = 2");
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("Le nombre de trajet court n'a pas pu etre recuperer ...");
  }
}


?>
