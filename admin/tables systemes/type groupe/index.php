<?php 
include('../../../config.php');
$titre="Liste des types de groupes";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/typegroupe.php');
$fil = new typeGroupe();
$fil->liste();
include('../../includes/fin.php');
?>