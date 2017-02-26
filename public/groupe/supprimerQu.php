<?php 
include('../../config.php');
$titre="Suppression du Sujet";
include('../includes/debut.php');
include('../../crudl/question.php');

$qes = new question();
$qes->supprimer();

//include('../includes/fin.php');
?>