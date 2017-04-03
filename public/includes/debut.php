<?php
session_start();
$id1=(isset($_SESSION['id']))? (int) $_SESSION['id']:0;
$pseudo=(isset($_SESSION['pseudo']))? $_SESSION['pseudo']:'';
$avatar=(isset($_SESSION['avatar']))? $_SESSION['avatar']:'';
$idPrivi=(isset($_SESSION['idPrivi']))? (int) $_SESSION['idPrivi']:0;
$url=$_SERVER['PHP_SELF'] ;
if(($id1==0) && ($url!='/plateforme/public/index.php'))
{
	echo '<script>alert("Aucune connexion, veuillez vous connecter avant de pouvoir consulter le contenu de cette page.");</script>';
	header('refresh:0;http://localhost/plateforme/public/index.php');
	exit;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta name="viewport" content="" />
<script src="http://localhost/plateforme/public/style/js/bootstrap.min.js"></script>
<script src="http://localhost/plateforme/public/js/codeJS.js"></script>
<script src="http://localhost/plateforme/public/js/editeur.js"></script>
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.1/js/bootstrap.min.js"></script>
<link rel="stylesheet" type="text/css" href="//netdna.bootstrapcdn.com/bootstrap/3.1.1/css/bootstrap.min.css">

<link rel="stylesheet" href="http://localhost/plateforme/public/style/style.css"/>
<link href="http://localhost/plateforme/public/style/css/bootstrap.min.css" rel="stylesheet" type="text/css" />

<?php
$req=mysql_query("SELECT * FROM etablissement_sys");
$result=mysql_fetch_assoc($req);
echo (!empty($titre))?"<title>".$titre."</title>":"<title> ".$result['sigleEta']."-Plateforme </title>";

?>

</head>
<body class="container-fluid" style="background:#CCC">
        <header style="background:#FFF" class=" row modal-header">
        	<div class="container-fluid row">
                        <h3 class="col-md-5">
                       		<a href="http://localhost/plateforme/public/index.php">
                             	<img src="http://localhost/plateforme/banque de donnees/<?php echo $result['logoEta']; ?>" width="80" height="80" />
                                <b>
                                   <i>
                                     <?php echo $result['sigleEta']; ?><small> - Plateforme d'entraide</small>
                                   </i>
                               </b>
                    	   </a>

              			</h3>
<?php
if($id1!=0){
	//debut menu
echo'
                         <ul style="margin-top:20px" class="col-md-6 nav navbar-nav ">
                              <li >
                                  <a href="http://localhost/plateforme/public/index.php">
                                      Accueil
                                  </a>
                              </li>
                              <li>
                                  <a href="http://localhost/plateforme/public/forum/index.php">
                                      Forum
                                  </a>
                              </li>
                              <li>
                                  <a href="http://localhost/plateforme/public/groupe/index.php">
                                      Groupe
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      Bibliothèque
                                  </a>
                              </li>
                              <li>
                                  <a href="#">
                                      Notifications
                                  </a>
                              </li>
                         </ul>

	';
//fin menu

?>
<div style="margin-top:20px">
    <ul class="nav navbar-nav ">
      <div align="center" class="dropdown ">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
    <img src="http://localhost/plateforme/banque de donnees/utilisateur avatar/<?php echo $avatar ?>" style="display:block; height:60; width:60px" class="img-responsive profile-image img-circle"/><?php echo $pseudo ?><b class="caret"></b></a>
  	  <ul class="dropdown-menu">
    		<li><a href="http://localhost/plateforme/public/compte.php">Compte</a></li>
        	<li class="divider"></li>
        	<li><a href="http://localhost/plateforme/public/chartes.php">Chartes</a></li>
    		<li><a href="http://localhost/plateforme/public/apropos.php">A propos</a></li>
        	<li class="divider"></li>
        	<li><a href="http://localhost/plateforme/public/includes/deconnexion.php">Deconnexion</a></li>
  	  </ul>
	  </div>
    </ul>
</div>

			</div>
    	</header>
<?php
}else echo "      </div>

      </header>
";
?>
