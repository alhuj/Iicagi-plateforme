<?php 
include('../../config.php');
$titre="Bibliothèque";
include('../includes/debut.php');
include('../includes/menuBiblio.php');
include('../../crudl/article.php');
$art = new article();
include('../includes/fin.php');
?>