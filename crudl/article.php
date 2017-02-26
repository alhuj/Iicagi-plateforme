<?php
class article{
	public function liste(){
			echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des articles</caption>
    <thead>
        <tr class='active'>
            <th>#</th>
            <th>Libellé</th>
            <th class='text-muted'>Description</th>
            <th>Type</th>
            <th>Publicateur</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tfoot>
        <tr>";
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM article');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de articles est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>
        
            ";
					$req = mysql_query('SELECT * FROM article');
					if($rows=mysql_num_rows($req)!=0){
					while($affich = mysql_fetch_array($req)){
						$r1=mysql_query('select * from type_article_sys where idTypArt='.$affich['idTypArt']) or die(mysql_error());
						$r2=mysql_query('select * from utilisateur where idUti='.$affich['idUti']) or die(mysql_error());
						$a1=mysql_fetch_array($r1);
						$a2=mysql_fetch_array($r2);
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idArt'].")'>".$affich['idArt']."</th>
							<th onclick='ouvrirEnrg(".$affich['idArt'].")'>".$affich['libelleArt'].
							"</th><th onclick='ouvrirEnrg(".$affich['idArt'].")' class='text-muted'>".$affich['descArt']."</th>
							<th onclick='ouvrirEnrg(".$affich['idArt'].")'>".$a1['libelleTypArt'].
							"</th><th onclick='ouvrirEnrg(".$affich['idArt'].")'>".$a2['pseudo'].
							"</th><th><button onclick='btnModif(".$affich['idArt'].")' class='btn btn-warning'>Modifier</button>
</th>
							<th><button onclick='btnSupp(".$affich['idArt'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";
					}else echo"<strong>Aucun article ajouté.</strong>";

	}
	public function ajouterYoutube(){
		if(isset($_POST['ajouter'])){
			if(isset($_POST['libelleArt']) && isset($_POST['lienArt'])){
				$lienArt=$_POST['lienArt'];
				$libelleArt = $_POST['libelleArt'];
				$descArt = $_POST['descArt'];
				$idUti = $_SESSION['idUti'];
				$idTypArt =6;
				$resultat = mysql_query("INSERT INTO article (libelleArt, lienArt, descArt, idTypArt, idUti) VALUES('$libelleArt', '$lienArt', '$descArt', '$idTypArt', '$idUti')") or die(mysql_error());
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}else echo'<script>alert("probleme requete!!!");indexRedir()</script>';
				}else echo '<script>alert("Les champs titre et lien sont obligatoires à l\'ajout de l\'article.");</script>';

			}//else echo"Veuillez saisir tous les champs";
	}
	public function ajouterUpl(){
			if(isset($_FILES['article']) ){
				$lienArt='';
				$libelleArt = $_POST['libelleArt'];
				$descArt = $_POST['descArt'];
				$idUti = $_SESSION['idUti'];
				$i=0;
				$idTypArt = 0;
				//upload article
						$extension = strrchr($_FILES['article']['name'], '.'); 
						$dossier = '../../banque de donnees/article/';
						$fichier = basename($_FILES['article']['name']);
						$chaine= date('YmdHis');
						$r=mysql_query('select idTypArt, extensionTypArt from type_article_sys') or die(mysql_error());
						while ($a=mysql_fetch_array($r)) // pour chaque ligne résultat
						{
							$ext='.'.$a['extensionTypArt'];
							if($extension== $ext) //Si l'extension n'est pas dans le tableau
							{
								 $i=1;
								 $idTypArt=$a['idTypArt'];
							}
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
										$resultat = mysql_query("INSERT INTO article (libelleArt, lienArt, descArt, idTypArt, idUti) VALUES('$libelleArt', '$lienArt', '$descArt', '$idTypArt', '$idUti')") or die(mysql_error());
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
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
	public function modifierYoutube(){
		if(isset($_POST['enregistrer'])){
				$idArt = $_POST['idArt'];
				$lienArt=$_POST['lienArt'];
				$libelleArt = $_POST['libelleArt'];
				$descArt = $_POST['descArt'];
				$idUti=$_SESSION['idUti'];
				$idTypArt = $_POST['idTypArt'];
						$resultat = mysql_query("UPDATE article SET libelleArt = '$libelleArt',lienArt = '$lienArt', descArt = '$descArt', idTypArt = '$idTypArt' , idUti ='$idUti' WHERE idArt = ".$idArt) or die(mysql_error());
						if($resultat){
						 echo'<script>alert("Modification reussie!!!");indexRedir()</script>';
						}
					}
				}
	public function modifierUpl(){
				if(isset($_FILES['article'])){
				$idUti=$_SESSION['idUti'];
				$idArt = $_POST['idArt'];
				$lienArt=$_POST['lienArt'];
				$libelleArt = $_POST['libelleArt'];
				$descArt = $_POST['descArt'];
				$i=0;
				$idTypArt = $_POST['idTypArt'];
						$extension = strrchr($_FILES['article']['name'], '.'); 
						$dossier = '../../banque de donnees/article/';
						$fichier = basename($_FILES['article']['name']);
						$r=mysql_query('select idTypArt, extensionTypArt from type_article_sys') or die(mysql_error());
						while ($a=mysql_fetch_array($r)) // pour chaque ligne résultat
						{
							$ext='.'.$a['extensionTypArt'];
							if($extension== $ext) //Si l'extension n'est pas dans le tableau
							{
								 $i=1;
								 $idTypArt=$a['idTypArt'];
							}
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
									 if(move_uploaded_file($_FILES['article']['tmp_name'], $dossier.$_SESSION['pseudo'].$idArt.$extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
									 {
										  
										$lienArt =$_SESSION['pseudo'].$idArt.$extension;
										$resultat = mysql_query("UPDATE article SET libelleArt = '$libelleArt',lienArt = '$lienArt', descArt = '$descArt', idTypArt = '$idTypArt', idUti='$idUti' WHERE idArt = ".$idArt) or die(mysql_error());
				if($resultat){
				 echo'<script>alert("Modification reussie!!!");indexRedir()</script>';
				}

 									 }
									 else //Sinon (la fonction renvoie FALSE).
									 {
										  echo 'Echec de l\'upload !';
									 }
								}
								else
								{
									 echo '<script>alert("'.$erreur.'")</script>';
								}
			}	elseif(isset($_POST['enregistrer'])) {
				$idArt = $_POST['idArt'];
				$lienArt=$_POST['lienArt'];
				$libelleArt = $_POST['libelleArt'];
				$descArt = $_POST['descArt'];
				$idUti=$_SESSION['idUti'];
				$idTypArt = $_POST['idTypArt'];
				$resultat = mysql_query("UPDATE article SET libelleArt = '$libelleArt',lienArt = '$lienArt', descArt = '$descArt', idTypArt = '$idTypArt' , idUti ='$idUti' WHERE idArt = ".$idArt) or die(mysql_error());
						if($resultat){
						 echo'<script>alert("Modification reussie!!!");indexRedir()</script>';
						}
					}
	}
	public function supprimer(){
			if(isset($_GET['id'])){
				$req = mysql_query('DELETE FROM article WHERE idArt='.$_GET['id']) or die(mysql_error());
				if($req)
				{
				echo("<script>alert('La suppression à été effectuée avec succes.');document.location='index.php';</script>") ;
				}
				else
				{
					echo("<script>alert('La Suppression a échouee.');</script>") ;
				}
			}else echo'probleme isset';
	}
		public function affiche(){
			$req = mysql_query('SELECT * FROM article where idArt='.$_GET['id']);
			$affiche=mysql_fetch_array($req);
			if($affiche){
						$r1=mysql_query('select * from type_article_sys where idTypArt='.$affiche['idTypArt']) or die(mysql_error());
						$r2=mysql_query('select * from utilisateur where idUti='.$affiche['idUti']) or die(mysql_error());
						$a1=mysql_fetch_array($r1);
						$a2=mysql_fetch_array($r2);
				 echo "<script type='text/javascript'>\n
 		var id= '".$_GET['id']."';\n
		</script>";
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur l'article:".$affiche['libelleArt']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idArt']."' type='text' name='idArt' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libelleArt']."' type='text' name='libelleArt' /><br />
		<label>Nom fichier: </label><br /><input disabled class='form-control' value='".$affiche['lienArt']."' type='text' name='libelleArt' /><br />
		<label>Date de publication: </label><br /><input disabled class='form-control' value='".$affiche['datePub']."' type='text' name='libelleArt' /><br />
		<label>Type d'article: </label><br /><input disabled class='form-control' value='".$a1['libelleTypArt']."' type='text' name='libelleArt' /><br />
		<label>Plublicateur: </label><br /><input disabled class='form-control' value='".$a2['pseudo']."' type='text' name='libelleArt' /><br />
		<label>Description: </label><br /><textarea disabled class='form-control textareaFix'  name='descArt'> ".$affiche['descArt']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idArt'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idArt'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}


}
?>