<?php
include('../../config.php');
$titre="Affiche Groupe";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/groupe.php');
include('../../crudl/uti_gr.php');

$idGrp=$_GET['id'];
$resultat = mysql_query("SELECT avatarGrp FROM groupe where idGrp=".$idGrp) or die (mysql_error());
$row = mysql_fetch_array($resultat);
$avatar=$row['avatarGrp'];

echo"
<div class='row'>

	<div class='col-md-8'>";

		$grp = new groupe();
		$grp->affiche();

echo"
	</div>

	<div class='col-md-4'>
		<div class='list-group'>
			<a href='chercheUti.php?id=".$idGrp."' class='list-group-item'>Ajouter Utilisateurs</a>
			<a href='../Groupe/ajouter_sujet.php?id=".$idGrp."' class='list-group-item'>Poser Question</a>
		</div>
";
$uti = new uti_gr();
$uti->liste();

echo"
	</div>

</div>";


include('../includes/fin.php');
?>
