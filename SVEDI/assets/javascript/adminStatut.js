$(window).load(function(){



	/*-------POPUP functions------*/
	var showPopUp = function showPopUp(title,type,id){
		//$("#modal").show();
		$("#modal").css("visibility", "visible");
		$("#modal").css("opacity","1");
		$("#Title").text(title);

		if(type == "A"){
			$("#validerSM").hide();
			$("#validerSA").show();
		}

		if(type == "M"){
			$("#validerSA").hide();
			$("#validerSM").show();
		}

		$("#popUpCode").val($("#U"+id+"-Code").val());
		$("#popUpLibelle").val($("#U"+id+"-Libelle").val());
		$("#popUpNbHeure").val($("#U"+id+"-NbHeure").val());
		$("#popUpID").val(id);
	}

	var closePopUp = function closePopUp(){
		//$("#modal").hide();
		$("#modal").css("visibility", "hidden");
		$("#modal").css("opacity","0");

	}

	var showMsg = function showMsg(msg){
		$("#msgInfo").text(msg);
	}


//aaplication des modifications sur utilisateur
	$("#validerSM").click(function(){
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		closePopUp();
		return null;
	}

	xhr.onreadystatechange = function() {
	        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
	                // Données textuelles récupérées
	                //alert(xhr.responseText);
	                closePopUp();
	                var url = "../ControleurTypeUtilisateur/log?SM=ok";
	                $(location).attr('href',url).delay(250);
	        }
	};

	
	xhr.open("GET", "../ControleurTypeUtilisateur/SM?ID="+$("#popUpID").val()+"&Code="+$("#popUpCode").val()+"&Libelle="+$("#popUpLibelle").val()+"&NbHeure="+$("#popUpNbHeure").val(), true);

	xhr.send(null);
    });


//aaplication des modifications sur utilisateur
	$("#validerSA").click(function(){
	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		closePopUp();
		return null;
	}

	xhr.onreadystatechange = function() {
	        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
	                // Données textuelles récupérées
	                //alert(xhr.responseText);
	                closePopUp();
	                var url = "../ControleurTypeUtilisateur/log?SA=ok";
	                $(location).attr('href',url).delay(250);
	        }
	};

	
	xhr.open("GET", "../ControleurTypeUtilisateur/SA?Code="+$("#popUpCode").val()+"&Libelle="+$("#popUpLibelle").val()+"&NbHeure="+$("#popUpNbHeure").val(), true);

	xhr.send(null);
    });




	/*----------------------------*/





	$('#admin img[id^="FM"],#admin img[id^="SM"]').mouseover(function(){
		this.src = "../../assets/images/iconeModifierHover.png";
	});

	$('#admin img[id^="FM"],#admin img[id^="SM"]').mouseout(function(){
		this.src = "../../assets/images/iconeModifier.png";
	});


	$('#admin img[id^="FS"],#admin img[id^="SS"]').mouseover(function(){
		this.src = "../../assets/images/iconeSupprimerHover.png";
	});

	$('#admin img[id^="FS"],#admin img[id^="SS"]').mouseout(function(){
		this.src = "../../assets/images/iconeSupprimer.png";
	});


var log = function log(qui,quoi){

console.log("log");
	if (qui == "U" ){

		if($('#ULog').text() == ""){
			$('#ULog').css("opacity", "1");
			$('#ULog').text(quoi);
			return;
		}

		if($('#ULog').css("opacity") == 0 ){
			$('#ULog').css("opacity", "1");
			$('#FLog').css("opacity", "0");
			$('#ULog').text(quoi);
		}else{
		$('#FLog').css("opacity", "0");
		$('#ULog').css("opacity", "0");
		$('#ULog').text(quoi);

		setTimeout(function(){$('#ULog').css("opacity", "1" )}, 200);
		}

	}else{

		if($('#FLog').text() == ""){
			$('#FLog').css("opacity", "1");
			$('#FLog').text(quoi);
			return;
		}

		if($('#FLog').css("opacity") == 0 ){
			$('#FLog').css("opacity", "1");
			$('#ULog').css("opacity", "0");
			$('#FLog').text(quoi);
		}else{
		$('#ULog').css("opacity", "0");
		$('#FLog').css("opacity", "0");
		$('#FLog').text(quoi);

		setTimeout(function(){$('#FLog').css("opacity", "1" )}, 200);
		}

	}

}


	$("#newStatut").click(function(e){
		e.preventDefault();
		showPopUp("Ajouter un Statut","A",this.id.substring(2));
	});

	$('#admin img[id^="SM"]').click(function(){

	var xhr = null;
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		closePopUp();
		return null;
	}

});

	$('#admin img[id^="SM"]').click(function(e){
		    e.preventDefault();
			showPopUp("Modifier Statut","M",this.id.substring(2));
	});


	$('#admin img[id^="FS"]').click(function(){

			var xhr = null;

			var tr = this.parentNode.parentNode;
			tr.remove();
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		closePopUp();
		return null;
	}

xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                // Données textuelles récupérées
                log("F",xhr.responseText);
        }
};


	});
	$('#admin img[id^="SS"]').click(function(){
	if(confirm("Etes vous sur de vouloir supprimer ce statut ?"))
	{
				var xhr = null;

			var tr = this.parentNode.parentNode;
			tr.remove();
	
	if (window.XMLHttpRequest || window.ActiveXObject) {
		if (window.ActiveXObject) {
			try {
				xhr = new ActiveXObject("Msxml2.XMLHTTP");
			} catch(e) {
				xhr = new ActiveXObject("Microsoft.XMLHTTP");
			}
		} else {
			xhr = new XMLHttpRequest(); 
		}
	} else {
		alert("Votre navigateur ne supporte pas l'objet XMLHTTPRequest...");
		closePopUp();
		return null;
	}

xhr.onreadystatechange = function() {
        if (xhr.readyState == 4 && (xhr.status == 200 || xhr.status == 0)) {
                // Données textuelles récupérées
                log("U",xhr.responseText);
        }
};
xhr.open("GET",  $("#baseUrl").val()+"ControleurTypeUtilisateur/SS?ID="+this.id.substring(2), true);
xhr.send(null);

}
});


//add listener sur le click de fermeture
$(".closePopUp").click(closePopUp);

/*
$("#modal").click(function(){
	if (!$("#popUpStatut").is(":hover")) {
	closePopUp();
	}
});
*/

	closePopUp();

});