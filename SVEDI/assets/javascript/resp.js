$(window).load(function(){

$("#saveBtn").click(function(){

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
	                 var url = "../ControleurRespModifierFiliere/";
	                $(location).attr('href',url);
	        }
	};

	xhr.open("GET", "../ControleurAjax/changeNom/?nom="+$("#FNom").val(), true);

	xhr.send(null);
 });


//-----------------------------------------moh-------------
$("#selectEnseignantsD.selectRespInscr").change(function(){
	
	 var url = "../ControleurRespDescrEns/Tableau?id="+this.value;
	                $(location).attr('href',url);
					
});
//-----------------------------------------moh-------------


$("#selectMatiere").change(function(){

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
	                //console.log(xhr.responseText);
	                $("#infoM").html(xhr.responseText);
	        }
	};

	xhr.open("GET", "../ControleurAjax/getInfoM/"+this.value, true);

	xhr.send(null);
    });


	$("#HTD,#HTP,#HC").val(0);


	$("#HTD,#HTP,#HC").on('change',function(){
	if($(this).val()==""){$(this).val(0);}
	});
	$("#HTD,#HTP,#HC").on('blur',function(){
	if($(this).val()==""){$(this).val(0);}
	});
	$("#HTD,#HTP,#HC").on('focus',function(){
	if($(this).val()=="0"){$(this).val("");}
	});


	$("#inscrireEns").click(function(){
		var ok = true;

		if ($("#HTD").val() == 0 && $("#HTP").val() == 0 && $("#HC").val() == 0){
			ok  = false;
		}

		if(!($("#selectMatiere").val() != null)){
			ok  = false;
		}

		if(!($("#selectEnseignants").val() != null)){
			ok  = false;
		}


		if(ok){

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
			                //console.log(xhr.responseText);
			                $("#logMsg").text(xhr.responseText);
			        }
			};

			xhr.open("GET", "../ControleurRespInscrEns/Inscr/?Eid="+$("#selectEnseignants").val()+"&Mid="+$("#selectMatiere").val()+"&HC="+$("#HC").val()+"&HTD="+$("#HTD").val()+"&HTP="+$("#HTP").val(), true);

			xhr.send(null);
		    

		}

	});


/**********************************************************************************************************************/

/**********************************************************************************************************************/

/*-------POPUP functions------*/
	var showPopUp = function showPopUp(title,type,id){
		//$("#modal").show();
		$("#modal").css("visibility", "visible");
		$("#modal").css("opacity","1");
		$("#Title").text(title);


		if(type == "A"){
			$("#validerMM").hide();
			$("#validerMA").show();

			$("#popUpNom").val("");
			$("#popUpHC").val("");
			$("#popUpHTD").val("");
			$("#popUpHTP").val("");
			$("#popUpSemestre").val("");

			$("#popUpHTD,#popUpHTP,#popUpHC").val("0");
			$('#popUpSemestre option[value=1]').prop('selected', true);
		}

		if(type == "M"){
			$("#validerMA").hide();
			$("#validerMM").show();


			$("#popUpNom").val($("#M"+id+"-Nom").val());
			$("#popUpHC").val($("#M"+id+"-HC").val());
			$("#popUpHTD").val($("#M"+id+"-HTD").val());
			$("#popUpHTP").val($("#M"+id+"-HTP").val());
			$("#popUpID").val(id);

		
		$('#popUpSemestre option[value="'+$("#M"+id+"-Semestre").val()+'"]').prop('selected', true);

		}

	}

	var closePopUp = function closePopUp(){
		//$("#modal").hide();
		$("#modal").css("visibility", "hidden");
		$("#modal").css("opacity","0");

	}

