<?php
include('../../config.php');
$titre="Affiche Groupe";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/groupe.php');
include('../../crudl/uti_gr.php');

$idGrp=$_GET['id'];


echo"
<div class='row'>

	<div class='col-md-8'>";

		$grp = new groupe();
		$grp->affiche();

echo"
	</div>

	<div class='col-md-4'>
<<<<<<< HEAD

=======
		<div class='list-group'>
			<button class='btn btn-lg btn-primary' onclick='newSujetGrp(".$idGrp.")'>Poser Question</button>
		</div>
>>>>>>> e248d46cb53c45618365cc2581cf0bc2b7247ecc
";
$uti = new uti_gr();
$uti->liste();

echo"
	</div>

</div>";


include('../includes/fin.php');
?>
