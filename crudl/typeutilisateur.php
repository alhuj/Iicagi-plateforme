<?php
class typeUtilisateur{
	public function liste(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des types d'utilisateurs</caption>
    <thead>
        <tr class='active'>
            <th>#</th>
            <th>Libellé</th>
            <th class='text-muted'>Description</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
    <tfoot>
        <tr>";
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM type_utilisateur_sys');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de types d'utilisateurs est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>
        
            ";
					$req = mysql_query('SELECT * FROM type_utilisateur_sys');
					while($affich = mysql_fetch_array($req)){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idType'].")'>".$affich['idType']."</th>
							<th onclick='ouvrirEnrg(".$affich['idType'].")'>".$affich['libelleType'].
							"</th><th onclick='ouvrirEnrg(".$affich['idType'].")' class='text-muted'>".$affich['descType']."</th>
							<th><button onclick='btnModif(".$affich['idType'].")' class='btn btn-warning'>Modifier</button>
</th>
							<th><button onclick='btnSupp(".$affich['idType'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";

	}
	public function ajouter(){
		if(isset($_POST['libelleType'])){
				//$idType = $_POST['idType'];
				$libelleType = $_POST['libelleType'];
				$descType = $_POST['descType'];
				$resultat = mysql_query("INSERT INTO type_utilisateur_sys (libelleType, descType) VALUES('$libelleType', '$descType')") or die(mysql_error);
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}
			}//else echo"Veuillez saisir tous les champs";
	}
	public function modifier(){
		if(isset($_POST['enregistrer'])){
			$idType = $_POST['idType'];
			$libelleType = $_POST['libelleType'];
			$descType = $_POST['descType'];
			$resultat = mysql_query("UPDATE type_utilisateur_sys SET libelleType = '$libelleType', descType = '$descType' WHERE idType = ".$idType) or die( mysql_error());
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
				$req = mysql_query('DELETE FROM type_utilisateur_sys WHERE idType='.$_GET['id']) or die(mysql_error());
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
			$req = mysql_query('SELECT * FROM type_utilisateur_sys where idType='.$_GET['id']);
			$affiche=mysql_fetch_array($req);
			if($affiche){
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur le type d'utilisateurs:".$affiche['libelleType']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idType']."' type='text' name='idType' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libelleType']."' type='text' name='libelleType' /><br />
		<label>Description: </label><br /><textarea disabled class='form-control textareaFix'  name='descType'> ".$affiche['descType']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idType'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idType'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}
}//fin classe typeUtilisateur
?>