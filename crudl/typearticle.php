<?php
class typeArticle{
	public function liste(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des types de articles</caption>
    <thead>
        <tr class='active'>
            <th>#</th>
            <th>Libellé</th>
            <th>Extension</th>
            <th class='text-muted'>Description</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tfoot>
        <tr>";
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM type_article_sys');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de type d'articles est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>";
					$req = mysql_query('SELECT * FROM type_article_sys');
					while($affich = mysql_fetch_array($req)){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idTypArt'].")'>".$affich['idTypArt']."</th>
							<th onclick='ouvrirEnrg(".$affich['idTypArt'].")'>".$affich['libelleTypArt'].
							"<th onclick='ouvrirEnrg(".$affich['idTypArt'].")'>".$affich['extensionTypArt'].
							"</th><th onclick='ouvrirEnrg(".$affich['idTypArt'].")' class='text-muted'>".$affich['descTypArt']."</th>
							<th><button onclick='btnModif(".$affich['idTypArt'].")' class='btn btn-warning'>Modifier</button>
</th>
							<th><button onclick='btnSupp(".$affich['idTypArt'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";

	}
	public function ajouter(){
		if(isset($_POST['libelleTypArt'])){
				//$idTypArt = $_POST['idTypArt'];
				$libelleTypArt = $_POST['libelleTypArt'];
				$extensionTypArt = $_POST['extensionTypArt'];
				$descTypArt = $_POST['descTypArt'];
				$resultat = mysql_query("INSERT INTO type_article_sys (libelleTypArt, extensionTypArt, descTypArt) VALUES('$libelleTypArt', '$extensionTypArt','$descTypArt' )") or die(mysql_error);
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}
			}//else echo"Veuillez saisir tous les champs";
	}
	public function modifier(){
		if(isset($_POST['enregistrer'])){
			$idTypArt = $_POST['idTypArt'];
			$libelleTypArt = $_POST['libelleTypArt'];
			$extensionTypArt = $_POST['extensionTypArt'];
			$descTypArt = $_POST['descTypArt'];
			$resultat = mysql_query("UPDATE type_article_sys SET libelleTypArt = '$libelleTypArt', extensionTypArt = '$extensionTypArt', descTypArt = '$descTypArt' WHERE idTypArt = ".$idTypArt) or die( mysql_error());
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
				$req = mysql_query('DELETE FROM type_article_sys WHERE idTypArt='.$_GET['id']) or die(mysql_error());
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
			$req = mysql_query('SELECT * FROM type_article_sys where idTypArt='.$_GET['id']);
			$affiche=mysql_fetch_array($req);
			if($affiche){
				 echo "<script type='text/javascript'>\n
 		var id= '".$_GET['id']."';\n
		</script>";
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur le type d'articles:".$affiche['libelleTypArt']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idTypArt']."' type='text' name='idTypArt' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libelleTypArt']."' type='text' name='libelleTypArt' /><br />
		<label>Extension: </label><br /><input disabled class='form-control' value='".$affiche['extensionTypArt']."' type='text' name='extensionTypArt' /><br />
		<label>Description: </label><br /><textarea disabled class='form-control textareaFix'  name='descTypArt'> ".$affiche['descTypArt']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idTypArt'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idTypArt'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}
}//fin classe typearticle
?>