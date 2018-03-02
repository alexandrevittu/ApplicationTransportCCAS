<?php
include_once "header.php";
include_once "../fonctions/fonctions.php";
$lesAdherents = ListerAdherent();
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <title>Ajout d'un adherent</title>

  <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
  <link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
  <link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
  <script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
  <script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <style type="text/css">
  #dis{
    display:none;
  }

</style>
<script language="javascript" type="text/javascript">

  $(document).ready(function() {
    $('#example').DataTable({
      pagingType: "simple_numbers",
      lengthMenu:[5,10,15,20,25],       //affichage par default a 20 puis selection possible a 5,10,15,20,25
      pageLength: 20,
      // fixedHeader: true,
      "oLanguage": {
  "sInfo": "Il y a un total de  _TOTAL_ adhérents (_START_ à _END_)"
    },
    });



    $( "#formSupp" ).submit(function( event ) {
      if (confirm("Êtes-vous sûr de vouloir supprimer cet adhérent ?")==true) {    //confirmation de suppresion de l'adherent
        window.location = 'validerSupp.php';
        $(document).on('submit', '#formSupp', function () {

          $.post("validerSupp.php", $(this).serialize())
          .done(function (data) {
            $("#dis").fadeOut();
            $("#dis").fadeIn('slow', function () {
              if (data === "Suppression Réussie") {
                $("#dis").html('<div class="alert alert-info">' + data + '</div>');
              } else {
                $("#dis").html('<div class="alert alert-danger">' + data + '</div>');
              }
              $("#formSupp")[0].reset();
            });
          });
          return false;
        });
      }
      event.preventDefault();
    });


    function closeDiv(){
      window.location = "ListeAdherents.php";
    }
  } );

  </script>
</head>

<body>
  <h2 style="text-align:center;">Liste des adhérents</h2>
  <div class="content-loader">          <!--Creation du tableau-->
      <div id="dis"></div>
      <table onload="location.reload();" cellpadding="0" cellspacing="0" border="0" class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">
        <thead>
          <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Adresse</th>
            <th>Date d'adhésion</th>
            <th>Remarques</th>
            <th>Modifier/Supprimer</th>
          </tr>
        </thead>
        <tbody>
          <div>
            <?php
            foreach($lesAdherents as $unAdherent){

              $dnow = $unAdherent['dateAdhesion'];
              $dafter = date("Y-m-d");
              $date1=date_create($dnow);
              $date2=date_create($dafter);
              $diff=date_diff($date1,$date2);
              $difference = (int)$diff->format('%R%a');
              $id=$unAdherent['id'];                        //recuperation des adhrents + calcul leur date

              $d = date_parse_from_format("Y-m-d", $dnow);
              $mois = $d["month"];
              $annee = $d["year"];
              $anneMtn = date("Y");
              $anneeMtnint = (int)$anneMtn;
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

              $leTrimestre = getTrimestre();

              //affichage des adherents avec une couleur particuliére selon leur date d'adhesion
              if ($difference > 365) {

                echo '<tr style=background-color:#C63632;>';
                echo '<td>'.$unAdherent['nom'].'</td>';
                echo '<td>'.$unAdherent['prenom'].'</td>';
                echo '<td>'.$unAdherent['adresse'].'</td>';
                echo '<td>'.dateFr($unAdherent['dateAdhesion']).'</td>';
                echo '<td>'.$unAdherent['remarque'].'</td>';
                // echo '<td>'.'<div id=conteneurBtn><form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-info" id="btn-view" type="submit" value="Modifier"/></form><form id="formSupp" method="POST" ><input type="hidden" name="id" value='.$id.'><button class="btn btn-danger" type="submit" id="btn-view" onclick="">Supprimer</button></form></td>';
                echo '<td><div class="conteneurBtn"><form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-info" id="btn-view" type="submit" value="Modifier"/></form><a class="btn btn-danger" href="#popup1">Supprimer</a></div></td>';
                echo '</tr>';

              }else if (($result == $leTrimestre) && ($annee < $anneeMtnint)) {

                echo '<tr style=background-color:#f0ad4e;>';
                echo '<td>'.$unAdherent['nom'].'</td>';
                echo '<td>'.$unAdherent['prenom'].'</td>';
                echo '<td>'.$unAdherent['adresse'].'</td>';
                echo '<td>'.dateFr($unAdherent['dateAdhesion']).'</td>';
                echo '<td>'.$unAdherent['remarque'].'</td>';
                // echo '<td>'.'<div id=conteneurBtn><form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-info" id="btn-view" type="submit" value="Modifier"/></form><form id="formSupp" method="POST" ><input type="hidden" name="id" value='.$id.'><button class="btn btn-danger" type="submit" id="btn-view" onclick="">Supprimer</button></form></td>';
                echo '<td><div class="conteneurBtn"><form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-info" id="btn-view" type="submit" value="Modifier"/></form><a class="btn btn-danger" href="#popup1">Supprimer</a></div></td>';
                echo '</tr>';

              }
              else{
                echo '<tr>';
                echo '<td>'.$unAdherent['nom'].'</td>';
                echo '<td>'.$unAdherent['prenom'].'</td>';
                echo '<td>'.$unAdherent['adresse'].'</td>';
                echo '<td>'.dateFr($unAdherent['dateAdhesion']).'</td>';
                echo '<td>'.$unAdherent['remarque'].'</td>';
                // echo '<td><div id=conteneurBtn><form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-info" id="btn-view" type="submit" value="Modifier"/></form><form id="formSupp" method="POST" id="suppAdherent" ><input type="hidden" name="id" value='.$id.'><button class="btn btn-danger" type="submit" id="btn-view" onclick="">Supprimer</button></form></td>';
                echo '<td><div class="conteneurBtn"><form action="ModifAdherent.php" id="modifadherent" method="POST"><input type="hidden" name="id" value='.$id.'><input class="btn btn-info" id="btn-view" type="submit" value="Modifier"/></form><a class="btn btn-danger" href="#popup1">Supprimer</a></div></td>';
                echo '</tr>';
              }
            }


            ?>
          </div>

        </tbody>
      </table>
      <form action="accueil.php" id="annulerfacturation">
        <input class="btn btn-info" onclick="history.go(-1)" type="submit" value="Retour">
      </form>
  </div>
  <!-- <div class="box2">
  	<a class="button2" href="#popup1">Let me Pop up</a>
  </div> -->

  <div id="popup1" class="overlay">
  	<div class="popup2">
  		<h3>Êtes-vous sûr de vouloir supprimer l'adhérent ?</h3>
  		<div class="content2">
  			<form id="oui" action="validerSupp.php" method="post">
          <input type="hidden" name="id" value="<?php echo $id;?>">
          <input type="submit" value="Oui" class="btn btn-info" >
        </form>
        <!-- <a type="button" onclick="location.replace('ListeAdherents.php');" class="btn btn-info" id="non">Non</a> -->
        <input type="submit" class="btn btn-info" value="Non" id="non" onclick=" relocate_home()">
        <script>
        function relocate_home()
        {
             location.href = "ListeAdherents.php";
        }
        </script>
  		</div>
  	</div>
  </div>
</body>
</html>
