<?php
$titre = "Liste des utilisateurs";
include("../../../config.php");
include("../../includes/debut.php");
include("../../includes/menu.php");
include("../aside.php");
include("../../../crudl/utilisateur.php");
$user= new utilisateur();
$user->liste();

include("../../includes/fin.php");
?>