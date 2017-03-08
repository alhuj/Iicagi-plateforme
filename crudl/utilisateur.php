<?php 
include ('fonction.php');
include ('sendMails.php');

class utilisateur{
		public function liste(){
			$req1 = mysql_query('SELECT COUNT(*) AS nbr FROM utilisateur');
			$affich1=mysql_fetch_array($req1);
		echo "<table class='table table-hover table-expansed table-radius'>
    <caption class='text-center'>Liste des utilisateurs</caption>
    <thead>
        <tr class='active'>
            <th>#</th>
            <th>Avatar</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Date de naissance</th>
            <th>Lieu de naissance</th>
            <th>Pseudo</th>
            <th class='btn-info'>Type</th>
            <th class='btn-success'>Privilege</th>
			<th>Bloquer</th>
            <th>Modifier</th>
            <th>Supprimer</th>
        </tr>
    </thead>
	 <tbody>
        
            ";		
					$req = mysql_query('SELECT * FROM utilisateur');
					while($affich = mysql_fetch_array($req)){
						$r1=mysql_query('select libelleType from type_utilisateur_sys where idType='.$affich['idType']);
						if($r1)$aff1=mysql_fetch_array($r1);
						$r2=mysql_query('select libellePrivi from privilege_sys where idPrivi='.$affich['idPrivi']);
						if($r2)$aff2=mysql_fetch_array($r2);
					  echo	'<tr>
					  		<th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['idUti'].'</th>
							<th onclick="ouvrirEnrg('.$affich['idUti'].')"><img src="http://localhost/plateforme/banque de donnees/utilisateur avatar/'.$affich['avatar'].'" style="display:block; height:80px; width:100px" class="img-responsive img-thumbnail" /></th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['nom'].
							'
							</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['prenom'].
							'</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['dateNaiss'].
							'</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['lieuNaiss'].
							'</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['pseudo'].
							'</th><th class="btn-info" onclick="ouvrirEnrg('.$affich['idUti'].')">'.$aff1['libelleType'].
							'</th><th class="btn-success" onclick="ouvrirEnrg('.$affich['idUti'].')">'.$aff2['libellePrivi'].'							
							</th>
							<th>';
							
							if($affich['bloquer']==0){
								echo'<button onclick="btnBloq('.$affich["idUti"].')" class="btn btn-primary">Bloquer</button>';
							}else echo'<button onclick="btnDebloq('.$affich["idUti"].')" class="btn btn-primary">Débloquer</button>';
							echo'</th>
							<th><button onclick="btnModif('.$affich["idUti"].')" class="btn btn-warning">Modifier</button></th>
							<th><button onclick="btnSupp('.$affich["idUti"].')" class="btn btn-danger">Supprimer</button></th>
							</tr>';

					}
				echo " </tbody>
	</table>";

	}

