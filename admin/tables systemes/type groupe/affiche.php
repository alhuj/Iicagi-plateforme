<?php 
include('../../../config.php');
$titre="Liste des types groupes";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/typereaction.php');
$fil = new typeGroupe();
$fil->affiche();
include('../../includes/fin.php');
?>