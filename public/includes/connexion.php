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

<div class="row">
	<div class="col-sm-6 col-md-4 col-md-offset-4">
            <div class="account-wall">
                <img class="profile-img" src="https://lh5.googleusercontent.com/-b0-k99FZlyE/AAAAAAAAAAI/AAAAAAAAAAA/eu7opA4byxI/photo.jpg?sz=120"
                    alt="">
                <form class="form-signin" action="index.php" method="post">
                <input type="text" class="form-control" placeholder="pseudo" name="login" required autofocus>
                <input type="password" class="form-control" placeholder="Mot de Passe" name="password" required>
                <button class="btn btn-lg btn-primary btn-block" name="submit" type="submit">
                    Sign in
								</button>
                <a href="#" class="pull-right need-help">Need help? </a><span class="clearfix"></span>
                </form>
            </div>
        </div>
    </div>
	</div>
	<br>
