<?php
include'../config.php';
include'includes/debut.php';
include'../crudl/fonction.php';
$req=mysql_query('select * from utilisateur where idUti='.$_GET['idUti']);
$aff=mysql_fetch_array($req);
$avatar=$aff['avatar'];
?>
<section>
	<section class="col-md-12">
           <img src="../banque de donnees/utilisateur avatar/<?php avatar($avatar); ?>" style="display:block; height:400px; width:150" class="img-responsive img-thumbnail" />
	</section>
    <section class="col-md-4">
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
							echo  '<h4><a href="http://localhost/plateforme/public/groupe/affiche.php?id='.$aff['idGrp'].'">'.$aff['libelleGrp'].'</a></h4>';
							}
						} else echo 'Aucun groupe en communs.';		
			?>
	</section>
    <section class="col-md-4">
        <h3>Sujets de discussion</h3>
                   <?php 
				   		$reqQu=mysql_query('select * from question where idGrp=1 AND idUti='.$_GET['idUti']) or die(mysql_error());
						$rows=mysql_num_rows($reqQu);
						if($rows){
							while($affQu=mysql_fetch_array($reqQu)){
							echo  '<h4><a href="http://localhost/plateforme/public/forum/voir_poste.php?idQu='.$affQu['idQu'].'">'.$affQu['sujet'].'</a></h4>';
							}
						} else echo 'Aucun sujet de discussion.';
					?>
	</section>
    <section class="col-md-4">
        <h3>Articles</h3>
                   <?php 
				   		$reqArt=mysql_query('select * from article where idUti='.$_GET['idUti']) or die(mysql_error());
						$rows=mysql_num_rows($reqArt);
						if($rows){
							while($affArt=mysql_fetch_array($reqArt)){
							echo '<h4><a href="">'.$affArt['libelleArt'].'</a></h4>';
							}
						} else echo 'Aucun article publié dans la bibliothèque.';
					?>
    </section>
</section>

<?php
include'includes/fin.php';
?>