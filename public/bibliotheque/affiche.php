<?php
include('../../config.php');
$titre="Bibliothèque";
include('../includes/debut.php');
include('../includes/menuBiblio.php');
include('../../crudl/article.php');
$art = new article();
//$art->();
while($aff=mysql_fetch_array($req)){
    echo"<section class='col-md-12'>
            <h3>Les documents de type ".$aff['libelleTypArt']."</h3>";
			$req1=mysql_query('select * from article where idArt='.$aff['idTypArt']) or die(mysql_error());
			}else 	while($aff1=mysql_fetch_array($req1)){
					$r2=mysql_query('select * from utilisateur where idUti='.$aff1['idUti']) or die(mysql_error());
					$a2=mysql_fetch_array($r2);
					echo"<div class='col-md-3'>
					<iframe src='http://localhost/plateforme/banque de donnees/article/".$aff1['lienArt']."' width='75' height='100' align='middle'></iframe>
					Titre: ".$aff1['libelleArt']."
					Publicateur: ".$a2['pseudo']."
						 </div>
						";
				}
    echo"</section>";
}
include('../includes/fin.php');
?>
