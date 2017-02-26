<?php
//*****************			
class groupe{
	public function liste(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des groupes</caption>
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
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM groupe');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Le nombre de groupes est de: ".$aff['nbr']."</td>
        </tr>
    </tfoot>
	 <tbody>
        
            ";
					$req = mysql_query('SELECT * FROM groupe');
					if($rows=mysql_num_rows($req)!=0){
					while($affich = mysql_fetch_array($req)){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idGrp'].")'>".$affich['idGrp']."</th>
							<th onclick='ouvrirEnrg(".$affich['idGrp'].")'>".$affich['libelleGrp'].
							"</th><th onclick='ouvrirEnrg(".$affich['idGrp'].")' class='text-muted'>".$affich['descGrp']."</th>
							<th><button onclick='btnModif(".$affich['idGrp'].")' class='btn btn-warning'>Modifier</button></th>
							<th><button onclick='btnSupp(".$affich['idGrp'].")' class='btn btn-danger'>Supprimer</button></th>
							</tr>";

					}
											echo " </tbody>
										</table>";
					}else echo"<strong>Aucun groupe créé.</strong>";
	}
	public function ajouter(){
		if(isset($_POST['libelleGrp'])){
				//$idGrp = $_POST['idGrp'];
				$libelleGrp = $_POST['libelleGrp'];
				$descGrp = $_POST['descGrp'];
				$idTypGrp = $_POST['idTypGrp'];
				$resultat = mysql_query("INSERT INTO groupe (libelleGrp, descGrp, idTypGrp) VALUES('$libelleGrp', '$descGrp', '$idTypGrp')") or die(mysql_error());
				if($resultat){
				 echo'<script>alert("Ajout reussi!!!");indexRedir()</script>';
				}
			}//else echo"Veuillez saisir tous les champs";
	}
	public function modifier(){
		if(isset($_POST['enregistrer'])){
			$idGrp = $_POST['idGrp'];
			$libelleGrp = $_POST['libelleGrp'];
			$descGrp = $_POST['descGrp'];
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
				$req = mysql_query('DELETE FROM groupe WHERE idGrp='.$_GET['id']) or die(mysql_error());
				if($req)
				{
				echo("<script>alert('La suppression à été effectuée avec succes.');indexRedir();</script>") ;
				}
				else
				{
					echo("<script>alert('La Suppression a échouee.');</script>") ;
				}
			}else echo'probleme isset';
	}
	
	public function affiche(){
			$req = mysql_query('SELECT * FROM groupe where idGrp='.$_GET['id']);
			$affiche=mysql_fetch_array($req);
			if($affiche){
				 echo "<script type='text/javascript'>\n
 		var id= '".$_GET['id']."';\n
		</script>";
			echo"<div align='center' class='form-group block1' >
		<h3>Informations complètes sur le groupe:".$affiche['libelleGrp']."</h3>
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idGrp']."' type='text' name='idGrp' /><br />
		<label>Libelle: </label><br /><input disabled class='form-control' value='".$affiche['libelleGrp']."' type='text' name='libelleGrp' /><br />
		<label>Description: <a href=''>(Indésirable)</a></label><br /><textarea disabled class='form-control textareaFix'  name='descGrp'> ".$affiche['descGrp']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idGrp'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idGrp'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>
";}
			
	}
		public function listeMesGrp(){
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste de mes groupes</caption>
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
			$re = mysql_query('SELECT COUNT(*) AS nbr FROM groupe');
			$aff = mysql_fetch_array($re);
		echo"
            <td class='text-center active' colspan='5'>Vous appartenez à ".$aff['nbr']." groupe(s).</td>
        </tr>
    </tfoot>
	 <tbody>
        
            ";
					$req1 = mysql_query('SELECT * FROM utilisateur_groupe where idUti='.$id1);
					while($affiche1=mysql_fetch_array($req1)){
					$req2 = mysql_query('SELECT * FROM groupe where idGrp='.$affiche1['idGrp']);
					$affich=mysql_fetch_array($req2);
					if($rows=mysql_num_rows($req)!=0){
					  echo	"<tr>
					  		<th onclick='ouvrirEnrg(".$affich['idGrp'].")'>".$affich['avatarGrp']."</th>
							<th onclick='ouvrirEnrg(".$affich['idGrp'].")'>".$affich['libelleGrp'].
							"</th><th onclick='ouvrirEnrg(".$affich['idGrp'].")' class='text-muted'>".$affich['descGrp']."</th>
							<th><button onclick='btnQuitGrp(".$affich['idGrp'].")' class='btn btn-danger'>Quitter</button></th>
							</tr>";

					}else echo"<strong>Vous n'avez pas de groupe.</strong>";
											echo " </tbody>
										</table>";
					}
	}
	public function quitter(){
		
	$req=mysql_query("delete from utilisateur_groupe where idUti=".$id." and idGrp=".$_GET['idGrp']) or die(mysql_error());
		
	}
}//fin classe groupe
?>
