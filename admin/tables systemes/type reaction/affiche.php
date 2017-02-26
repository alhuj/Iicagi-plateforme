<?php 
include('../../../config.php');
$titre="Liste des types réactions";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/typereaction.php');
$fil = new typeReaction();
$fil->affiche();
include('../../includes/fin.php');
?>