<?php

//*****************			
class filiere{
	public function liste(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des filières</caption>
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
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM filiere_sys');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de filières est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>
        
            ";
					$req = mysql_query('SELECT * FROM filiere_sys');
					while($affich = mysql_fetch_array($req)){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idFil'].")'>".$affich['idFil']."</th>
							<th onclick='ouvrirEnrg(".$affich['idFil'].")'>".$affich['libelleFil'].
							"</th><th onclick='ouvrirEnrg(".$affich['idFil'].")' class='text-muted'>".$affich['descFil']."</th>
							<th><button onclick='btnModif(".$affich['idFil'].")' class='btn btn-warning'>Modifier</button>
</th>
							<th><button onclick='btnSupp(".$affich['idFil'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";

	}
	public function ajouter(){
		if(isset($_POST['libelleFil'])){
				//$idFil = $_POST['idFil'];
				$libelleFil = $_POST['libelleFil'];
				$descFil = $_POST['descFil'];
				$resultat = mysql_query("INSERT INTO filiere_sys (libelleFil, descFil) VALUES('$libelleFil', '$descFil')") or die(mysql_error());
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}
			}//else echo"Veuillez saisir tous les champs";
	}
	public function modifier(){
		if(isset($_POST['enregistrer'])){
			$idFil = $_POST['idFil'];
			$libelleFil = $_POST['libelleFil'];
			$descFil = $_POST['descFil'];
			$resultat = mysql_query("UPDATE filiere_sys SET libelleFil = '$libelleFil', descFil = '$descFil' WHERE idFil = ".$idFil) or die( mysql_error());
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
				$req = mysql_query('DELETE FROM filiere_sys WHERE idFil='.$_GET['id']) or die(mysql_error());
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
			$req = mysql_query('SELECT * FROM filiere_sys where idFil='.$_GET['id'])or die(mysql_error());
			$affiche=mysql_fetch_array($req);
			if($affiche){
				 echo "<script type='text/javascript'>\n
 		var id= '".$_GET['id']."';\n
		</script>";
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur la filière:".$affiche['libelleFil']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idFil']."' type='text' name='idFil' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libelleFil']."' type='text' name='libelleFil' /><br />
		<label>Description: </label><br /><textarea disabled class='form-control textareaFix'  name='descFil'> ".$affiche['descFil']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idFil'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idFil'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}
}//fin classe filiere
?>
