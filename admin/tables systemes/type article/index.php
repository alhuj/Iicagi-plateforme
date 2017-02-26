<?php 
include('../../../config.php');
$titre="Liste des types d'articles";
include('../../includes/debut.php');
include('../../includes/menu.php');
include('../aside.php');
include('../../../crudl/typearticle.php');
$fil = new typeArticle();
$fil->liste();
include('../../includes/fin.php');
?>