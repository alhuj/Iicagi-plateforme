<div align="center" class="block1 form-group">
		<form class="form-inline" action="index.php" method="post">
		 	<div style="background-color:#0CF;color:white">
				<h2>Session administrateur</h2>
		  	</div><br />
            <div >
            <?php
					$_SESSION['pseudo']='';
					$_SESSION['avatar']='';
					$_SESSION['idUti']=0;
					$_SESSION['id']=0;
if(isset($_POST['submit'])){
			$login=$_POST['login'];
			$password=$_POST['password'];
			if($login && $password){
				$req=mysql_query("select * from utilisateur where pseudo='$login' and pass='$password' and idPrivi<>3");
				$rows=mysql_num_rows($req);
				$affich=mysql_fetch_array($req);
				if($rows==1){
					$_SESSION['pseudo']=$login;
					$_SESSION['idUti']=$affich['idUti'];
					$_SESSION['avatar']=$affich['avatar'];
					$_SESSION['id']=$affich['idUti'];
					 header("refresh:0;url=../admin/panneau.php");
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