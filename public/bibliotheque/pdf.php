<?php 
include('../../config.php');
$titre="Articles PDF";
include('../includes/debut.php');
include('../includes/menuBiblio.php');
include('../../crudl/article.php');
$art = new article();


			$req1=mysql_query('select * from article where idTypArt=3') or die(mysql_error());
			if(mysql_num_rows($req1)==0){
				echo "<strong>Pas d'articles de ce type </strong>";
			}else 
			echo'<div class="row">';

		while($aff1=mysql_fetch_array($req1)){
			$req2=mysql_query('select * from utilisateur where idUti='.$aff1['idUti']) or die(mysql_error());
			$aff2=mysql_fetch_array($req2);
 			echo' <div class="col-md-6">
		    <div class="thumbnail">
		    <iframe  width="490" height="600" src="http://localhost/plateforme/banque de donnees/article/'.$aff1['lienArt'].'" frameborder="0" allowfullscreen></iframe>
		      <div class="caption">
		        <h3>'.$aff1['libelleArt'].'</h3>
		        <p>'.$aff1['descArt'].'<br><i>Mis en ligne par </i><b>'.$aff2['pseudo'].'</b><i> le </i><b>'.$aff1['datePub'].'</b></p>
		        <p><a href="#" class="btn btn-primary" role="button">Voir plus...</a> <a href="#" class="btn btn-default" role="button">Button</a></p>
		      </div>
		    </div>
		  </div>';
   }
   echo'</div>
';
include('../includes/fin.php');
?>