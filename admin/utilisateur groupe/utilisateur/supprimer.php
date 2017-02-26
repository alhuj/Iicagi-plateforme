<script src="http://localhost/it-school/js/codeJS.js"></script>
<?php
include ("../../../config.php");
include('../../../crudl/utilisateur.php');
$fil= new utilisateur();
$fil->supprimer();
?>
