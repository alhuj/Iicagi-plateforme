<?php 
include('../../../config.php');
$titre="Liste des Questions";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/questionAdmin.php');

$ques = new questionAdmin();
$ques->liste();

include('../../includes/fin.php');
?>