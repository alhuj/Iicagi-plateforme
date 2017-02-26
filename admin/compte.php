<?php
include'../config.php';
include'includes/debut.php';
include'includes/menu.php';
$req=mysql_query('select * from utilisateur where idUti='.$id1);
$aff=mysql_fetch_array($req);
?>
<section>
    <section class="col-md-6">
        <h3>Mes Infos:</h3>
            <div >
                <span>
                    Nom:
                </span>
                <span>
                    <?php echo $aff['nom'] ?>
                </span>
            </div>
            <div>
                <span>
                    Prénom:
                </span>
                <span>
                   <?php echo $aff['prenom'] ?>
                </span>
            </div>
            <div>
                <span>
                    Date de Naissance:
                </span>
                <span>
                   <?php echo $aff['dateNaiss'] ?>
                </span>
            </div>
            <div>
                <span>
                    Lieu de naissance:
                </span>
                <span>
                   <?php echo $aff['lieuNaiss'] ?>
                </span>
            </div>
            <div>
                <span>
                    Adresse:
                </span>
                <span>
                   <?php echo $aff['adresse'] ?>
                </span>
            </div>
            <div>
                <span>
                    Téléphone:
                </span>
                <span>
                   <?php echo $aff['telephone'] ?>
                </span>
            </div>
            <div>
                <span>
                    Type d'utilisateur:
                </span>
                <span>
                   <?php 
				   		$r=mysql_query('select libelleType from type_utilisateur_sys where idType='.$aff['idType']) or die(mysql_error());
						$aff1=mysql_fetch_array($r);
						echo $aff1['libelleType'];
					?>
                </span>
            </div>
            <div>
                <span>
                    Privilège:
                </span>
                <span>
                   <?php 
				   		$re=mysql_query('select libellePrivi from privilege_sys where idPrivi='.$aff['idPrivi']) or die(mysql_error());
						$aff2=mysql_fetch_array($re);
						echo $aff2['libellePrivi'];
					?>
                </span>
            </div>
            <div>
                <span>
                    Filière:
                </span>
                <span>
                   <?php 
				   		$requ=mysql_query('select libelleFil from filiere_sys where idFil='.$aff['idFil']) or die(mysql_error());
						$aff3=mysql_fetch_array($requ);
						echo $aff3['libelleFil'];
					?>
                </span>
            </div>
            <div>
                <span>
                    Niveau:
                </span>
                <span>
                   <?php 
				   		$reque=mysql_query('select libelleNiv from niveau_sys where idNiv='.$aff['idNiv']) or die(mysql_error());
						$aff4=mysql_fetch_array($reque);
						echo $aff4['libelleNiv'];
					?>
                </span>
            </div>
    </section>
	<section class="col-md-6">
        <h3>Profile:</h3>
        <h5>Dernier connection le <?php echo $aff['dateDerConn'] ?></h5>
            <div>
                <div >
                    <span>
                        Avatar
                    </span>
                    <span>
                        <img src="../banque de donnees/utilisateur avatar/<?php echo $aff['avatar'] ?>" style="display:block; height:100px; width:100px" class="img-responsive img-thumbnail" />
					<form action="compte.php" method="post"  enctype="multipart/form-data">
                        Changer d'avatar: <input type="file" name="avatar"/>  <input type="submit" name="uplAvt" value="Valider"/>
                        </form>
                    </span>
                </div>
                    <br />
                    <span>
                        Pseudo:
                    </span>
                    <span>
                    <form action="compte.php" method="post"  enctype="multipart/form-data">
                        <input type="text" name="pseudo" value="<?php echo $aff['pseudo'] ?>" /><input type="submit" name="changePseudo" value="Valider"/>
                       </form>
                    </span>
                    
            </div>
	</section>
    <section class="col-md-6">
        <h3>Mes Groupes</h3>
                   <?php 
				  		$reqGrp1=mysql_query('select idGrp from utilisateur_groupe where idUti='.$id1);
						$rows=mysql_num_rows($reqGrp1);
						if($rows){
							while($affGrp1=mysql_fetch_array($reqGrp1)){
							$reqGrp=mysql_query('select libelleGrp from groupe where idGrp='.$affGrp1['idGrp']) or die(mysql_error());
							$affGrp=mysql_fetch_array($reqGrp);
							echo $affGrp['libelleGrp'];
							}
						}else echo 'Aucun groupe';
					?>
        <h3>Mes Sujets de discussion</h3>
                   <?php 
				   		$reqQu=mysql_query('select * from question where idUti='.$id1) or die(mysql_error());
						$rows=mysql_num_rows($reqQu);
						if($rows){
							while($affQu=mysql_fetch_array($reqQu)){
							echo $affQu['sujet'].' / ';
							}
						} else echo 'Vous avez posté aucun sujet de discussion.';
					?>
        <h3>Mes articles</h3>
                   <?php 
				   		$reqArt=mysql_query('select * from article where idUti='.$id1) or die(mysql_error());
						$rows=mysql_num_rows($reqArt);
						if($rows){
							while($affArt=mysql_fetch_array($reqArt)){
							echo $affArt['libelleArt'].' / ';
							}
						} else echo 'Vous avez publié aucun article dans la bibliothèque.';
					?>
    </section>
    <section class="col-md-6">
        <h3>Changer de mot de passe:</h3>
        	<div>
					<form action="compte.php" method="post"  enctype="multipart/form-data">
                <span>
                    Nouveau mot de passe: <input type="password" name="nvpass"/>
                </span><br />
                <span>
                    Répéter mot de passe:  <input type="password" name="renvpass"/>
                </span><br /><input type="submit" name="chgmp" value="Valider"/>
                       </form>
			</div>        
    </section>
