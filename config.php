<?php
error_reporting(E_ALL ^ E_DEPRECATED);
function conbd($nombd) {
	$host = "localhost";  
	$user = "root";
	$bd = $nombd;
	$mp  = "";
	mysql_connect($host, $user,$mp) or die("Impossible de se connecter au serveur");
	mysql_select_db($bd) or die("Impossible de se connecter a la base de donnees");
}

function deconbd() {

	mysql_close();
}
conbd('forum');
?>