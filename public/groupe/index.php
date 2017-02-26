<?php 
include('../../config.php');
$titre="Groupe";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/groupe.php');

echo"<div class='row'>";
			
		$grp = new groupe();
		$grp->liste();

echo"</div>";



include('../includes/fin.php');
?>