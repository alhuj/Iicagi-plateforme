<?php
session_start();
$id=(isset($_SESSION['idUti']))? (int) $_SESSION['idUti']:0;
$id1=(isset($_SESSION['id']))? (int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))? $_SESSION['pseudo']:'';
$avatar=(isset($_SESSION['avatar']))? $_SESSION['avatar']:'';
$url=$_SERVER['PHP_SELF'] ;
if(($id==0) && ($url!='/plateforme/admin/index.php'))
{	
	echo '<script>alert("Aucune connexion, veuillez vous connecter avant de pouvoir consulter le contenu de cette page.");</script>';
	header('refresh:0;http://localhost/plateforme/admin/index.php');
	exit;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="" />
<script src="http://localhost/plateforme/admin/style/js/bootstrap.min.js"></script>
<script src="http://localhost/plateforme/admin/js/codeJS.js"></script>
<link rel="stylesheet" href="http://localhost/plateforme/admin/style/style.css"/>
<link href="http://localhost/plateforme/admin/style/css/bootstrap.min.css" rel="stylesheet" type="text/css" />
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<?php
echo (!empty($titre))?"<title>".$titre."</title>":"<title> Panneau admin </title>";
?>

</head>
<body>
        <header class="modal-header navbar-fixed-top">
		<div class="row container">
                        <h3 class="col-md-4">
                       		<a href="http://localhost/plateforme/public/index.php">
                                <b>
                                   <i>
                                     Panneau d'administration
                                   </i>
                               </b>                          
                    	   </a>

              			</h3>
