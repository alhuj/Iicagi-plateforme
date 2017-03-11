<?php
include'../config.php';
$req=mysql_query("select avatar, pseudo, description, prenom, nom, idPrivi, idType, idFil, idNiv, DATE_FORMAT(dateNaiss, '%d %M') dateNaiss, DATE_FORMAT(dateDerConn, 'En ligne le %d %M %Y à %h:%m:%s') dateDerConn from utilisateur where idUti=".$_GET['idUti']);
$aff=mysql_fetch_array($req);
$titre='Profile de '.$aff['pseudo'];
include'includes/debut.php';
include'includes/menuProf.php';
include'../crudl/fonction.php';
$req1=mysql_query('select * from filiere_sys where idFil='.$aff['idFil']);
$aff1=mysql_fetch_array($req1);
$req2=mysql_query('select * from niveau_sys where idNiv='.$aff['idNiv']);
$aff2=mysql_fetch_array($req2);
$req4=mysql_query('select * from type_utilisateur_sys where idType='.$aff['idType']) or die(mysql_error());
$aff4=mysql_fetch_array($req4);
$avatar=$aff['avatar'];
?>
<section class="row">
	<div class="col-md-6">
           <img src="../banque de donnees/utilisateur avatar/<?php avatar($avatar); ?>" style="display:block; height:400px; width:150" class="img-responsive img-thumbnail" />
	</div>
	<section class="col-md-6 ">
		<div class="panel panel-default">
				<div class="panel-heading">Identité</div>
				<div class="panel-body">
		<table class="table">
			<tr>
				<td>
					Pseudo
				</td>
				<td>
					:
				</td>
				<td>
					<?php echo '<b>'.$aff['pseudo'].'</b>';?>
				</td>
			</tr>
			<tr>
				<td>
					Prénom et Nom
				</td>
				<td>
					:
				</td>
				<td>
					<?php echo '<b>'.$aff['prenom'].' '.$aff['nom'].'</b>';?>
				</td>
			</tr>
			<tr>
				<td>
					Date d'anniversaire
				</td>
				<td>
					:
				</td>
				<td>
					<?php echo '<b>'.$aff['dateNaiss'].'</b>';?>
				</td>
			</tr>
			<tr>
				<td>
					Type d'utilisateur
				</td>
				<td>
					:
				</td>
				<td>
					<?php echo '<b>'.$aff4['libelleType'].'</b>'; ?>
				</td>
			</tr>
			<?php if($aff2['idNiv']==1 || $aff1['idFil']==1){
					}else
					echo'
			<tr>
				<td>
					Classe
				</td>
				<td>
					:
				</td>
				<td>
							<b>'.$aff2['libelleNiv'].' '.$aff1['libelleFil'].'</b>'; ?>

				</td>
			</tr>
		</table>
	</div>
	</div>
		<div class="alert alert-inverse" role="alert">
		  <h4 class="alert-heading">Statut:</h4>
		  <div class="well">
		  	<?php if($aff['description']){
		  		echo $aff['description'];
		  		}else{
		  				echo 'Bonjour, je suis '.$aff['pseudo'].' de la plateforme!';
		  			} ?>
		  </div>
		  <p class="mb-0"><small><?php echo $aff['dateDerConn']; ?></small></p>
		</div>

	</section>
</section>
<section class="row">
	<section class="col-md-6 ">
	    <div class="panel panel-success">
	        <div class="panel-heading">Groupes en commun</div>
					<div class="panel-body">
	            <?php
									$idUti=$_GET['idUti'];
									$ids=array($idUti,$id1);
									$idstr=implode(", ", $ids);
									$requete=mysql_query("SELECT * FROM groupe WHERE idGrp IN
													(SELECT idGrp FROM utilisateur_groupe WHERE idUti IN ($idstr)
													GROUP BY idGrp HAVING COUNT(*)=2)")or die(mysql_error());
									$nbrTotalQues = mysql_num_rows($requete);
									$nbrQuesParPage=4;
									$pagestr='<a href="profile.php?idUti='.$_GET['idUti'].'&&page=';
						 paginationn($nbrTotalQues, $nbrQuesParPage, $pagestr);
							$limit=$GLOBALS['limit'];
							$pagination=$GLOBALS['pagination'];

									$quer="SELECT * FROM groupe WHERE idGrp IN
													(SELECT idGrp FROM utilisateur_groupe WHERE idUti IN ($idstr) GROUP BY idGrp HAVING COUNT(*)=2) $limit";
									$req=mysql_query($quer) or die (mysql_error());
									$resul=mysql_num_rows($req);
											if($resul){
												while($aff=mysql_fetch_array($req)){
												echo  '<table class="table"><tr><td><img width=50px height=50px src="http://localhost/plateforme/banque de donnees/groupe avatar/'.$aff['avatarGrp'].'"/></td><td><h5><a href="http://localhost/plateforme/public/groupe/affiche.php?id='.$aff['idGrp'].'">'.$aff['libelleGrp'].'</a></h5></td></tr></table>';
												}
											} else echo 'Aucun groupe en communs.';
									?>
				</div>

					<div class="panel-footer">
						<nav aria-label="Page navigation">
							<ul class="pager">
								<li><?php echo $pagination; ?></li>
							</ul>
						</nav>
					</div>
</div>
			</div>
		</section>
		<section class="col-md-6 ">
				<div class="panel panel-info">
		        <div class="panel-heading">Sujets de discussion</div>
						<div class="panel-body">
	                   <?php
										$requete=mysql_query('select * from question where idGrp=1 AND idUti='.$_GET['idUti'])or die(mysql_error());
										$nbrTotalQues = mysql_num_rows($requete);
										$nbrQuesParPage=5;
										$pagestr='<a href="profile.php?idUti='.$_GET['idUti'].'&&page=';
							 paginationn($nbrTotalQues, $nbrQuesParPage, $pagestr);
		 						$limit=$GLOBALS['limit'];
		 						$pagination=$GLOBALS['pagination'];
								$reqQu=mysql_query('select * from question where idGrp=1 AND idUti='.$_GET['idUti'].'
											order by idQu desc '.$limit) or die(mysql_error());
							$rows=mysql_num_rows($reqQu);
							if($rows){
								while($affQu=mysql_fetch_array($reqQu)){
								echo  '<table class="table"><tr><td><h5><a href="http://localhost/plateforme/public/forum/voir_poste.php?idQu='.$affQu['idQu'].'">'.$affQu['sujet'].'</a></h5></td></tr></table>';
								}
								echo'
								</div>
									<div class="panel-footer">
										<nav aria-label="Page navigation">
											<ul class="pager">
												<li>'.$pagination.'</li>
											</ul>
										</nav>
									</div>';
							} else echo 'Aucun sujet de discussion.';
					echo'
    </div>
	</section>
</section>
';
include'includes/fin.php';
?>