			public function afficher(){
				$req=mysql_query('select * from utilisateur where idUti='.$_GET['id']);
				while($affiche=mysql_fetch_array($req)){
						$req1=mysql_query('select * from filiere_sys where idFil='.$affiche['idFil']);
						$req2=mysql_query('select * from niveau_sys where idNiv='.$affiche['idNiv']);
						$req3=mysql_query('select * from privilege_sys where idPrivi='.$affiche['idPrivi']);
						$req4=mysql_query('select * from type_utilisateur_sys where idType='.$affiche['idType']);
						$affiche1=mysql_fetch_array($req1);
						$affiche2=mysql_fetch_array($req2);
						$affiche3=mysql_fetch_array($req3);
						$affiche4=mysql_fetch_array($req4);
				echo "
				<div align='center' class='form-group block1' >
		<h3>Informations complètes sur l'utilisateur:".$affiche['nom']." ".$affiche['prenom']." </h3>
							";
							if($affiche["bloquer"]==0){
								echo'<button onclick="btnBloq('.$affiche["idUti"].')" class="btn btn-primary">Bloquer</button>';
							}else echo'<button onclick="btnDebloq('.$affiche["idUti"].')" class="btn btn-primary">Débloquer</button>';
echo"
		<form class='form-inline'>  
		<label>Id: </label><br /><input disabled class='form-control' value='".$affiche['idUti']."' type='text' name='idUti' /><br />
		<label>Dernière connexion: </label><br /><input disabled class='form-control' value='".$affiche['dateDerConn']."' type='text' name='dateDerConn' /><br />
		<label>Avatar: <a href='indesirable avatar.php?id=".$affiche['idUti']."'>(Indésirable)</a></label><br /><img src='http://localhost/plateforme/banque de donnees/utilisateur avatar/".$affiche['avatar']."' style='display:block; height:100px; width:100px' class='img-responsive img-thumbnail' /><br />
		<label>Nom: </label><br /><input disabled class='form-control' value='".$affiche['nom']."' type='text' name='nom' /><br />
		<label>Prenom: </label><br /><input disabled class='form-control' value='".$affiche['prenom']."' type='text' name='prenom' /><br />
		<label>Date de naissance: </label><br /><input disabled class='form-control' value='".$affiche['dateNaiss']."' type='text' name='dateNaiss' /><br />
		<label>Lieu de naissance: </label><br /><input disabled class='form-control' value='".$affiche['lieuNaiss']."' type='text' name='lieuNaiss' /><br />
		<label>Adresse: </label><br /><input disabled class='form-control' value='".$affiche['adresse']."' type='text' name='adresse' /><br />
		<label>Téléphone: </label><br /><input disabled class='form-control' value='".$affiche['telephone']."' type='text' name='telephone' /><br />
		<label>Email: </label><br /><input disabled class='form-control' value='".$affiche['telephone']."' type='text' name='email' /><br />
		<label>Type d'utilisateur: </label><br /><input disabled class='form-control' value='".$affiche4['libelleType']."' type='text' name='typeUti' /><br />
		<label>Privilège: </label><br /><input disabled class='form-control' value='".$affiche3['libellePrivi']."' type='text' name='privilege' /><br />
		<label>Filière: </label><br /><input disabled class='form-control' value='".$affiche1['libelleFil']."' type='text' name='filiere' /><br />
		<label>Niveau: </label><br /><input disabled class='form-control' value='".$affiche2['libelleNiv']."' type='text' name='niveau' /><br />
		<label>Pseudo: <a href='indesirable pseudo.php?id=".$affiche["idUti"]."'>(Indésirable)</a></label><br /><input disabled class='form-control' value='".$affiche['pseudo']."' type='text' name='pseudo' /><br />
		<label>Mot de passe: <a href='mot de passe oublie.php?id=".$affiche['idUti']."'>(Mot de passe oublié)</a></label><br /><input disabled class='form-control' value='".$affiche['pass']."' type='text' name='pass' /><br />
		<label>Description: <a href='indesirable description.php?id=".$affiche['idUti']."'>(Indésirable)</a></label><br /><textarea disabled class='form-control textareaFix'  name='description'> ".$affiche['description']."</textarea><br /><br />
				</form>
		<button onclick='btnModif(".$affiche['idUti'].")' class='btn btn-warning'><h5>Modifier</h5></button>
		<button onclick='btnSupp(".$affiche['idUti'].")' class='btn btn-danger'><h5>Supprimer</h5></button>
</div>

";					}
			}
//*************************************************************************
//*************************************************************************
			public function ajouter(){
				if(isset($_POST['ajouter'])){
					$nom=$_POST['nom'];
					$prenom=$_POST['prenom'];
					$dateNaiss=$_POST['dateNaiss'];
					$lieuNaiss=$_POST['lieuNaiss'];
					$adresse=$_POST['adresse'];
					$telephone=$_POST['telephone'];
					$email=$_POST['email'];
					$idFil=$_POST['idFil'];
					$idNiv=$_POST['idNiv'];
					$idType=$_POST['idType'];
					$idPrivi=$_POST['idPrivi'];
					$avatar='defaultUser';
					$pass=genpass();
					$pseudo=genpseudo($nom);
					$req=mysql_query("INSERT INTO utilisateur (avatar, pseudo, pass, nom, prenom, dateNaiss, lieuNaiss, adresse, telephone, email, idFil, idNiv,idType,idPrivi) VALUES( 'defaultUser.jpg','$pseudo', '$pass', '$nom', '$prenom', '$dateNaiss', '$lieuNaiss', '$adresse', '$telephone', '$email', '$idFil', '$idNiv', '$idType', '$idPrivi')") or die(mysql_error());
					if($req){
						echo'<script>alert("Utilisateur ajouté avec succés.");indexRedir();</script>';
					}
				}
			}
//*************************************************************************
//*************************************************************************

			public function modifier(){
			if(isset($_POST['enregistrer'])){
			$id=$_POST['idUti'];
			$nom=$_POST['nom'];
			$prenom=$_POST['prenom'];
			$dateNaiss=$_POST['dateNaiss'];
			$lieuNaiss=$_POST['lieuNaiss'];
			$adresse=$_POST['adresse'];
			$telephone=$_POST['telephone'];
			$email=$_POST['email'];
			$idFil=$_POST['idFil'];
			$idNiv=$_POST['idNiv'];
			$idPrivi=$_POST['idPrivi'];
			$idType=$_POST['idType'];
			$req=mysql_query("UPDATE utilisateur SET nom='$nom', prenom='$prenom', dateNaiss='$dateNaiss', lieuNaiss='$lieuNaiss', adresse='$adresse', telephone='$telephone', email='$email', idFil='$idFil', idNiv='$idNiv', idPrivi='$idPrivi', idType='$idType' WHERE idUti=".$id) or die(mysql_error());
				if($req){
						echo '<script>alert("Utilisateur modifie avec succes");indexRedir();</script>'; 
						 }else echo'<script>alert("La modification a echouee.");</script>';
		}

			}
//*************************************************************************
//*************************************************************************
			public function supprimer(){
					if(isset($_GET['id'])){
						$req = mysql_query("DELETE FROM `utilisateur` WHERE `idUti` = ".$_GET['id']) or die(mysql_error());
					if($req){
						echo('<script>alert("La suppression à été effectuée avec succes.");document.location="index.php";</script>') ;
							}else	echo('<script>alert("La Suppression a échouee.");</script>') ;
							}
					}
//*************************************************************************
//*************************************************************************
	public function bloquer(){
		if(isset($_GET['id'])){
					$req=mysql_query("UPDATE utilisateur SET bloquer=1 WHERE idUti=".$_GET['id']);
					if($req){
						echo('<script>alert("L\'utilisateur à été bloqué avec succes.");indexRedir();</script>') ;
							}else	echo('<script>alert("l\'opération a echoué.");</script>') ;
		}
	}
	public function debloquer(){
		if(isset($_GET['id'])){
				$req=mysql_query("UPDATE utilisateur SET bloquer=0 WHERE idUti=".$_GET['id']);
				if($req){
					echo('<script>alert("L\'utilisateur à été débloqué avec succes.");indexRedir();</script>') ;
					}else	echo('<script>alert("l\'opération a echoué.");</script>') ;
		}
	}
	public function utiBloq(){
		$req=mysql_query('select * from utilisateur where bloquer=1');
		$rows=mysql_num_rows($req);
		if($rows!=0){
							
								echo "
				<table class='table table-hover table-expansed table-radius'>
				<caption class='text-center'>Liste des utilisateurs bloqués</caption>
				<thead>
					<tr class='active'>
						<th>#</th>
						<th>Nom</th>
						<th>Prenom</th>
						<th>Date de naissance</th>
						<th>Lieu de naissance</th>
						<th>Dernière connexion</th>
						<th>Pseudo</th>
						<th>Bloquer</th>
					</tr>
				</thead>
				 <tbody> ";	
								while($affich=mysql_fetch_array($req)){
										  echo	'<tr>
					  		<th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['idUti'].'</th>
							<th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['nom'].
							'</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['prenom'].
							'</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['dateNaiss'].
							'</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['lieuNaiss'].
							'</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['dateDerConn'].
							'</th><th onclick="ouvrirEnrg('.$affich['idUti'].')">'.$affich['pseudo'].
							'</th>
							<th><button onclick="btnDebloq('.$affich["idUti"].')" class="btn btn-primary">Débloquer</button>
							</th>
							</tr>
							';	
				}
				echo"</tbody>
							</table>";
				
				}else echo"<strong>Aucun utilisateur bloqué.</strong>";
	}
//---------------------------------------------------------------
public function indPseudo(){
	if(isset($_GET['id'])){
		$req=mysql_query('select * from utilisateur where idUti='.$_GET['id']) or die(mysql_error());
		$aff=mysql_fetch_array($req);	
		$nom=$aff['nom'];
		$email=$aff['email'];
		$pseudo=$aff['pseudo'];
		$pseudo=genPseudo($nom);
		$req=mysql_query('update utilisateur set pseudo="'.$pseudo.'" where idUti='.$_GET['id']) or die(mysql_error());
		if($req){
			
			mailPseudoIndesirable($pseudo,$email);
			echo'<script>alert("Pseudo par default rétabli et mail d\'avertissement envoyé!!!");indexRedir();</script>';
			} 
		}
}

public function indDesc(){
	if(isset($_GET['id'])){
		$req=mysql_query('select * from utilisateur where idUti='.$_GET['id']) or die(mysql_error());
		$aff=mysql_fetch_array($req);	
		$email=$aff['email'];
		$pseudo=$aff['pseudo'];
		$req=mysql_query('update utilisateur set description="" where id='.$_GET['id']);	
		if($req){
			mailDescIndesirable($email,$pseudo);
			echo'<script>alert("Description par default rétabli et mail d\'avertissement envoyé!!!");indexRedir();</script>';
		}
	}
}
public function indAvatar(){
	if(isset($_GET['id'])){
		$req=mysql_query('select * from utilisateur where idUti='.$_GET['id']) or die(mysql_error());
		$aff=mysql_fetch_array($req);	
		$email=$aff['email'];
		$pseudo=$aff['pseudo'];
		$req=mysql_query('update utilisateur set avatar="defaultUser.jpg" where idUti='.$_GET['id']);	
		if($req){
			mailAvatarIndesirable($email,$pseudo);
			echo'<script>alert("Avatar par default rétabli et mail d\'avertissement envoyé!!!");indexRedir();</script>';
		}else die('erreur');
	}
}
public function passOublie(){
	if(isset($_GET['id'])){
		$req=mysql_query('select * from utilisateur where idUti='.$_GET['id']) or die(mysql_error());
		if($aff=mysql_fetch_array($req)){
			$pseudo=$aff['pseudo'];
			$pass=$aff['pass'];
			$email=$aff['email'];
			mailPassOublie($pseudo,$pass,$email);
			echo'<script>alert("Mot de passe envoyer à l\'utilisateur par mail!");indexRedir();</script>';

		}else die('error');
	}
}
}//fermeture class utilisateur
?>