<?php
include'../config.php';
$req=mysql_query("select  avatar, pseudo, description, prenom, nom, idPrivi, idType, idFil, idNiv, DATE_FORMAT(dateNaiss, '%d %M') dateNaiss, DATE_FORMAT(dateDerConn, 'En ligne le %d %M %Y à %h:%m:%s') dateDerConn from utilisateur where idUti=".$_GET['idUti']);
$aff=mysql_fetch_array($req);
$titre='Profile de '.$aff['pseudo'];
include'includes/debut.php';
include'includes/menuProf.php';
include'../crudl/fonction.php';
$req1=mysql_query('select * from filiere_sys where idFil='.$aff['idFil']);
$aff1=mysql_fetch_array($req1);
$req2=mysql_query('select * from niveau_sys where idNiv='.$aff['idNiv']);
$aff2=mysql_fetch_array($req2);
$req3=mysql_query('select * from privilege_sys where idPrivi='.$aff['idPrivi']) or die(mysql_error());
$aff3=mysql_fetch_array($req3);
$req4=mysql_query('select * from type_utilisateur_sys where idType='.$aff['idType']) or die(mysql_error());
$aff4=mysql_fetch_array($req4);
$avatar=$aff['avatar'];
?>
<section class="row">
	<section class="col-md-6">
           <img src="../banque de donnees/utilisateur avatar/<?php avatar($avatar); ?>" style="display:block; height:400px; width:150" class="img-responsive img-thumbnail" />
	</section>
	<section class="col-md-6">
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
					Privilège
				</td>
				<td>
					:
				</td>
				<td>
					<?php echo '<b>'.$aff3['libellePrivi'].'</b>';?>
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
		<div class="alert alert-inverse" role="alert">
		  <h4 class="alert-heading">Statut:</h4>
		  <p>
		  	<?php if($aff['description']){
		  		echo $aff['description'];
		  		}else{
		  				echo 'Bonjour, je suis '.$aff['pseudo'].' de la plateforme!';
		  			} ?>
		  </p>
		  <p class="mb-0"><small><?php echo $aff['dateDerConn']; ?></small></p>
		</div>
	</section>
</section>
<section class="row">
	    <section class="col-md-6">
	        <h3>Groupes en commun</h3>
	            <?php
					$idUti=$_GET['idUti'];
					$ids=array($idUti,$id1);
					$idstr=implode(", ", $ids);
					$quer="SELECT * FROM groupe WHERE idGrp IN
									(SELECT idGrp FROM utilisateur_groupe WHERE idUti IN ($idstr) GROUP BY idGrp HAVING COUNT(*)=2)";
					$req=mysql_query($quer) or die (mysql_error());
					$resul=mysql_num_rows($req);
							if($resul){
								while($aff=mysql_fetch_array($req)){
								echo  '<table class="table"><tr><td><img width=50px height=50px src="http://localhost/plateforme/banque de donnees/groupe avatar/'.$aff['avatarGrp'].'"/></td><td><h5><a href="http://localhost/plateforme/public/groupe/affiche.php?id='.$aff['idGrp'].'">'.$aff['libelleGrp'].'</a></h5></td></tr></table>';
								}
							} else echo 'Aucun groupe en communs.';
				?>
		</section>
	    <section class="col-md-6">
	        <h3>Sujets de discussion</h3>
	                   <?php
					   		$reqQu=mysql_query('select * from question where idGrp=1 AND idUti='.$_GET['idUti']) or die(mysql_error());
							$rows=mysql_num_rows($reqQu);
							if($rows){
								while($affQu=mysql_fetch_array($reqQu)){
								echo  '<table class="table"><tr><td><h5><a href="http://localhost/plateforme/public/forum/voir_poste.php?idQu='.$affQu['idQu'].'">'.$affQu['sujet'].'</a></h5></td></tr></table>';
								}
							} else echo 'Aucun sujet de discussion.';
						?>
		</section>
    </section>
</section>

<?php
include'includes/fin.php';
?>
