<?php
include('../../config.php');
$titre="Ajout Utilisateurs";
include('../includes/debut.php');
include('../includes/menuGroupe.php');
include('../../crudl/uti_gr.php');


$uti = new uti_gr();
$uti->ajoute();



include('../includes/fin.php');
?>
