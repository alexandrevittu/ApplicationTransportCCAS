<!DOCTYPE html>
<html>
<head>
<title>Gestion compte</title>
<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet" media="screen"> <!-- ici-->
<link href="bootstrap/css/bootstrap-theme.min.css" rel="stylesheet" media="screen">
<link href="assets/datatables.min.css" rel="stylesheet" type="text/css"> <!-- ici-->
<script type="text/javascript" src="assets/datatables.min.js"></script> <!-- ici-->
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.3/js/dataTables.fixedHeader.min.js"></script>
<?php
  include_once "header.php";
  include_once "../fonctions/fonctions.php";  //inclut l'en-tete
  getcompteutilisateur($_SESSION['id']);
  $lesUtilisateur = getUtilisateur();
?>
<script>

  $(document).ready(function() {
    $('#example').DataTable({
      pagingType: "simple_numbers",
      lengthMenu:[5,10,15,20,25],       //affichage par default a 20 puis selection possible a 5,10,15,20,25
      pageLength: 20,
      // fixedHeader: true,
      "oLanguage": {
  "sInfo": "Il y a un total de  _TOTAL_ adhérents (_START_ à _END_)"
    },
    })
  });

</script>
</head>
<body>
  <h2 style="text-align:center;">Gestion des utilisateurs</h2>
  <div id="conteneur">
    <table class="table table-striped table-hover table-responsive no-footer table-bordered" id="example">
      <thead>
        <tr>
          <th>Pseudo</th>
          <th>Mail</th>
          <th>Gestion</th>
        </tr>
      </thead>
      <tbody>


<?php
  foreach($lesUtilisateur as $unUtilisateur)
  {
    echo '<tr>';
    echo '<td>'.$unUtilisateur['Pseudo'].'</td>';
    echo '<td>'.$unUtilisateur['Mail'].'</td>';
    echo '<td><form action="Modifpseudo.php" id="modifpseudo" method="POST"><input type="hidden" name="id" value='.$unUtilisateur['id'].'><input class="btn btn-info" type="submit" value="Modifier identifiant"/></form><form action="Modifmdp.php" id="modifmdp" method="POST"><input type="hidden" name="id" value='.$unUtilisateur['id'].'><input class="btn btn-info" type="submit" value="Modifier mot de passe"/></form></td>';
    echo '</tr>';
  }
?>
    </tbody>
  </table>
</div>
</body>
</html>
