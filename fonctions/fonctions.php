<?php
function connexion(){   //fonction connexion
  $dsn='mysql:dbname=bddccas;host=localhost';
  $username='root';
  $passwd='';
  try{
     $dbh=new PDO($dsn,$username,$passwd);
  } catch (Exception $e) {
    echo 'Connexion échouée : '.$e->getMessage();
 }
  return $dbh;
}
function AjoutAdherent($nom,$prenom,$adresse,$dateadhesion,$remarque){    //fonction ajout adherents
  $dbh= connexion();
  if($dateadhesion =="")
  {
    return false;
  }
  else{
  $dateadhesion = strftime('%Y-%m-%d',strtotime($dateadhesion));    //retourne la date en format anglais pour l'ajout dans la bdd
  $PdoStatement = $dbh ->prepare("insert into adherents values (NULL,:nom,:prenom,:adresse,:dateadhesion,:remarque)");
  $PdoStatement->bindvalue("nom",$nom);
  $PdoStatement->bindvalue("prenom",$prenom);
  $PdoStatement->bindvalue("adresse",$adresse);
  $PdoStatement->bindvalue("dateadhesion",$dateadhesion);
  $PdoStatement->bindvalue("remarque",$remarque);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
    return true;
  }
  else{
    //throw new Exception("Erreur ajout d'adherent");
    return false;
  }}
}
function ModifAdherent($id,$nom,$prenom,$adresse,$date,$remarque)   //modification adherents
{
  $dbh = connexion();
  $date = strftime('%Y-%m-%d',strtotime($date));  //retourne la date en format american pour le bdd
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
function Modifpseudo($pseudo,$id)   //modification du pseudo de l'utilisateur
{
  $dbh = connexion();
  $pdoStatement = $dbh ->prepare("update user set Pseudo = :pseudo WHERE id = :id");
  $pdoStatement->bindvalue("pseudo",$pseudo);
  $pdoStatement->bindvalue("id",$id);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
    return true;
  }
  else
  {
    return false;
  }
}
function Modifmdp($mdp,$id)   //modification du mdp
{
    $dbh = connexion();
    $passhache= hash('sha256',$mdp);    //achage du mdp
    $pdoStatement = $dbh->prepare("update user set Mdp = :passhache WHERE id = :id");
    $pdoStatement->bindvalue('passhache',$passhache);
    $pdoStatement->bindvalue('id',$id);
    if($pdoStatement->execute()){
      $pdoStatement->closeCursor();
      $dbh=null;
      return true;
    }
    else{
      return false;
    }
}
function ModifTarifCourt($prix)   //modification tarif des trajet courts
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
function ModifTarifMoyen($prix)   //modification tarif des trajet moyen
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
function ModifTarifLong($prix)      //modification tarif des trajet long
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
function ModifTarifAdhesion($prix)    //modification des tarif de l'adhesion
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
function ModifSeuil($prix)      //modification du seuil de report
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
function ModifTrajetCourtParAdherent($idadherent,$trimestre,$nbtrajet,$datederniertrajet)   //modif le nombre de trajet court pour un adherent
{
  $dbh = connexion();
  $pdoStatement = $dbh->prepare("update tarifs set nbTrajet = :nbtrajet, dateDernierTrajet = :datederniertrajet WHERE idAdherent=:idadherent AND idTrimestre=:trimestre AND idTypetrajet=2");
  $pdoStatement->bindvalue("nbtrajet",$nbtrajet);
  $pdoStatement->bindvalue("datederniertrajet",$datederniertrajet);
  $pdoStatement->bindvalue("trimestre",$trimestre);
  $pdoStatement->bindvalue("idadherent",$idadherent);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
  }
  else
  {
    throw new Exception("Erreur modif trajet court par adherent");
  }
}
function ModifTrajetMoyenParAdherent($idadherent,$trimestre,$nbtrajet,$datederniertrajet)   //modification du nombre de trajet moyen pour un adherent
{
  $dbh = connexion();
  $pdoStatement = $dbh->prepare("update tarifs set nbTrajet = :nbtrajet, dateDernierTrajet = :datederniertrajet WHERE idAdherent=:idadherent AND idTrimestre=:trimestre AND idTypetrajet=3");
  $pdoStatement->bindvalue("nbtrajet",$nbtrajet);
  $pdoStatement->bindvalue("datederniertrajet",$datederniertrajet);
  $pdoStatement->bindvalue("trimestre",$trimestre);
  $pdoStatement->bindvalue("idadherent",$idadherent);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
  }
  else
  {
    throw new Exception("Erreur modif trajet moyen par adherent");
  }
}
function ModifTrajetLongParAdherent($idadherent,$trimestre,$nbtrajet,$datederniertrajet) //modification du nombre de trajet long pour un adherent
{
  $dbh = connexion();
  $pdoStatement = $dbh->prepare("update tarifs set nbTrajet = :nbtrajet, dateDernierTrajet = :datederniertrajet WHERE idAdherent=:idadherent AND idTrimestre=:trimestre AND idTypetrajet=4");
  $pdoStatement->bindvalue("nbtrajet",$nbtrajet);
  $pdoStatement->bindvalue("datederniertrajet",$datederniertrajet);
  $pdoStatement->bindvalue("trimestre",$trimestre);
  $pdoStatement->bindvalue("idadherent",$idadherent);
  if($pdoStatement->execute())
  {
    $pdoStatement->closeCursor();
    $dbh=null;
  }
  else
  {
    throw new Exception("Erreur modif trajet long par adherent");
  }
}
function ListerAdherent(){  //retourne la liste des adherent
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
function GetTarif()   //retourne un tableau du tout les tarifs
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
function getDateAdhesion($idAdherent){    //retourne la date d'adhesion de l'adherent passer en paramétre
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("SELECT dateAdhesion from adherents  where id=:idAdherent");
    $pdoStatement->bindvalue("idAdherent",$idAdherent);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation des tarif ");
  }
}
function Getidadherent($nom,$prenom)    //retourne l'id de l'adherent mis en paramétre
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
function ajouttrajetcourtparadherent($idadherent,$trimestre,$nbtrajet)    //ajout la ligne des trajet pour l'adherent
{
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into tarifs values (NULL,:nbtrajet,:idadherent,2,:idtrimestre,NULL)");
  $PdoStatement->bindvalue("idadherent",$idadherent);
  $PdoStatement->bindvalue("idtrimestre",$trimestre);
  $PdoStatement->bindvalue("nbtrajet",$nbtrajet);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
  }
  else{
    throw new Exception("Erreur ajout trajet cours d'adherent");
  }
}
function ajoutadhesionparadherent($idadherent,$trimestre,$date) //ajout la ligne de l'adhesion pour l'adherent
{
  $date = strftime('%Y-%m-%d',strtotime($date));
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into tarifs values (NULL,1,:idadherent,5,:idtrimestre,:date)");
  $PdoStatement->bindvalue("date",$date);
  $PdoStatement->bindvalue("idadherent",$idadherent);
  $PdoStatement->bindvalue("idtrimestre",$trimestre);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
  }
  else{
    throw new Exception("Erreur ajout adhesion de l'adherent");
  }
}
function ajouttrajetmoyenparadherent($idadherent,$trimestre,$nbtrajet) //ajout la ligne des trajet pour l'adherent
{
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into tarifs values (NULL,:nbtrajet,:idadherent,3,:idtrimestre,NULL)");
  $PdoStatement->bindvalue("idadherent",$idadherent);
  $PdoStatement->bindvalue("idtrimestre",$trimestre);
  $PdoStatement->bindvalue("nbtrajet",$nbtrajet);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
  }
  else{
    throw new Exception("Erreur ajout trajet moyen d'adherent");
  }
}
function ajouttrajetlongparadherent($idadherent,$trimestre,$nbtrajet) //ajout la ligne des trajet pour l'adherent
{
  $dbh= connexion();
  $PdoStatement = $dbh ->prepare("insert into tarifs values (NULL,:nbtrajet,:idadherent,4,:idtrimestre,NULL)");
  $PdoStatement->bindvalue("idadherent",$idadherent);
  $PdoStatement->bindvalue("idtrimestre",$trimestre);
  $PdoStatement->bindvalue("nbtrajet",$nbtrajet);
  if($PdoStatement->execute()){
    $PdoStatement->closeCursor();
    $dbh=null;
  }
  else{
    throw new Exception("Erreur ajout trajet long d'adherent");
  }
}
function GetAdherent($id) //retourne toute les informations de l'adherent passe en paramétre
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
function SupprimerAdherent($idAdherentSupp){   //supprimer  l'adherent passer en paramétre
  $pdo = connexion();
  $requete=$pdo->prepare("DELETE from adherents WHERE id= :idAdherentSupp ");
  $requete->bindValue(":idAdherentSupp",$idAdherentSupp);
  $requete->execute();
}
function Getnbtrajetcours($id)    //retourne le nombre de trajet court de l'adherent passer en paramétre
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
function Getnbtrajetmoyen($id)    //retourne le nombre de trajet moyen de l'adherent passer en paramétre
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
function Getnbtrajetmoyenparadherent($id,$trimestre)    //retourne le nombre de trajet moyen fait par un adherent pendant un trimestre
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
function Getnbtrajetcourtparadherent($id,$trimestre) //retourne le nombre de trajet court fait par un adherent pendant un trimestre
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
function Getnbtrajetlongparadherent($id,$trimestre) //retourne le nombre de trajet long fait par un adherent pendant un trimestre
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
function getTrimestre()   //retourne le trimestre en cours
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
function getNbTrajetCourtAdherent($idAdherent){
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select SUM(nbTrajet) AS nbTrajetCourt FROM tarifs WHERE idAdherent = :idAdherent AND idTypetrajet = 2");
    $pdoStatement->bindvalue("idAdherent",$idAdherent);
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
function getNbTrajetMoyenAdherent($idAdherent){
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select SUM(nbTrajet) AS nbTrajetCourt FROM tarifs WHERE idAdherent = :idAdherent AND idTypetrajet = 3");
    $pdoStatement->bindvalue("idAdherent",$idAdherent);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("Le nombre de trajet moyen n'a pas pu etre recuperer ...");
  }
}
function getNbTrajetLongAdherent($idAdherent){
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select SUM(nbTrajet) AS nbTrajetCourt FROM tarifs WHERE idAdherent = :idAdherent AND idTypetrajet = 4");
    $pdoStatement->bindvalue("idAdherent",$idAdherent);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("Le nombre de trajet long n'a pas pu etre recuperer ...");
  }
}
function adhesionPayee($idAdherent){
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select nbTrajet FROM tarifs WHERE idAdherent = :idAdherent AND idTypetrajet = 5");
    $pdoStatement->bindvalue("idAdherent",$idAdherent);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("l'adhesion n'est pas récuperer erreur dans l");
  }
}
function getSeuil(){
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select prix FROM typetrajet WHERE id = 1");
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("Le seuil n'a pas pu etre recuperer ...");
  }
}
function getTrimestreSuivant(){   //retourne tableau ??? trimestre suivant
  $trimestreActuel = getTrimestre();
  $trimestreSuivant = 0;
  if ($trimestreActuel == 1) {
    $trimestreSuivant = array(4,5,6);
  }else if ($trimestreActuel == 2) {
    $trimestreSuivant = array(7,8,9);
  }else if ($trimestreActuel == 3) {
    $trimestreSuivant = array(10,11,12);
  }else{
    $trimestreSuivant == array(1,2,3);
  }
  return $trimestreSuivant;
}
function getTrimestreSuivantNb(){   //retourne le numero du trimestre suivant
  $trimestreActuel = getTrimestre();
  $trimestreSuivant = 0;
  if ($trimestreActuel == 1) {
    $trimestreSuivant = 2;
  }else if ($trimestreActuel == 2) {
    $trimestreSuivant = 3;
  }else if ($trimestreActuel == 3) {
    $trimestreSuivant = 4;
  }else{
    $trimestreSuivant == 1;
  }
  return $trimestreSuivant;
}
function getTrimestreLib($idTrimestre){   //retourne le libelle du trimestre
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select libelle FROM trimestre WHERE id = :idTrimestre");
    $pdoStatement->bindValue("idTrimestre",$idTrimestre);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("Erreur...");
  }
}
function dateFr($date)    //convertie la date en format FR  ex : DD-MM-YYYY
{
  return strftime('%d-%m-%Y',strtotime($date));
}
function getDateDernierTrajet($idAdherent){ //retourne la date du dernier trajet fait pas l'adherent passer en paramétre
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select DISTINCT idAdherent,dateDernierTrajet FROM tarifs where dateDernierTrajet != '' and idAdherent = :idAdherent");
    $pdoStatement->bindvalue("idAdherent",$idAdherent);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de la date du dernier trajet");
  }
}
function getNbTrajetParAn($date1,$date2)  //retourne le nombre de trajet effectuer entre les deux dates
{
  $dbh = connexion();
  try
  {
      $pdoStatement = $dbh->prepare("select SUM(nbTrajet) as nb FROM tarifs WHERE dateDernierTrajet BETWEEN :date1 AND :date2 AND idTypetrajet != 5");
      $pdoStatement->bindvalue("date1",$date1);
      $pdoStatement->bindvalue("date2",$date2);
      $pdoStatement->execute();
      $result = $pdoStatement->fetch();
      return $result;
      $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation de la date du dernier trajet");
  }
}
function getcompteutilisateur($id)    //retourne tout les information de l'utilisateur
{
  $dbh = connexion();
  try
  {
      $pdoStatement = $dbh->prepare("select * from user where id = :id");
      $pdoStatement->bindvalue("id",$id);
      $pdoStatement->execute();
      $result = $pdoStatement->fetch();
      return $result;
      $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("erreur lors de la recuperation des informations compte");
  }
}
function getTotalFactureAnneEnCours($dateDeb,$dateFin){   //retourne le total de la facturation entre les deux date passer en paramétre
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select sum(nbTrajet*prix) AS produit from tarifs INNER JOIN typetrajet on tarifs.idTypetrajet=typetrajet.id WHERE dateDernierTrajet is null OR dateDernierTrajet BETWEEN :dateDeb AND :dateFin");
    $pdoStatement->bindvalue('dateDeb',$dateDeb);
    $pdoStatement->bindvalue('dateFin',$dateFin);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("Erreur lors de la recuperation du totale...");
  }
}
function inscription($identifiant,$mdp,$mail)   //inscription d'un compte
{
    $dbh = connexion();
    $passhache= hash('sha256',$mdp);    //achage du mdp
    $pdoStatement = $dbh->prepare("insert into user (Pseudo,Mdp,Mail) VALUES (:identifiant,:passhache,:mail)");
    $pdoStatement->bindvalue('identifiant',$identifiant);
    $pdoStatement->bindvalue('passhache',$passhache);
    $pdoStatement->bindvalue('mail',$mail);
    if($pdoStatement->execute()){
      $pdoStatement->closeCursor();
      $dbh=null;
      return true;
    }
    else{
      return false;
    }
}
function getTotalFactureAnneEnCourstest($dateDeb,$dateFin){
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select sum(nbTrajet*prix) AS produit from tarifs INNER JOIN typetrajet on tarifs.idTypetrajet=typetrajet.id WHERE dateDernierTrajet BETWEEN :dateDeb AND :dateFin");
    $pdoStatement->bindvalue('dateDeb',$dateDeb);
    $pdoStatement->bindvalue('dateFin',$dateFin);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("Erreur lors de la recuperation du totale...");
  }
}
function getTrajetMulticriteres($typetrajet,$datedeb,$datefin)    //fonction pour page multicritére
{
  $dbh = connexion();
  try{
    $pdoStatement = $dbh->prepare("select sum(nbTrajet) as nb from tarifs WHERE idTypetrajet = :typetrajet AND dateDernierTrajet BETWEEN :datedeb AND :datefin");
    $pdoStatement->bindvalue('typetrajet',$typetrajet);
    $pdoStatement->bindvalue('datedeb',$datedeb);
    $pdoStatement->bindvalue('datefin',$datefin);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  catch(Exception $e)
  {
    throw new Exception("Erreur lors de la recuperation du totale...");
  }
}
function orderTrimestre(){      //retourne les trimestre pour la selection du trimestre page trimestre
  $trimestre = getTrimestre();
  $libelleTrimestre = getTrimestreLib($trimestre);
  $libelleTr = $libelleTrimestre['libelle'];
  $date = date('Y');
  $lesTrimestres = array();
  if ($libelleTr == "Janvier/Février/Mars") {
    $lesTrimestres = array(
      1 => array(
        "libelle" => "Avril/Mai/Juin",
        "annee" => strval($date-1),
        "idTrimestre" => 2,
      ),
      2 => array(
        "libelle" => "Juillet/Août/Septembre",
        "annee" => strval($date-1),
        "idTrimestre" => 3,
      ),
      3 => array(
        "libelle" => "Octobre/Novembre/Décembre",
        "annee" => strval($date-1),
        "idTrimestre" => 4,
      ),
      4 => array(
        "libelle" => $libelleTr,
        "annee" => $date,
        "idTrimestre" => $trimestre,
      )
    );
  }elseif ($libelleTr == "Avril/Mai/Juin") {
    $lesTrimestres = array(
      1 => array(
        "libelle" => "Juillet/Août/Septembre",
        "annee" => strval($date-1),
        "idTrimestre" => 3,
      ),
      2 => array(
        "libelle" => "Octobre/Novembre/Décembre",
        "annee" => strval($date-1),
        "idTrimestre" => 4,
      ),
      3 => array(
        "libelle" => "Janvier/Février/Mars",
        "annee" => $date,
        "idTrimestre" => 1,
      ),
      4 => array(
        "libelle" => $libelleTr,
        "annee" => $date,
        "idTrimestre" => 2,
      )
    );
  }elseif ($libelleTr == "Juillet/Août/Septembre") {
        $lesTrimestres = array(
          1 => array(
            "libelle" => "Octobre/Novembre/Décembre",
            "annee" => strval($date-1),
            "idTrimestre" => 4,
          ),
          2 => array(
            "libelle" => "Janvier/Février/Mars",
            "annee" => $date,
            "idTrimestre" => 1,
          ),
          3 => array(
            "libelle" => "Avril/Mai/Juin",
            "annee" => $date,
            "idTrimestre" => 2,
          ),
          4 => array(
            "libelle" => $libelleTr,
            "annee" => $date,
            "idTrimestre" => 3,
          )
        );
  }elseif ($libelleTr == "Octobre/Novembre/Décembre") {
    $lesTrimestres = array(
      1 => array(
        "libelle" => "Janvier/Février/Mars",
        "annee" => $date,
        "idTrimestre" => 1,
      ),
      2 => array(
        "libelle" => "Avril/Mai/Juin",
        "annee" => $date,
        "idTrimestre" => 2,
      ),
      3 => array(
        "libelle" => "Juillet/Août/Septembre",
        "annee" => $date,
        "idTrimestre" => 3,
      ),
      4 => array(
        "libelle" => $libelleTr,
        "annee" => $date,
        "idTrimestre" => 4,
      )
    );
  }
  return $lesTrimestres;
}
function getCompte($pseudo,$mdp){   //retourne l'id du compte passe en paramétre
    $dbh = connexion();
    $pdoStatement = $dbh->prepare("select id from user where Pseudo = :pseudo and Mdp = :mdp");
    $pdoStatement->bindvalue('pseudo',$pseudo);
    $pdoStatement->bindvalue('mdp',$mdp);
    $pdoStatement->execute();
    $result = $pdoStatement->fetch();
    return $result;
    $dbh = null;
  }
  function getTrimestreDate($date)  //retourne la date du trimestre
  {
    $d = date_parse_from_format("Y-m-d", implode($date));
    $mois = $d["month"];
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
  function getUtilisateur()   //retourne toute les information de l'utilisateur
  {
    $dbh = connexion();
    $pdoStatement = $dbh->prepare("select * from user");
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll();
    return $result;
    $dbh = null;
  }
  function setNbLigne($value){
    $dbh = connexion();
    $pdoStatement = $dbh ->prepare("update ligne set nbLigne = :ligne WHERE id='1'");
    $pdoStatement->bindvalue("ligne",$value);
    if($pdoStatement->execute())
    {
      $pdoStatement->closeCursor();
      $dbh=null;
    }
    else
    {
      throw new Exception("Erreur modif ");
    }
  }
  function getNbLigne(){
    $dbh = connexion();
    $pdoStatement = $dbh->prepare("select nbLigne from ligne");
    $pdoStatement->execute();
    $result = $pdoStatement->fetchAll();
    return $result;
    $dbh = null;
  }
  function ajoutreportparadherent($idadherent,$idtrimestre)   //ajout la ligne report au moment de l'ajout de l'adherent
  {
    $dbh= connexion();
    $PdoStatement = $dbh ->prepare("insert into report values (NULL,0,:idadherent,:idtrimestre)");
    $PdoStatement->bindvalue("idadherent",$idadherent);
    $PdoStatement->bindvalue("idtrimestre",$idtrimestre);
    if($PdoStatement->execute()){
      $PdoStatement->closeCursor();
      $dbh=null;
    }
    else{
      throw new Exception("Erreur ajout report de d'adherent");
    }
  }
  function getreportparadherent($idadherent,$idtrimestre)   //retourne le report de l'adherent
  {
    $dbh = connexion();
    try{
      $pdoStatement = $dbh->prepare("select prixReport from report where idAdherent = :idadherent AND idTrimestre = :idtrimestre");
      $pdoStatement->bindvalue("idadherent",$idadherent);
      $pdoStatement->bindvalue("idtrimestre",$idtrimestre);
      $pdoStatement->execute();
      $result = $pdoStatement->fetch();
      return $result;
    }
    catch(Exception $e)
    {
      throw new Exception("erreur lors de la recuperation du report ");
    }
  }
  function updateReport($idAdherent,$prix,$trimestre){    //mettre a jour le report en fonction du trimestre et du prix mis en paramétre
      $dbh = connexion();
      $pdoStatement = $dbh->prepare("update report set prixReport = :prix where idAdherent = :idadherent AND idTrimestre = :trimestre");
      $pdoStatement->bindvalue("idadherent",$idAdherent);
      $pdoStatement->bindvalue("trimestre",$trimestre);
      $pdoStatement->bindvalue("prix",$prix);
      $pdoStatement->execute();
      if($pdoStatement->execute())
      {
        $pdoStatement->closeCursor();
        $dbh=null;
      }
      else
      {
        throw new Exception("Erreur modification report");
      }
  }
  /////////
  function getNbTrajetCourtAdherentTrimestreActuel($idAdherent,$trimestreActuel){
    $dbh = connexion();
    try{
      $pdoStatement = $dbh->prepare("select SUM(nbTrajet) AS nbTrajetCourt FROM tarifs WHERE idAdherent = :idAdherent AND idTypetrajet = 2 AND idTrimestre = :trimestreActuel");
      $pdoStatement->bindvalue("idAdherent",$idAdherent);
      $pdoStatement->bindvalue("trimestreActuel",$trimestreActuel);
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
  function getNbTrajetMoyenAdherentTrimestreActuel($idAdherent,$trimestreActuel){
    $dbh = connexion();
    try{
      $pdoStatement = $dbh->prepare("select SUM(nbTrajet) AS nbTrajetCourt FROM tarifs WHERE idAdherent = :idAdherent AND idTypetrajet = 3 AND idTrimestre = :trimestreActuel");
      $pdoStatement->bindvalue("idAdherent",$idAdherent);
      $pdoStatement->bindvalue("trimestreActuel",$trimestreActuel);
      $pdoStatement->execute();
      $result = $pdoStatement->fetch();
      return $result;
      $dbh = null;
    }
    catch(Exception $e)
    {
      throw new Exception("Le nombre de trajet moyen n'a pas pu etre recuperer ...");
    }
  }
  function getNbTrajetLongAdherentTrimestreActuel($idAdherent,$trimestreActuel){
    $dbh = connexion();
    try{
      $pdoStatement = $dbh->prepare("select SUM(nbTrajet) AS nbTrajetCourt FROM tarifs WHERE idAdherent = :idAdherent AND idTypetrajet = 4 AND idTrimestre = :trimestreActuel");
      $pdoStatement->bindvalue("idAdherent",$idAdherent);
      $pdoStatement->bindvalue("trimestreActuel",$trimestreActuel);
      $pdoStatement->execute();
      $result = $pdoStatement->fetch();
      return $result;
      $dbh = null;
    }
    catch(Exception $e)
    {
      throw new Exception("Le nombre de trajet long n'a pas pu etre recuperer ...");
    }

  }
?>
