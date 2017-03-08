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
								<img src='http://localhost/plateforme/banque de donnees/groupe avatar/".$affich['avatarGrp']."' style='display:block; height:60px; width:60px;' class='img-responsive profile-image img-rounded'' />
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
					$resultat = mysql_query("SELECT LAST_INSERT_ID() derGrp FROM groupe");
					$row = mysql_fetch_array($resultat);
					$idlastGrp = $row['derGrp'];
					$req2 = mysql_query("INSERT INTO utilisateur_groupe (idGrp,idUti) VALUES($idlastGrp,$idUti)");
					if($req && $req2){
				 	echo'<script>alert("Ajout reussi!!!"); grpRedir('.$idlastGrp.')</script>';
					}
				}
			}
	}

	public function modifier(){
			if(isset($_POST['submit'])){

				if(isset($_FILES['avatar'])){
						$idGrp = $_POST['idGrp'];
						$libelleGrp = mysql_real_escape_string(htmlspecialchars($_POST['libelleGrp']));
						$descGrp = mysql_real_escape_string(htmlspecialchars($_POST['descGrp']));
						$dossier = '../../banque de donnees/groupe avatar/';
						$fichier = basename($_FILES['avatar']['name']);
						$taille_maxi = 1000000;
						$taille = filesize($_FILES['avatar']['tmp_name']);
						$extensions = array('.png', '.gif', '.jpg', '.jpeg');
						$extension = strrchr($_FILES['avatar']['name'], '.'); 
						//Début des vérifications de sécurité...
						if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
						{
							 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
						}
						if($taille>$taille_maxi)
						{
							 $erreur = 'Le fichier est trop gros...';
						}
						if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
						{
							 if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier.$libelleGrp.$extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
							 {
								  $avatarGrp=$libelleGrp.$extension;
								  $req=mysql_query("UPDATE groupe SET avatarGrp = '$avatarGrp', libelleGrp = '$libelleGrp', descGrp = '$descGrp' WHERE idGrp = ".$idGrp) or die(mysql_error());
								  if($req){
									  echo '<script>alert("Upload effectué avec succès !");grpRedir('.$idGrp.');</script>';
									 
								  }
							 }
							 else //Sinon (la fonction renvoie FALSE).
							 {
								  echo '<script>alert("Echec de l\'upload !");</script>';
							 }
						}
						else
						{
							 echo '<script>alert("'.$erreur.'");</script>';
						}
				}elseif(!isset($_FILES['avatar'])) {
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
			$req = mysql_query("SELECT libelleGrp, descGrp, DATE_FORMAT(dateCreatGrp, 'Créé le %d/%m/%Y à %Hh:%i') dateCreatGrp, avatarGrp, idUti
													FROM groupe where idGrp=$idGrp");
			$affiche=mysql_fetch_array($req);
			if($affiche){
				echo"
				<section>
					<div class='media'>
		  			<div class='media-left'>
							<img src='http://localhost/plateforme/banque de donnees/groupe avatar/".$affiche['avatarGrp']."' style='display:block; height:200px; width:300px' />
						</div>

						<div class='media-body'>
							<h2>".$affiche['libelleGrp']."</h2>
							<p><b><i>".$affiche['dateCreatGrp']."</i></b></p>
							<h3>".$affiche['descGrp']."</h3>
						</div>";
					if($_SESSION['id']==$affiche['idUti']){
						echo"<br>
							<div class='list-group'>
								<button class='btn btn-lg btn-inverse' onclick='newSujetGrp(".$idGrp.")'><span class='glyphicon glyphicon-pencil' aria-hidden='true'></span> Poser Question</button>
								<button class='btn btn-lg btn-inverse' onclick='newPartGrp(".$idGrp.")'><span class='glyphicon glyphicon-share' aria-hidden='true'></span> Partager</button>
								<button class='btn btn-lg btn-inverse' onclick='btnModifGr(".$idGrp.")'><span class='glyphicon glyphicon-edit' aria-hidden='true'></span> Modifier</button>
								<button class='btn btn-lg btn-inverse' onclick='btnSuppGr(".$idGrp.")'><span class='glyphicon glyphicon-trash' aria-hidden='true'></span> Supprimer</button>
							</div>";
						}
						echo"
						</div>
					</section>
					";
			}

	$resutat = mysql_query("SELECT * FROM question WHERE idGrp=".$_GET['id']) or die(mysql_error());
	if(mysql_num_rows($resutat)== 0){
 					  echo "<tr><th><h1>Il n'y a pas encore de discussions dans ce groupe........</H1></th></tr>
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

public function partager(){
	if(isset($_POST['partager'])){				
				$lienArt='';
				$libelleArt = $_POST['libelleArt'];
				$descArt = $_POST['descArt'];
				$idUti = $_SESSION['idUti'];
				$idGrp = $_POST['idGrp'];
				$i=0;
				$idTypArt = 7;
				//upload article
						$extension = strrchr($_FILES['article']['name'], '.'); 
						$dossier = '../../banque de donnees/article/';
						$fichier = basename($_FILES['article']['name']);
						$chaine= date('YmdHis');						
						$extensions = array('.doc', '.docx', '.jpg', '.jpeg', '.png', '.pdf', '.mp4', 'mp3');
						$extension = strrchr($_FILES['article']['name'], '.'); 
						// Début des vérifications de sécurité...
						if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
						{
							 $erreur = 'Vous devez uploader un fichier de type doc, docx,pdf, png, jpg, jpeg...';
						}
						if($i==0)$erreur = 'Désolé, le type de fichier sélectionner ne pas être ajout dans la bibliothèque...';
						 
						//Début des vérifications de sécurité...
								$taille_maxi = 500000000;
								$taille = filesize($_FILES['article']['tmp_name']);
								if($taille>$taille_maxi)
								{
									 $erreur = 'Le fichier est trop gros...';
								}
								if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
								{
									 if(move_uploaded_file($_FILES['article']['tmp_name'], $dossier.$_SESSION['pseudo'].$chaine.$extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
									 {
										  
										$lienArt =$_SESSION['pseudo'].$chaine.$extension;
										$resultat = mysql_query("INSERT INTO article (libelleArt, lienArt, descArt, idTypArt, idUti, idGrp) VALUES('$libelleArt', '$lienArt', '$descArt', '$idTypArt', '$idUti', '$idGrp')") or die(mysql_error());
				if($resultat){
				 echo'<script>alert("Document partager!!!");grpRedir('.$idGrp.')</script>';
				}

 									 }
									 else //Sinon (la fonction renvoie FALSE).
									 {
										  echo '<script>alert("Echec de l\'upload !")</script>';
									 }
								}
								else
								{
									 echo '<script>alert("'.$erreur.'");</script>';
								}
		//fin upload article
}
}

}//fin classe groupe
?>
