<?php 
include('../config.php');
$titre="Connexion";
include('includes/debut.php');
include('includes/menu.php');
$r=mysql_query('select * from utilisateur');
if(mysql_num_rows($r)!=0)
		{
			if($id==0)
				{
					require("includes/connection.php");
				}else
					 header('location:http://localhost/plateforme/admin/panneau.php');
		}else 
			require("includes/ouverture.php");

include('includes/fin.php');
?>