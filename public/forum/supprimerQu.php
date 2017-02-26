<?php 
include('../../config.php');
$titre="Supprimer Sujet";
include('../includes/debut.php');
include('../../crudl/question.php');

$qes = new question();
$qes->supprimer();

//include('../includes/fin.php');
?>