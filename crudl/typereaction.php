<?php
class typeReaction{
	public function liste(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des types de réactions</caption>
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
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM type_reaction_sys');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de types de reactions est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>
        
            ";
					$req = mysql_query('SELECT * FROM type_reaction_sys');
					while($affich = mysql_fetch_array($req)){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idTypReact'].")'>".$affich['idTypReact']."</th>
							<th onclick='ouvrirEnrg(".$affich['idTypReact'].")'>".$affich['libelleTypReact'].
							"</th><th onclick='ouvrirEnrg(".$affich['idTypReact'].")' class='text-muted'>".$affich['descTypReact']."</th>
							<th><button onclick='btnModif(".$affich['idTypReact'].")' class='btn btn-warning'>Modifier</button>
</th>
							<th><button onclick='btnSupp(".$affich['idTypReact'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";

	}
	public function ajouter(){
		if(isset($_POST['libelleTypReact'])){
				//$idTypReact = $_POST['idTypReact'];
				$libelleTypReact = $_POST['libelleTypReact'];
				$descTypReact = $_POST['descTypReact'];
				$resultat = mysql_query("INSERT INTO type_reaction_sys (libelleTypReact, descTypReact) VALUES('$libelleTypReact', '$descTypReact')") or die(mysql_error);
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}
			}//else echo"Veuillez saisir tous les champs";
	}
	public function modifier(){
		if(isset($_POST['enregistrer'])){
			$idTypReact = $_POST['idTypReact'];
			$libelleTypReact = $_POST['libelleTypReact'];
			$descTypReact = $_POST['descTypReact'];
			$resultat = mysql_query("UPDATE type_reaction_sys SET libelleTypReact = '$libelleTypReact', descTypReact = '$descTypReact' WHERE idTypReact = ".$idTypReact) or die( mysql_error());
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
				$req = mysql_query('DELETE FROM type_reaction_sys WHERE idTypReact='.$_GET['id']) or die(mysql_error());
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
			$req = mysql_query('SELECT * FROM type_reaction_sys where idTypReact='.$_GET['id']);
			$affiche=mysql_fetch_array($req);
			if($affiche){
				 echo "<script type='text/javascript'>\n
 		var id= '".$_GET['id']."';\n
		</script>";
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur le type d'reactions:".$affiche['libelleTypReact']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idTypReact']."' type='text' name='idTypReact' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libelleTypReact']."' type='text' name='libelleTypReact' /><br />
		<label>Description: </label><br /><textarea disabled class='form-control textareaFix'  name='descTypReact'> ".$affiche['descTypReact']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idTypReact'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idTypReact'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}
}//fin classe typereaction
?>