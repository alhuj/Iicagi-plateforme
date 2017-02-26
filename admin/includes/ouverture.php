<?php
$r=mysql_query('select * from type_utilisateur_sys')or die (mysql_error());
$aff=mysql_fetch_array($r);
echo'
<strong><p>Bonjour site pas encore utilisable car ayant 0 utilisateur et 0 administrateur.<br />
	Veuillez remplir le formulaire ci dessous pour creer le premier utilisateur qui aura meme tous les privileges sur les autres administrateurs.</p></strong><br />
	<div align="center" class="block1 form-group">
		<form class="form-inline" action="index.php" method="get">
		
		<input type="hidden" name="matricule" value="" />
		<input type="hidden" name="pseudo" value="admin"/>
		<input type="hidden" name="pass" value="admin"/>
        <table>
            <tr>
                <td>
                    Nom:
                </td>
                <td>
                    <input class="col-md-4 form-control" type="text" name="nom" placeholder="NOM" onfocus="blue" />
                </td>
            </tr>
            <tr>
                <td>
                    Prenom:
                 </td>
                <td>
                <input class="col-md-4 form-control" type="text" name="prenom"  placeholder="Prenom" onfocus="blue"/>
                </td>
            </tr>
            <tr>
                <td>
                    Date de naissance: 
                </td>
                <td>
<div class="container">
    <div class="row">
        <div class="col-sm-6">
            <div class="form-group">
                <div class="input-group date" id="datetimepicker1">
                    <input type="text" name="dateNaiss" class="form-control" />
                </div>
            </div>
        </div>
        <script type="text/javascript">
            $(function () {
                $("#datetimepicker1").datetimepicker();
            });
        </script>
    </div>
</div>                </td>
            </tr>
            <tr>
                <td>
                    Lieu de naissance: 
                </td>
                <td>
                    <input class="col-md-4 form-control" type="text" name="lieuNaiss"  placeholder="Lieu de naissance" onfocus="blue"/> 
                </td>
            </tr>
            <tr>
                <td>
                    Adresse: 
                </td>
                <td>
                    <input class="col-md-4 form-control" type="text" name="adresse"  placeholder="Adresse" onfocus="blue" />
                </td>
            </tr>            
            <tr>
                <td>
                    Telephone(+221):
                </td>
                <td>
                    <input class="col-md-4 form-control" type="tel" name="telephone"  placeholder="" onfocus="blue"/>
               	</td>
         	</tr> 
            <tr>
                <td>
                    Email: 
                </td>
                <td>
                    <input class="col-md-4 form-control" type="text" name="email"  placeholder="adresse@email.com" onfocus="blue"/> 
                </td>
             </tr> 
			  <tr> 
			   <td> 
		<input class="form-control btn-succes" type="submit" name="valider" value="Valider"/>
		 </td> 
		  </tr> <br /><br />
		</table><br />';

		echo'
		</form>
		</div>';
		
		if(isset($_GET['valider'])){
			$matricule='ADMIN1';
			$pass='admin';
			$pseudo='admin';
			$nom=$_GET['nom'];
			$prenom=$_GET['prenom'];
			$dateNaiss=$_GET['dateNaiss'];
			$lieuNaiss=$_GET['lieuNaiss'];
			$adresse=$_GET['adresse'];
			$telephone=$_GET['telephone'];
			$email=$_GET['email'];
			$req=mysql_query("INSERT INTO utilisateur (idUti, matricule, pseudo, pass, nom, prenom, dateNaiss, lieuNaiss, adresse, telephone, email,idFil,idNiv, idPrivi, idType) VALUES(1, '$matricule', '$pseudo', '$pass', , '$nom', '$prenom', '$dateNaiss', '$lieuNaiss', '$adresse', $telephone, '$email',1,1,1,7)") or die(mysql_error());
				
					if($req){
					echo "<script>alert('operation reussie!!!<br />
					Ouverture de la plateforme....<br /><br />pseudo: ".$pseudo."<br />password: ".$pass."Veuillez bien les retenir')</script>";	
					$sujet = 'Sujet de l\'email';
					$message = "<p>Bonjour,<br />
<strong>Ceci est un message de confirmation de la création du premier compte administrateur de la plateforme de forum d\'ICAGI.</strong><br />
</p>
  <p>Votre pseudo est:".$pseudo."<br />
	Votre mot de passe est:".$pass."<br />
	Vous pouvez les modifier à partir de la gestion de votre compte:<br /><br />
	<a href='http://localhost/plateforme/admin/compte.php'>Compte</a></p><br />
	<p>
	Vous pouvez aussi accéder au panneau d'administrateur à partir de la gestion de votre compte:<br /><br />
	<a href='http://localhost/plateforme/admin/compte.php'>Compte</a></p><br />	</p>";
$destinataire = $email;
$headers = "From: \"ICAGI\"<plateforme@icagi.com>\n";
$headers .= "Reply-To: petitho91@gmail.com\n";
$headers .= "Content-Type: text/html; charset=\"iso-8859-1\"";
if(mail($destinataire,$sujet,$message,$headers))
{
        echo "L'email a bien été envoyé.";
}
else
{
        echo "Une erreur c'est produite lors de l'envois de l'email.";
}
					header("refresh:3;url=../admin/panneau.php");			
				}else echo'echec!!!';
		}
		
?>
	 