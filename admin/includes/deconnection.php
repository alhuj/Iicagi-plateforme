<?php
	include "../../config.php";
	session_start();
	session_unset();
	session_destroy();
	deconbd();

	header('location://localhost/plateforme/admin/index.php');

?>
