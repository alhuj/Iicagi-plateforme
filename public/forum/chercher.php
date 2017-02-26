<?php
include('../../config.php');
$titre="Recherche Sujet";
include('../includes/debut.php');
include('../includes/menuForum.php');

if(isset($_POST['submit'])){ 
	   
	  if(preg_match("/^[  a-zA-Z]+/", $_POST['sujet'])){ 
	  $sujet=$_POST['sujet']; 

	  //-query  the database table 
	  $sql="SELECT  idQu, sujet FROM question WHERE sujet LIKE '%" . $sujet .  "%'"; 
	  //-run  the query against the mysql query function 
	  $result=mysql_query($sql) or die(mysql_error()); 
	  //-create  while loop and loop through result set 
	  while($row=mysql_fetch_array($result)){
	          $sujet1=$row['sujet']; 
	          $ID=$row['idQu']; 
	  //-display the result of the array 
	  echo "<ul>\n"; 
	  echo "<li>" . "<a  href=\"voir_poste.php?idQu=$ID\">"   .$sujet1.  "</a></li>\n"; 
	  echo "</ul>"; 
	  } 
	  } 
	  else{ 
	  		echo("<script>alert('Veuillez Saisir un mot clé.');</script>") ;
	  
	  } 
	  } 
	  


?>