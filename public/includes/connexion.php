<div align="center" class="block1 form-group">
		<form class="form-inline" action="index.php" method="post">
		 	<div style="background:#00C; color:#090">
				<h2>Connexion à la plateforme</h2>
		  	</div><br />
            <div >
            <?php
if(isset($_POST['submit'])){
			$login=$_POST['login'];
			$password=$_POST['password'];
			if($login && $password){
				$req=mysql_query("select * from utilisateur where pseudo='$login' and pass='$password'");
				$rows=mysql_num_rows($req);
				$affiche=mysql_fetch_array($req);
				if($rows==1){
					if($affiche['bloquer']==0){
					$requete=mysql_query('update utilisateur set dateDerConn=NOW() where idUti='.$affiche['idUti']);
					$_SESSION['pseudo']=$login;
					$_SESSION['id']=$affiche['idUti'];
					$_SESSION['idPrivi']=$affiche['idPrivi'];
					$_SESSION['avatar']=$affiche['avatar'];
					 header("refresh:0;url=../public/index.php");
					}else echo"<strong style='color:red'>Désolé votre compte a été bloqué.</strong><br /><br />";
				}else {
					echo ("<strong style='color:red'>Mot de passe ou login incorrect<br>Veuilllez reessayer SVP!</strong><br /><br />");
					
						}
			}else 
				{
					echo ("<strong style='color:red'>Veuillez saisir tous les champs<br>Reessayer SVP!</strong><br /><br />");
				}
	}
	?>
			</div>
		  	<div>
				<div>
					<input class="form-control" id="username" type="text" onfocus="blue" placeholder="pseudo" name="login" size="20"  tabindex="1">
				</div><br />
				<div>
					<input class="form-control" type="password" onfocus="blue" placeholder="mot de passe" id="password" name="password" size="20"  tabindex="2" maxlength="32">
				</div><br />
		  	</div><br />
			<div>
				<input class="btnConnecter" name="submit" type="submit" value="Se connecter">
			</div>  
			<div style="clear:both"></div>  
	</form>