<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Renouvellement  des adherents pour le trimestre suivant</title>
  <meta http-equiv=”refresh” content="5" />
  <?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";
  if(isset($_POST['id'])){        //ajout dans la BDD aprés la modification de l'adherents (ici pour serialize)
    if(isset($_POST["nom"]) && isset($_POST["prenom"]) && isset($_POST["adresse"]) && isset($_POST["dateAdhesion"]) && isset($_POST["remarque"]))
    {
      if($_POST["nom"]==NULL || $_POST["prenom"]==NULL || $_POST["adresse"]==NULL)
      {
        echo"<script>alert('Saisir les champs obligatoire (Nom,prenom,adresse,date)')</script>";
      }
      else{
      $dateactuel = date_create(date('Y-m-d'));
      $datesaisie = date_create(($_POST["dateAdhesion"]));
      $diff = date_diff($datesaisie,$dateactuel);
      $nb= (int)$diff->format('%R%a');
      if((int)$nb>=0)
      {


        ModifAdherent($_POST["id"],($_POST["nom"]),($_POST["prenom"]),($_POST["adresse"]),($_POST["dateAdhesion"]),($_POST["remarque"]));
        if(isset($_POST['test']))
        {
          header("Refresh:0; url=PubliPostageCSV.php");

        }
        else{
          header("Refresh:0; url=ListeAdherents.php");

        }
      }
      else
      {
        echo '<form method="POST" id="formmodif" action="ModifAdherent.php"><input type="hidden" name="id" id="id" value="'.$_POST['id'].'"></form>';
        header("Refresh:0; url=ModifAdherent.php");
        echo"<script>alert('Date supérieur a celle d\'aujourd\'hui')</script>";
        echo "<script>document.getElementById('formmodif').submit();</script>";


      }

    }
  }
}

  ?>
  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/dataTables.buttons.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.print.min.js"></script>
  <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.5.1/js/buttons.html5.min.js"></script>
  <script language="javascript" type="text/javascript">
    $(document).ready(function() {                    //btn impression et format csv
    var table =  $('#example').DataTable({
        dom: '<"top"f>rt<"bottom"Bp>',
        buttons: [
          { extend: 'print', text: '<span class="glyphicon glyphicon-print"></span> Imprimer' , className: 'btn btn-info'},

          { extend: 'csv', text: '<span class=" glyphicon glyphicon-paperclip"></span> Sortie format csv', className: 'btn btn-info'}
        ]
      });

      nbLigne = table.rows('.selected').count();          //compte le nombre de ligne

    });
  </script>
</head>
<body>
  <h2 style="text-align:center;">Liste des réadhesions</h2>
  <div class="content-loader" style="width: 70%;margin:5% 13%;">          <!--Création du tableau -->
    <table cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">

      <thead>
        <tr>
          <th>Trimestre</th>
          <th>Nom</th>
          <th>Prénom</th>
          <th>Adresse</th>
          <th>Date d'adhesion</th>
          <th>Coût actuel des adhésions</th>
          <th>Modifier</th>
        </tr>
      </thead>
    </div>
    <?php
    $trimestreSuivant = getTrimestreSuivant();

    $Nbligne = 0;
    $lesAdherents = ListerAdherent();

    foreach($lesAdherents as $unAdherent){

    $dateAdhesion = $unAdherent['dateAdhesion'];
    $dateMois = date("m",strtotime($dateAdhesion));

    $id=$unAdherent['id'];


    if(in_array($dateMois,$trimestreSuivant)){


    $anneeMaintenant = date('y');
    $anneeAdherent = date("y",strtotime($dateAdhesion));
    $trimestreSuivantNb = getTrimestreSuivantNb();
    if($anneeAdherent < $anneeMaintenant)
    {
        $prixAdhesionActuel = Getprixadhesion();
        $getTrimestreLibelle = getTrimestreLib($trimestreSuivantNb);
        $Nbligne++;
        echo '<tr class="selected">';
        echo '<td>'.$getTrimestreLibelle['libelle'].'</td>';
        echo '<td>'.$unAdherent['nom'].'</td>';
        echo '<td>'.$unAdherent['prenom'].'</td>';
        echo '<td>'.$unAdherent['adresse'].'</td>';
        echo '<td>'.DateFr($unAdherent['dateAdhesion']).'</td>';
        echo '<td style=font-weight:bold;>'.$prixAdhesionActuel['prix'].' €</td>';
        echo '<td><div id=conteneurBtn><form action="modifRead.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input type="hidden" name="publi" value="3"><input class="btn btn-info" id="btn-view" type="submit" value="Modifier"/></form></td></tr>';
      }
    }
  }

  if($_SESSION['nbLigne']!=$Nbligne)
  {
  $_SESSION['nbLigne'] = $Nbligne;
  header('Location: accueil.php');
  }
  ?>

  </table>
  <form action="accueil.php" id="btnimpression">
  <input class="btn btn-info" type="submit" value="Accueil">
</form>
</body>

</html>
