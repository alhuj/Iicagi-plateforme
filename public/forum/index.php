<?php 
include('../../config.php');
$titre="Forum";
include('../includes/debut.php');
include('../includes/menuForum.php');
include('../../crudl/question.php');
echo"<button class='btn btn-lg btn-primary' onclick='newSujet()'>Poser Question</button>";

$qes = new question();
$qes->liste();

include('../includes/fin.php');
?>