<?php 
include('../../../config.php');
$titre="Liste des groupes";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/groupeAdmin.php');
$grp = new groupe();
$grp->liste();
include('../../includes/fin.php');
?>