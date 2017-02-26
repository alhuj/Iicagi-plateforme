<?php
//*****************			
class privilege{
	public function liste(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des privilèges</caption>
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
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM privilege_sys');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de privilèges est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>
        
            ";
					$req = mysql_query('SELECT * FROM privilege_sys');
					while($affich = mysql_fetch_array($req)){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idPrivi'].")'>".$affich['idPrivi']."</th>
							<th onclick='ouvrirEnrg(".$affich['idPrivi'].")'>".$affich['libellePrivi'].
							"</th><th onclick='ouvrirEnrg(".$affich['idPrivi'].")' class='text-muted'>".$affich['descPrivi']."</th>
							<th><button onclick='btnModif(".$affich['idPrivi'].")' class='btn btn-warning'>Modifier</button>
</th>
							<th><button onclick='btnSupp(".$affich['idPrivi'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";

	}
	public function ajouter(){
		if(isset($_POST['libellePrivi'])){
				//$idPrivi = $_POST['idPrivi'];
				$libellePrivi = $_POST['libellePrivi'];
				$descPrivi = $_POST['descPrivi'];
				$resultat = mysql_query("INSERT INTO privilege_sys (libellePrivi, descPrivi) VALUES('$libellePrivi', '$descPrivi')") or die(mysql_error());
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}
			}//else echo"Veuillez saisir tous les champs";
	}
	public function modifier(){
		if(isset($_POST['enregistrer'])){
			$idPrivi = $_POST['idPrivi'];
			$libellePrivi = $_POST['libellePrivi'];
			$descPrivi = $_POST['descPrivi'];
			$resultat = mysql_query("UPDATE privilege_sys SET libellePrivi = '$libellePrivi', descPrivi = '$descPrivi' WHERE idPrivi = ".$idPrivi) or die( mysql_error());
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
				$req = mysql_query('DELETE FROM privilege_sys WHERE idPrivi='.$_GET['id']) or die(mysql_error());
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
			$req = mysql_query('SELECT * FROM privilege_sys where idPrivi='.$_GET['id']);
			$affiche=mysql_fetch_array($req);
			if($affiche){
				 echo "<script type='text/javascript'>\n
 		var id= '".$_GET['id']."';\n
		</script>";
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur la filière:".$affiche['libellePrivi']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idPrivi']."' type='text' name='idPrivi' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libellePrivi']."' type='text' name='libellePrivi' /><br />
		<label>Description: </label><br /><textarea disabled class='form-control textareaFix'  name='descPrivi'> ".$affiche['descPrivi']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idPrivi'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idPrivi'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}
}//fin classe privilege
?>
