<?php
//*****************	
include 'fonction.php';
		
class question{
	public function liste(){
		echo "<table class='table table-striped table-expansed table-radius'>
    <caption class='text-center'>Liste des qestions</caption>
    <thead>
        <tr class='active'>
            <th style='width:10%'>Auteur</th>
            <th style='width:35%'>Sujet</th>
			<th style='width:5%'>Vus</th>
            <th style='width:15%'>Date</th>
            <th style='width:5%'>Postes</th>
			<th style='width:5%'>Resolu?</th>
        </tr>
    </thead>
	 <tbody>
        
            ";

$resutat = mysql_query("SELECT * FROM question WHERE idGrp=1") or die(mysql_error());
$nbrTotalQues = mysql_num_rows($resutat);
$nbrQuesParPage=10;
$pagestr='<a href="index.php?page=';
			

paginationn($nbrTotalQues, $nbrQuesParPage, $pagestr);

$limit=$GLOBALS['limit'];
$pagination=$GLOBALS['pagination'];


$req=mysql_query("SELECT pseudo, avatar, idQu, sujet, DATE_FORMAT(heureQu, '%d/%m/%Y à %Hh:%i') heureQu, resolu, q.idUti aut, idGrp
	FROM question AS q, utilisateur AS u
	where u.idUti=q.idUti AND idGrp=1
	ORDER BY idQu DESC $limit");

while($affich = mysql_fetch_array($req)){
	$idQu=$affich['idQu'];
	$sql2="SELECT count(*) AS nbPo FROM poste where idQu='$idQu'";
	$sql3="SELECT count(*) AS vu FROM vu_question where idQu='$idQu'";
	$result2=mysql_query($sql2);
	$aff=mysql_fetch_array($result2);
	$result3=mysql_query($sql3);
	$show=mysql_fetch_array($result3);
	$avatar=$affich['avatar'];
					  echo	"<tr>
					  		<th class='text-capitalize'><a href='../profile.php?idUti=".$affich['aut']."'>
								<img src='http://localhost/plateforme/banque de donnees/utilisateur avatar/";
								avatar($avatar);
						echo	"' style='display:block; height:60px; width:60px;' class='img-responsive profile-image img-rounded'' />
								<span style='padding-left:5px'>".$affich['pseudo']."</span>
							</a></th>
					  		<th><a href='voir_poste.php?idQu=".$affich['idQu']."'>".$affich['sujet']."</a></th>
							<th>".$show['vu']."</th>
							<th>".$affich['heureQu']."</th>
							<th>".$aff['nbPo']."</th>";
	if($affich['resolu']==1){
					  echo"<th class='text-success'>OUI</th>";
	}
	else{
					   echo"<th class='text-danger'>NON</th>";
	}
}
					echo '	</tr>
							</tbody>
							</table>
							<nav aria-label="Page navigation">
								<ul class="pager">
									<li>'.$pagination.'</li>
								</ul>
							</nav>
							';

}


public function ajouter(){

if(isset($_POST['Submit'])){	
// get data that sent from form
$idUti=$_POST['idUti'];
$idGrp=$_GET['id'];
$sujet = mysql_real_escape_string(htmlspecialchars($_POST['sujet']));
$det = mysql_real_escape_string(htmlspecialchars($_POST['detail']));
$detail = nl2br($det);

if (empty($_POST['sujet']) && empty($_POST['detail']))
    {
    ?>
        <script>
            Javascript:alert('ECHEC....... Voulez-vous posez votre question s\'il vous plait et nous le detailler? Merci...')			
        </script>
    <?php
	}
	
elseif (empty($_POST['sujet']) && !empty($_POST['detail']))
    {
    ?>
        <script>
            Javascript:alert('ECHEC....... Veuillez fomuler votre sujet en quelques mots s il vous plait.')
						
        </script>
    <?php
    }

elseif (!empty($_POST['sujet']) && empty($_POST['detail']))
    {
    ?>
        <script>
            Javascript:alert('ECHEC....... Merci de nous expliquez clairement votre probleme.')
						
        </script>
    <?php
	}

else{
$sql="INSERT INTO question(sujet, detailQu, idUti, idGrp) VALUES('$sujet','$detail','$idUti','$idGrp')";
$result=mysql_query($sql) or die(mysql_error());
mysql_close();
echo "
        <script>
            Javascript:alert('Vous venez de posez une question.');
			indexRedir();
        </script>
	";
}
}
}

public function modifier(){
	if(isset($_POST['enreg'])){
		$idQu = $_POST['idQu'];
		$sujet = mysql_real_escape_string(htmlspecialchars($_POST['sujet']));
		$det = mysql_real_escape_string(htmlspecialchars($_POST['detail']));
		$detail = nl2br($det);
		$resultat = mysql_query("UPDATE question SET sujet = '$sujet', detailQu = '$detail' WHERE idQu = ".$idQu) or die( mysql_error());
		if($resultat)
			{
				echo("<script>alert('La modification à été effectuée avec succes.');
				voirPoste(".$idQu.");</script>");
			}
			else
			{
				echo("<script>alert('La modification à échouée.')</script>") ;
		
			}
				
	
	}
	}


public function supprimer(){
	
	if(isset($_GET['idQu'])){
						$req = mysql_query("DELETE FROM `question` WHERE `idQu` = ".$_GET['idQu']) or die(mysql_error());
			
					if($req){
						echo("<script>alert('La suppression à été effectuée avec succes.'); window.history.go(-1);</script>") ;
								
							}else	echo("<script>alert('La Suppression a échouee.');</script>") ;
				
							}
 		
}



public function affiche(){
	$idQu=$_GET['idQu'];		
$sql="SELECT pseudo, avatar, sujet, detailQu, heureQu, q.idUti AS createur, resolu
		FROM utilisateur AS u, question AS q
		WHERE u.idUti=q.idUti && q.idQu='$idQu'";
$result=mysql_query($sql);
$rows=mysql_fetch_array($result);

if($rows['resolu']==1){
	echo "
			<div class='alert alert-success'>
			<strong>Ce Sujet est resolu...</strong>
			</div>
		";
}

if($_SESSION['id']==$rows['createur'] && $rows['resolu']==0){
echo "
<button class='btn btn-primary' onclick='btnResol(".$idQu.")'>RESOLU</button>
";
}
echo"
<div class='voireSuj jumbotron'>";
  
 if($_SESSION['id']==$rows['createur'] && $rows['resolu']==0){
  
  echo"<div class='dropdown' style='float:right'>
  		<button class='btn btn-success dropdown-toggle' type='button' data-toggle='dropdown'>
  			<span class='caret'></span>
		</button>
  		<ul class='dropdown-menu'>
    		<li><a href='modifier_Qu.php?idQu=".$idQu."'>Modifier</a></li>
			<li class='divider'></li>
    		<li><a href='supprimerQu.php?idQu=".$idQu."'>Supprimer</a></li>
  		</ul>
	</div>";
  }
  echo"
  	<div class='media'>
  	<div class='media-left'>
		<a href='../profile.php?idUti=".$rows['createur']."'>
			<img class='media-objet' src='http://localhost/plateforme/banque de donnees/utilisateur avatar/";avatar($rows['avatar']);
  	echo"' style='display:block; height:100px; width:100px'>
    	</a>
	</div>
	<div class='media-body'>
	
		<h2>".$rows['sujet']."</h2>
    
		<p class='text-capitalize' ><font size='2'>Poser par : <strong>".$rows['pseudo']."</strong> --- Le ".$rows['heureQu']."</font></p>
  	
		<hr>

		<br> 
  		<p><font size='4'>".nl2br($rows['detailQu'])."</font></p>
  		<hr>
  		<br>
  </div>
</div>
</div>
<BR>";
	
	}
	

}//fin classe questio
?>