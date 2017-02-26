<?php 
include('../../config.php');
$titre="Suppression Poste";
include('../includes/debut.php');
include('../../crudl/poste.php');

$pos = new poste();
$pos->supprimer();

//include('../includes/fin.php');
?>