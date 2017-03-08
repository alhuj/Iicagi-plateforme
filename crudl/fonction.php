<?php
/*******************************/
function genmatr($nom,$prenom,$idFil,$idNiv){
$matr='';
$req=mysql_query('select * from utilisateur');
$nbre=mysql_num_rows($req)+1;
$i=strlen($nom)-1;
if($i>=2){
	$c1=substr($nom, 0, 2);
	}
$m=strlen($prenom)-1;
if($m>=2){
	$c2=substr($prenom, 0, 2);
	}
	$c3=$idFil;
	$c4=$idNiv;
	$matr=$c1.$c2.$c3.$c4.$nbre;
return $matr;
}
/*******************************/

function genpseudo(){
$name=$nom=$_POST['nom'];
$var="";
$car = array();
$chars='abcdefghijklmnopqrstuvwxyz0123456789';
$max=strlen($chars)-1;
for($i=0;$i<4;$i++){
	$car[$i]=$chars[mt_rand(0,$max)];
	$var=$var.$car[$i];
}
$m=strlen($nom)-1;
if($m>5){
	$name=substr($nom, 0, 5);
	}
return $pseudo=$name.$var;

}
//*******************************

function genpass(){
$pass="";
$car = array();
$chars='abcdefghijklmnopqrstuvwxyz0123456789';
$max=strlen($chars)-1;
for($i=0;$i<7;$i++){
	$car[$i]=$chars[mt_rand(0,$max)];
	$pass=$pass.$car[$i];
}
return $pass;
}


function paginationn($nbrTotalQues,$nbrQuesParPage,$pagestr){
$nbr_total_ques=$nbrTotalQues;
$nbr_ques_par_page = $nbrQuesParPage;
$nbr_page_max_avt_et_apr = 4;
global $limit;
global $pagination;
$nbr_pages = ceil($nbr_total_ques / $nbr_ques_par_page);

if(isset($_GET['page']) && is_numeric($_GET['page'])){
	$page_num = $_GET['page'];
} else{
	$page_num = 1;
}

if($page_num < 1){
	$page_num = 1;
} else if($page_num > $nbr_pages){
	$page_num = $nbr_pages;
}

$limit = 'LIMIT '.($page_num - 1) * $nbr_ques_par_page. ',' .$nbr_ques_par_page;

$pagination = '';

if($nbr_pages != 1){
	if($page_num > 1){
		$previous = $page_num - 1;
		$pagination .= $pagestr.$previous.'">Précédent</a> &nbsp; &nbsp;';

		for($i = $page_num - $nbr_page_max_avt_et_apr; $i < $page_num; $i++){
			if($i > 0){
				$pagination .= $pagestr.$i.'">'.$i.'</a> &nbsp;';
			}
		}
	}

	$pagination .= '<span>'.$page_num.'</span>&nbsp;';

	for($i = $page_num + 1; $i <= $nbr_pages; $i++){
		$pagination .= $pagestr.$i.'">'.$i.'</a> ';

		if($i >= $page_num + $nbr_page_max_avt_et_apr){
			break;
		}
	}

	if($page_num != $nbr_pages){
		$next = $page_num + 1;
		$pagination .= $pagestr.$next.'">Suivant</a> ';
	}
}

}


function avatar($avatar){

	if(empty($avatar)){
		echo 'defaultUser.jpg';
	}
	else echo $avatar;
}







//*******************************
/*
class activeMenu{
	public function accueil(){
		$site=$_SERVER['PHP_SELF'];
		if($site=='/it-school/admin/panneau.php'){
			echo'activemenu';
			}else echo'';
	}
	public function tablSyst(){
		$site=$_SERVER['PHP_SELF'];
		$chaine='tables systemes';
		$search=strpos($site,$chaine);
		if($site===true){
			echo'activemenu';
			}else echo'';
	}
	public function poste(){
		$site=$_SERVER['PHP_SELF'];
		$chaine='postes';
		$search=strpos($site,$chaine);
		if($site===true){
			echo'activemenu';
			}else echo'';
	}
	public function biblio(){
		$site=$_SERVER['PHP_SELF'];
		$chaine='biblio';
		$search=strpos($site,$chaine);
		if($site===true){
			echo'activemenu';
			}else echo'';
	}
	public function quizz(){
		$site=$_SERVER['PHP_SELF'];
		$chaine='quizz';
		$search=strpos($site,$chaine);
		if($site===true){
			echo'activemenu';
			}else echo'';
	}
		public function usergrp(){
		$site=$_SERVER['PHP_SELF'];
		$chaine='utilisateur groupe';
		$search=strpos($site,$chaine);
		if($site===true){
			echo'activemenu';
			}else echo'';
	}

}*/
?>
