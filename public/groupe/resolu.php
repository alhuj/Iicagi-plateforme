<?php
include('../../config.php');
include('../includes/debut.php');

$req="UPDATE question SET resolu=1 WHERE idQu=".$_GET['id'];
mysql_query($req) or die(mysql_error());

header("location: $_SERVER[HTTP_REFERER]");
?>