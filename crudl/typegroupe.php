<?php
class typeGroupe{
	public function liste(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des types de groupes</caption>
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
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM type_groupe_sys');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de type d'groupes est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>";
					$req = mysql_query('SELECT * FROM type_groupe_sys');
					while($affich = mysql_fetch_array($req)){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idTypGrp'].")'>".$affich['idTypGrp']."</th>
							<th onclick='ouvrirEnrg(".$affich['idTypGrp'].")'>".$affich['libelleTypGrp'].
							"</th><th onclick='ouvrirEnrg(".$affich['idTypGrp'].")' class='text-muted'>".$affich['descTypGrp']."</th>
							<th><button onclick='btnModif(".$affich['idTypGrp'].")' class='btn btn-warning'>Modifier</button>
</th>
							<th><button onclick='btnSupp(".$affich['idTypGrp'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";

	}
	public function ajouter(){
		if(isset($_POST['libelleTypGrp'])){
				//$idTypGrp = $_POST['idTypGrp'];
				$libelleTypGrp = $_POST['libelleTypGrp'];
				$descTypGrp = $_POST['descTypGrp'];
				$resultat = mysql_query("INSERT INTO type_groupe_sys (libelleTypGrp, descTypGrp) VALUES('$libelleTypGrp', '$descTypGrp')") or die(mysql_error);
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}
			}//else echo"Veuillez saisir tous les champs";
	}
	public function modifier(){
		if(isset($_POST['enregistrer'])){
			$idTypGrp = $_POST['idTypGrp'];
			$libelleTypGrp = $_POST['libelleTypGrp'];
			$descTypGrp = $_POST['descTypGrp'];
			$resultat = mysql_query("UPDATE type_groupe_sys SET libelleTypGrp = '$libelleTypGrp', descTypGrp = '$descTypGrp' WHERE idTypGrp = ".$idTypGrp) or die( mysql_error());
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
				$req = mysql_query('DELETE FROM type_groupe_sys WHERE idTypGrp='.$_GET['id']) or die(mysql_error());
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
			$req = mysql_query('SELECT * FROM type_groupe_sys where idTypGrp='.$_GET['id']);
			$affiche=mysql_fetch_array($req);
			if($affiche){
				 echo "<script type='text/javascript'>\n
 		var id= '".$_GET['id']."';\n
		</script>";
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur le type d'groupes:".$affiche['libelleTypGrp']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idTypGrp']."' type='text' name='idTypGrp' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libelleTypGrp']."' type='text' name='libelleTypGrp' /><br />
		<label>Description: </label><br /><textarea disabled class='form-control textareaFix'  name='descTypGrp'> ".$affiche['descTypGrp']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idTypGrp'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idTypGrp'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}
}//fin classe typegroupe
?>