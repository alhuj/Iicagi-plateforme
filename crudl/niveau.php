<?php
//*****************			
class niveau{
	public function liste(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des niveaux</caption>
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
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM niveau_sys');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de niveaux est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>
        
            ";
					$req = mysql_query('SELECT * FROM niveau_sys');
					while($affich = mysql_fetch_array($req)){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idNiv'].")'>".$affich['idNiv']."</th>
							<th onclick='ouvrirEnrg(".$affich['idNiv'].")'>".$affich['libelleNiv'].
							"</th><th onclick='ouvrirEnrg(".$affich['idNiv'].")' class='text-muted'>".$affich['descNiv']."</th>
							<th><button onclick='btnModif(".$affich['idNiv'].")' class='btn btn-warning'>Modifier</button>
</th>
							<th><button onclick='btnSupp(".$affich['idNiv'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";

	}
	public function ajouter(){
		if(isset($_POST['libelleNiv'])){
				//$idNiv = $_POST['idNiv'];
				$libelleNiv = $_POST['libelleNiv'];
				$descNiv = $_POST['descNiv'];
				$resultat = mysql_query("INSERT INTO niveau_sys (libelleNiv, descNiv) VALUES('$libelleNiv', '$descNiv')") or die(mysql_error);
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}
			}//else echo"Veuillez saisir tous les champs";
	}
	public function modifier(){
		if(isset($_POST['enregistrer'])){
			$idNiv = $_POST['idNiv'];
			$libelleNiv = $_POST['libelleNiv'];
			$descNiv = $_POST['descNiv'];
			$resultat = mysql_query("UPDATE niveau_sys SET libelleNiv = '$libelleNiv', descNiv = '$descNiv' WHERE idNiv = ".$idNiv) or die( mysql_error());
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
				$req = mysql_query('DELETE FROM niveau_sys WHERE idNiv='.$_GET['id']) or die(mysql_error());
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
			$req = mysql_query('SELECT * FROM niveau_sys where idNiv='.$_GET['id']);
			$affiche=mysql_fetch_array($req);
			if($affiche){
				 echo "<script type='text/javascript'>\n
 		var id= '".$_GET['id']."';\n
		</script>";
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur le niveau:".$affiche['libelleNiv']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idNiv']."' type='text' name='idNiv' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libelleNiv']."' type='text' name='libelleNiv' /><br />
		<label>Description: </label><br /><textarea disabled class='form-control textareaFix'  name='descNiv'> ".$affiche['descNiv']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idNiv'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idNiv'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}
}//fin classe niveau
?>