</section>

<?php
include'includes/fin.php';
//Upload avatar***************************************
	if(isset($_POST['uplAvt'])){
		$dossier = '../banque de donnees/utilisateur avatar/';
		$fichier = basename($_FILES['avatar']['name']);
		$taille_maxi = 1000000;
		$taille = filesize($_FILES['avatar']['tmp_name']);
		$extensions = array('.png', '.gif', '.jpg', '.jpeg');
		$extension = strrchr($_FILES['avatar']['name'], '.'); 
		//Début des vérifications de sécurité...
		if(!in_array($extension, $extensions)) //Si l'extension n'est pas dans le tableau
		{
			 $erreur = 'Vous devez uploader un fichier de type png, gif, jpg, jpeg...';
		}
		if($taille>$taille_maxi)
		{
			 $erreur = 'Le fichier est trop gros...';
		}
		if(!isset($erreur)) //S'il n'y a pas d'erreur, on upload
		{
			 if(move_uploaded_file($_FILES['avatar']['tmp_name'], $dossier.$pseudo.$extension)) //Si la fonction renvoie TRUE, c'est que ça a fonctionné...
			 {
				  
				  $req=mysql_query('update utilisateur set avatar="'.$pseudo.$extension.'" where idUti='.$id1) or die(mysql_error());
				  if($req){
					  echo 'Upload effectué avec succès !';
				  }
			 }
			 else //Sinon (la fonction renvoie FALSE).
			 {
				  echo 'Echec de l\'upload !';
			 }
		}
		else
		{
			 echo $erreur;
		}
	}
//changer de mot de passe***************************************
	if(isset($_POST['chgmp'])){
				if($_POST['renvpass']== $_POST['nvpass']){
					$nvpass=$_POST['nvpass'];
				  $req=mysql_query('update utilisateur set pass="'.$nvpass.'" where idUti='.$id1) or die(mysql_error());
				  if($req){
					  echo 'Mot de passe changé avec succès !';
				  }
				}else echo'Vous n\'avez pas resaisi le meme mot de passe...';
		
	}
//changer de pseudo***************************************
	if(isset($_POST['changePseudo'])){
				if(isset($_POST['pseudo'])){
					$pseudo=$_POST['pseudo'];
				  $req=mysql_query('update utilisateur set pseudo="'.$pseudo.'" where idUti='.$id1) or die(mysql_error());
				  if($req){
					  echo 'Pseudo changé avec succès !';
					  $_SESSION['pseudo']=$pseudo;
				  }
				}
		
	}
?>