
   function voirPoste(idQu){
		document.location='voir_poste.php?idQu='+idQu;
	}

   function btnModifQu(idQu){
	   var val=(confirm("Voulez-vous Modifier le sujet??????"))?true:false;
	   if(val==true){
	   	document.location='modifier_Qu.php?idQu='+idQu;
	   }
   }

	function btnModifPo(idQu,idPo){
		var val=(confirm("Voulez-vous Modifier cette reponse??????"))?true:false;
		if(val==true){
	   		document.location='modifier_Po.php?idQu='+idQu+'&&idPo='+idPo;
	   }
	}

	function btnSuppQu(idQu){
		var val=(confirm("Voulez-vous supprimer votre sujet??????"))?true:false;
		if(val==true){
	   		document.location='supprimerQu.php?idQu='+idQu;
		}
	}

   function btnSuppPo(id){
		var val=(confirm("Voulez-vous supprimer la reponse??????"))?true:false;
		if(val==true){
			document.location='supprimerPo.php?id='+id;
		}
	}


	function indexRedir(){
		window.history.go(-2);
	}

	function newSujet(){
		document.location='ajouter_sujet.php?id=1';
	}
  function newSujetGrp(id){
		document.location='ajouter_sujet.php?id='+id;
	}


	function ouvrirEnrg(id){
		document.location='affiche.php?id='+id;
	}

	function btnResol(idQu){
		var val=(confirm("Voulez-vous vraiment Resoudre ce sujet??????"))?true:false;
		if(val==true){
			document.location='resolu.php?id='+idQu;
		}
	}



function lienModif(){
	document.getElementById('form').style.display = 'block';
    document.getElementById('quest').style.display = 'none';
}


function grpRedir(id){
  document.location='affiche.php?id='+id;
}
