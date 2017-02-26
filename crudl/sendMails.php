<?php
 function mailOuverture(){
		
	}
function mailPassOublie($pseudo,$pass,$email){
     $to  = htmlentities($email); 
	  if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',str_replace('&amp;','&',$to)))
        {
			 $subject = 'Mot de passe oublié';
			 $message = 'Bonjour cher '.$pseudo.',\r\nVotre mot de passe est:'.$pass;
			 $headers = 'From: petitho91@gmail.com' . "\r\n" .
			 'Reply-To: petitho91@gmail.com' . "\r\n" .
			 'X-Mailer: PHP/' . phpversion();
			 mail($to, $subject, $message, $headers);	
		}
	}
function mailPseudoIndesirable($pseudo,$email){
     $to  = htmlentities($email); 
	  if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',str_replace('&amp;','&',$to)))
        {
			 $subject = 'AvertissementPseudo indésirable';
			 $message = 'Bonjour,\r\nVotre pseudo n\'est pas conforme au réglement du plateforme.\r\nVotre nouveau pseudo est: '.$pseudo;
			 $headers = 'From: petitho91@gmail.com' . "\r\n" .
			 'Reply-To: petitho91@gmail.com' . "\r\n" .
			 'X-Mailer: PHP/' . phpversion();
			 mail($to, $subject, $message, $headers);	
		}
	}
function mailDescIndesirable($email,$pseudo){
     $to  = htmlentities($email); 
	  if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',str_replace('&amp;','&',$to)))
        {
			 $subject = 'Avertissement: Description indésirable';
			 $message = 'Bonjour '.$pseudo.',\r\nVotre description n\'est pas conforme au réglement du plateforme.\r\nLa description par defaut a ete retablie.\r\n';
			 $headers = 'From: petitho91@gmail.com' . "\r\n" .
			 'Reply-To: petitho91@gmail.com' . "\r\n" .
			 'X-Mailer: PHP/' . phpversion();
			 mail($to, $subject, $message, $headers);	
		}
	}
function mailAvatarIndesirable($email,$pseudo){
     $to  = htmlentities($email); 
	  if(preg_match('#^(([a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+\.?)*[a-z0-9!\#$%&\\\'*+/=?^_`{|}~-]+)@(([a-z0-9-_]+\.?)*[a-z0-9-_]+)\.[a-z]{2,}$#i',str_replace('&amp;','&',$to)))
        {
			 $subject = 'Avertissement: Avatar indésirable';
			 $message = 'Bonjour '.$pseudo.',\r\nVotre avatar n\'est pas conforme au réglement du plateforme.\r\nL\'avatar par defaut a ete retablie.\r\n';
			 $headers = 'From: petitho91@gmail.com' . "\r\n" .
			 'Reply-To: petitho91@gmail.com' . "\r\n" .
			 'X-Mailer: PHP/' . phpversion();
			 mail($to, $subject, $message, $headers);	
		}
	}
	
?>