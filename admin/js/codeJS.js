
   
   function btnModif(id){
	   document.location='modifier.php?id='+id;
	   }

   function btnSupp(id){
	var val=(confirm("Voulez-vous vraiment supprimer cet enregistrement:"))?true:false; 
	if(val==true){
	document.location='supprimer.php?id='+id;
	}else 
	location.reload();
	   }
	   
	function indexRedir(){
		document.location='index.php';
	}
	
	function ouvrirEnrg(id){
		document.location='affiche.php?id='+id;
	}
	
	function btnBloq(id){
		   	var val=(confirm("Voulez-vous vraiment bloquer cet utilisateur:"))?true:false; 
			if(val==true){
				document.location='bloquer.php?id='+id;
			}else location.reload();

	   }	 
	   function btnDebloq(id){
		   	var val=(confirm("Voulez-vous vraiment débloquer cet utilisateur:"))?true:false; 
			if(val==true){
				document.location='debloquer.php?id='+id;
			}else location.reload();

	   }