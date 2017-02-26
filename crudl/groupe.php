<?php
//*****************
include 'fonction.php';

class groupe{
	public function liste(){
		echo "<table class='table table-hover '>

    <thead>
        <tr>
			<th>Avatar</th>
            <th>Libellé</th>
            <th style='width:45%'>Description</th>
			<th>Date Création</th>
			<th>Créé Par</th>
        </tr>
    </thead>

	 <tbody>

            ";
				$idUti=$_SESSION['id'];
				$resutat = mysql_query("SELECT * FROM
										groupe g, utilisateur_groupe u
										WHERE g.idGrp=u.idGrp AND u.idUti=$idUti") or die(mysql_error());
				if(mysql_num_rows($resutat)== 0){
 					  echo "<tr><th>Vous n'avez créer ou ne participez à aucun groupe....</th></tr>";
					}else{
				$nbrTotalQues = mysql_num_rows($resutat);
				$nbrQuesParPage=5;
				$pagestr='<a href="index.php?page=';


				paginationn($nbrTotalQues, $nbrQuesParPage, $pagestr);

				$limit=$GLOBALS['limit'];
				$pagination=$GLOBALS['pagination'];



					$req = mysql_query("SELECT g.idGrp, libelleGrp, descGrp, dateCreatGrp, avatarGrp, u.idUti, t.idUti createur, pseudo
										FROM utilisateur_groupe u, groupe g, utilisateur t
										WHERE g.idGrp=u.idGrp AND t.idUti=g.idUti AND u.idUti=$idUti
										GROUP BY g.idGrp
										ORDER BY g.idGrp DESC $limit") or die(mysql_error());

					while($affich = mysql_fetch_array($req)){
						echo	"<tr>
							<th class='text-capitalize'>
								<img src='http://localhost/plateforme/banque de donnees/groupe avatar/";
								avatarGrp($affich['avatarGrp']);
						echo	"' style='display:block; height:60px; width:60px;' class='img-responsive profile-image img-rounded'' />
							</th>
							<th onclick='ouvrirEnrg(".$affich['idGrp'].")'>".$affich['libelleGrp']."</th>
							<th onclick='ouvrirEnrg(".$affich['idGrp'].")'>".$affich['descGrp']."</th>
							<th onclick='ouvrirEnrg(".$affich['idGrp'].")'>".$affich['dateCreatGrp']."</th>
							<th onclick='ouvrirEnrg(".$affich['idGrp'].")'><a href='../profile.php?idUti=".$affich['createur']."'>".$affich['pseudo']."</a></th>";

							if($_SESSION['id']==$affich['createur']){

							echo"<th>
							<div class='dropdown' style='float:right'>
  								<button class='btn dropdown-toggle' type='button' data-toggle='dropdown'>
  									<span class='caret'></span>
								</button>
  								<ul class='dropdown-menu'>
    								<li><a href='modifierGr.php?id=".$affich['idGrp']."'>Modifier</a></li>
									<li class='divider'></li>
    								<li><a href='supprimerGr.php?id=".$affich['idGrp']."'>Supprimer</a></li>
  								</ul>
							</div>
							</th>
							</tr>";
							}

					}
					}
								echo ' </tbody>
										</table>
										<nav aria-label="Page navigation">
											<ul class="pager">
												<li>'.$pagination.'</li>
											</ul>
										</nav>
									';

	}
	public function ajouter(){
		if(isset($_POST['Submit'])){
				$idUti=$_SESSION['id'];
				$libelleGrp = mysql_real_escape_string(htmlspecialchars($_POST['libelleGrp']));
				$descGrp = mysql_real_escape_string(htmlspecialchars($_POST['descGrp']));

				if (empty($_POST['libelleGrp']) && empty($_POST['descGrp']))
    			{
    			?>
        			<script>
            			Javascript:alert('ECHEC....... Veuillez renseigner les champs. S\'il vous plait.')
        			</script>
    			<?php
				}

				elseif (empty($_POST['libelleGrp']) && !empty($_POST['descGrp']))
    			{
    			?>
        			<script>
            			Javascript:alert('ECHEC....... Veuillez Donner un nom à votre groupe.')

        			</script>
    			<?php
    			}

				elseif (!empty($_POST['libelleGrp']) && empty($_POST['descGrp']))
    			{
    			?>
        			<script>
            			Javascript:alert('ECHEC....... Veuillez décrire brèvement votre groupe.')
				    </script>
    			<?php
				}

				else{
					$req = mysql_query("INSERT INTO groupe (libelleGrp, descGrp, idTypGrp, idUti) VALUES('$libelleGrp','$descGrp',2,'$idUti')") or die (mysql_error());
					$resultat = mysql_query("SELECT LAST_INSERT_ID() createur FROM groupe");
					$row = mysql_fetch_array($resultat);
					$idCreateur = $row['createur'];
					$req2 = mysql_query("INSERT INTO utilisateur_groupe (idGrp,idUti) VALUES($idCreateur,$idUti)");
					if($req && $req2){
				 	echo'<script>alert("Ajout reussi!!!"); indexRedir()</script>';
					}
				}
			}
	}

	public function modifier(){
		if(isset($_POST['submit'])){
			$idGrp = $_POST['idGrp'];
			$libelleGrp = mysql_real_escape_string(htmlspecialchars($_POST['libelleGrp']));
			$descGrp = mysql_real_escape_string(htmlspecialchars($_POST['descGrp']));
			$resultat = mysql_query("UPDATE groupe SET libelleGrp = '$libelleGrp', descGrp = '$descGrp' WHERE idGrp = ".$idGrp) or die( mysql_error());
			if($resultat)
			{
				echo("<script>alert('La modification à été effectuée avec succes.');indexRedir();</script>") ;

			}
			else
			{
				echo("<script>alert('La modification à échouée.')</script>") ;

			}
		}
	}
	public function supprimer(){
			if(isset($_GET['id'])){
				$req = mysql_query('DELETE FROM groupe WHERE idGrp='.$_GET['id']);// or die(mysql_error);
				if($req)
				{
				echo("<script>alert('La suppression à été effectuée avec succes.'); indexRedir();</script>");
				}
				else
				{
					echo("<script>alert('La Suppression a échouée.');</script>");
				}
			}
	}

	public function affiche(){
			$idGrp=$_GET['id'];
			$req = mysql_query("SELECT libelleGrp, descGrp, DATE_FORMAT(dateCreatGrp, '%d/%m/%Y à %Hh:%i') dateCreatGrp, avatarGrp
													FROM groupe where idGrp=$idGrp");
			$affiche=mysql_fetch_array($req);
			$avatar=$affiche['avatarGrp'];
			if($affiche){
				echo"
				<section>
					<div class='media'>
		  			<div class='media-left'>
							<img src='http://localhost/plateforme/banque de donnees/groupe avatar/";
							avatarGrp($avatar);
				echo	"' style='display:block; height:200px; width:300px' />
						</div>
						<div class='media-body'>
							<h2>".$affiche['libelleGrp']."</h2>
							<p>".$affiche['dateCreatGrp']."</p>
							<h3>".$affiche['descGrp']."</h3>
						</div>
					</div>
				</section>
				";
			}

	$resutat = mysql_query("SELECT * FROM question WHERE idGrp=".$_GET['id']) or die(mysql_error());
	if(mysql_num_rows($resutat)== 0){
 					  echo "<tr><th>Il n'y a pas encore de questions dans ce groupe........</th></tr>
							</tbody>
							</table>";
					}else{
			echo "<table class='table table-striped table-expansed table-radius'>
    <caption class='text-center'>Liste des qestions</caption>
    <thead>
        <tr>
            <th>Auteur</th>
            <th style='width:45%'>Sujet</th>
			<th>Vus</th>
            <th>Date</th>
            <th>Postes</th>
			<th>Resolu?</th>
        </tr>
    </thead>
	 <tbody>

            ";


$nbrTotalQues = mysql_num_rows($resutat);
$nbrQuesParPage=3;
$pagestr='<a href="affiche.php?id='.$idGrp.'&&page=';


paginationn($nbrTotalQues, $nbrQuesParPage, $pagestr);

$limit=$GLOBALS['limit'];
$pagination=$GLOBALS['pagination'];



	$req1=mysql_query("SELECT pseudo, avatar, idQu, sujet, DATE_FORMAT(heureQu, '%d/%m/%Y à %Hh:%i') heureQu, resolu, q.idUti aut, idGrp
	FROM question AS q, utilisateur AS u
	where u.idUti=q.idUti AND idGrp=$idGrp
	ORDER BY idQu DESC $limit") or die( mysql_error());

while($affich = mysql_fetch_array($req1)){
	$idQu=$affich['idQu'];
	$sql2="SELECT count(*) AS nbPo FROM poste where idQu='$idQu'";
	$sql3="SELECT count(*) AS vu FROM vu_question where idQu='$idQu'";
	$result2=mysql_query($sql2);
	$aff=mysql_fetch_array($result2);
	$result3=mysql_query($sql3);
	$show=mysql_fetch_array($result3);
	$avatar=$affich['avatar'];

					  echo	"<tr>
					  		<th class='text-capitalize'>
							<a href='../profile.php?idUti=".$affich['aut']."'>
								<img src='http://localhost/plateforme/banque de donnees/utilisateur avatar/";
								avatar($avatar);
						echo	"'
								style='display:block; height:60px; width:60px;' class='img-responsive profile-image img-rounded''>
								<span style='padding-left:5px'>".$affich['pseudo']."</span>
							</a>
							</th>
					  		<th><a href='voir_poste.php?idQu=".$affich['idQu']."'>".$affich['sujet']."</a></th>
							<th>".$show['vu']."</th>
							<th>".$affich['heureQu']."</th>
							<th>".$aff['nbPo']."</th>";
	if($affich['resolu']==1){
					  echo"<th class='text-success'>OUI</th>";
	}
	else{
					   echo"<th class='text-danger'>NON</th>";
	}
}
					  echo '</tr>
							</tbody>
							</table>
							<nav aria-label="Page navigation">
								<ul class="pager">
									<li>'.$pagination.'</li>
								</ul>
							</nav>
							';

	}
	}


}//fin classe groupe
?>
