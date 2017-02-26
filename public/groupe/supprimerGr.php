<?php 
include('../../config.php');
$titre="Suppression...";
include('../includes/debut.php');
include('../../crudl/groupe.php');

			
$grp = new groupe();
$grp->supprimer();


include('../includes/fin.php');
?>