closePopUp();


	$("#popUpHTD,#popUpHTP,#popUpHC").on('change',function(){
	if($(this).val()==""){$(this).val(0);}
	});
	$("#popUpHTD,#popUpHTP,#popUpHC").on('blur',function(){
	if($(this).val()==""){$(this).val(0);}
	});
	$("#popUpHTD,#popUpHTP,#popUpHC").on('focus',function(){
	if($(this).val()=="0"){$(this).val("");}
	});

	$("#addMatiereRespImg").mouseover(function(){
		this.src = "../../assets/images/addFiliereHover.png";
	});

	$("#addMatiereRespImg").mouseout(function(){
		this.src = "../../assets/images/addFiliere.png";
	});


	$("#Resp h6 a img#addMatiereImg").mouseover(function(){
		this.src = "../../assets/images/addUserHover.png";
	});

	$("#Resp h6 a img#addMatiereImg").mouseout(function(){
		this.src = "../../assets/images/addUser.png";
	});



	$('#Resp img[id^="MM"]').mouseover(function(){
		this.src = "../../assets/images/iconeModifierHover.png";
	});

	$('#Resp img[id^="MM"]').mouseout(function(){
		this.src = "../../assets/images/iconeModifier.png";
	});


	$('#Resp img[id^="MS"]').mouseover(function(){
		this.src = "../../assets/images/iconeSupprimerHover.png";
	});

	$('#Resp img[id^="MS"]').mouseout(function(){
		this.src = "../../assets/images/iconeSupprimer.png";
	});


	$("#newMatiere").click(function(e){
		e.preventDefault();
		showPopUp("Ajouter un utilisateur","A",this.id.substring(2));
	});



	$('#Resp img[id^="MM"]').click(function(e){
		    e.preventDefault();
			showPopUp("Modifier matière","M",this.id.substring(2));
	});



	$("#addMatiereResp a").click(function(e){
		e.preventDefault();
		showPopUp("Ajouter une matière","A",0);
	});



$("#validerMM").click(function(){
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
	                var url = "../ControleurRespModifierFiliere/log?MM=ok";
	                $(location).attr('href',url).delay(250);
	        }
	};
	xhr.open("GET", "../ControleurRespModifierFiliere/modifierM/?id="+$("#popUpID").val()+"&nom="+$("#popUpNom").val()+"&HC="+$("#popUpHC").val()+"&HTD="+$("#popUpHTD").val()+"&HTP="+$("#popUpHTP").val()+"&semestre="+$("#popUpSemestre").val(), true);

	xhr.send(null);
    });


$("#validerMA").click(function(){

	if($("#popUpNom").val() != ""){
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
		                var url = "../ControleurRespModifierFiliere/log?MA=ok";
		                $(location).attr('href',url).delay(250);
		        }
		};
		
		xhr.open("GET", "../ControleurRespModifierFiliere/ajouterM/?nom="+$("#popUpNom").val()+"&HC="+$("#popUpHC").val()+"&HTD="+$("#popUpHTD").val()+"&HTP="+$("#popUpHTP").val()+"&semestre="+$("#popUpSemestre").val(), true);

		xhr.send(null);
		}
    });


$('#Resp img[id^="MS"]').click(function(){
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
	                log("Suppression éffectuée");
	        }
	};
	xhr.open("GET", "../ControleurRespModifierFiliere/supprM?id="+this.id.substring(2), true);
	xhr.send(null);

});





var log = function log(quoi){


		if($('#Log').text() == ""){
			$('#Log').css("opacity", "1");
			$('#Log').text(quoi);
			return;
		}

		if($('#Log').css("opacity") == 0 ){
			$('#Log').css("opacity", "1");
			$('#Log').css("opacity", "0");
			$('#Log').text(quoi);
		}else{
		$('#Log').css("opacity", "0");
		$('#Log').css("opacity", "0");
		$('#Log').text(quoi);

		setTimeout(function(){$('#Log').css("opacity", "1" )}, 200);
		}

}







//add listener sur le click de fermeture
$(".closePopUp").click(closePopUp);

$("#modal").click(function(){
	if(!$("#popUpMatiere").is(':hover')){
		closePopUp();
	}
});


});