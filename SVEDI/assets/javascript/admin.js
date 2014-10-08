$(window).load(function(){



	/*-------POPUP functions------*/
var showPopUpM = function showPopUp(title,type,id){
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
			$("#popUpID").val(id);

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

	var showPopUp = function showPopUp(title,type,id){
		//$("#modal").show();
		$("#modal").css("visibility", "visible");
		$("#modal").css("opacity","1");
		$("#Title").text(title);


		if(type == "A"){
			$("#validerUM").hide();
			$("#validerUA").show();

			$("#popUpPrenom").val("");
			$("#popUpNom").val("");
			$("#popUpMail").val("");
			$("#popUpLogin").val("");
			$("#popUpSexe").val("");
			$("#popUpTel").val("");
			$("#popUpMdp").val("");
			$("#popUpType").val("");
			$("#popUpID").val("");

			$('#popUpType>option').attr('selected','selected');

		}

		if(type == "M"){
			$("#validerUA").hide();
			$("#validerUM").show();


		$("#popUpPrenom").val($("#U"+id+"-Prenom").val());
		$("#popUpNom").val($("#U"+id+"-Nom").val());
		$("#popUpMail").val($("#U"+id+"-Mail").val());
		$("#popUpLogin").val($("#U"+id+"-Login").val());
		$("#popUpSexe").val($("#U"+id+"-Sexe").val());
		$("#popUpTel").val($("#U"+id+"-Tel").val());
		$("#popUpMdp").val($("#U"+id+"-Mdp").val());
		$("#popUpType").val($("#U"+id+"-Type").val());
		$("#popUpID").val(id);

		if($("#U"+id+"-Sexe").val() == "F"){
			$('#r1').prop("checked", true);
		}else{
			$('#r2').prop("checked", true);
		}

		$('#popUpRole option[value="'+$("#U"+id+"-Role").val()+'"]').prop('selected', true);
		$('#popUpType option[value="'+$("#U"+id+"-Type").val()+'"]').prop('selected', true);

		}

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
	$("#validerUM").click(function(){
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
	                var url = "../ControleurAdminHome/log?UM=ok";
	                $(location).attr('href',url).delay(250);
	        }
	};

	var sexe;

	if($('#r2').prop("checked")){
		sexe = "M";
	}
	if($('#r1').prop("checked")){
		sexe = "F";
	}

	xhr.open("GET", "../ControleurAdminHome/UM?id="+$("#popUpID").val()+"&Prenom="+$("#popUpPrenom").val()+"&Nom="+$("#popUpNom").val()+"&Mail="+$("#popUpMail").val()+"&Login="+$("#popUpLogin").val()+"&Sexe="+sexe+"&Mdp="+$("#popUpMdp").val()+"&Tel="+$("#popUpTel").val()+"&Role="+$('#popUpRole').val()+"&Type="+$('#popUpType').val(), true);

	xhr.send(null);
    });


//aaplication des modifications sur utilisateur
	$("#validerUA").click(function(){
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
	                var url = "../ControleurAdminHome/log?UA=ok";
	                $(location).attr('href',url).delay(250);
	        }
	};

	var sexe;

	if($('#r2').prop("checked")){
		sexe = "M";
	}
	if($('#r1').prop("checked")){
		sexe = "F";
	}

	xhr.open("GET", "../ControleurAdminHome/UA?Prenom="+$("#popUpPrenom").val()+"&Nom="+$("#popUpNom").val()+"&Mail="+$("#popUpMail").val()+"&Login="+$("#popUpLogin").val()+"&Sexe="+sexe+"&Mdp="+$("#popUpMdp").val()+"&Tel="+$("#popUpTel").val()+"&Role="+$('#popUpRole').val()+"&Type="+$('#popUpType').val(), true);

	xhr.send(null);
    });



//add listener sur le click de fermeture
$(".closePopUp").click(closePopUp);
if($("#popUpUser").size() != 0){
	$("#modal").click(function(){
		if (!$("#popUpUser").is(":hover")) {
		closePopUp();
		}
	});
}

if($("#popUpMatiere").size() != 0){
	$("#modal").click(function(){
		if (!$("#popUpMatiere").is(":hover")) {
		closePopUp();
		}
	});
}
	/*----------------------------*/



	$("#admin h6 a img#addUserImg").mouseover(function(){
		this.src = "../../assets/images/addUserHover.png";
	});

	$("#admin h6 a img#addUserImg").mouseout(function(){
		this.src = "../../assets/images/addUser.png";
	});

	$("#admin h6 a img#addFiliereImg").mouseover(function(){
		this.src = "../../assets/images/addFiliereHover.png";
	});

	$("#admin h6 a img#addFiliereImg").mouseout(function(){
		this.src = "../../assets/images/addFiliere.png";
	});


	$('#admin img[id^="FM"],#admin img[id^="UM"],#Resp img[id^="MM"]').mouseover(function(){
		this.src = "../../assets/images/iconeModifierHover.png";
	});

	$('#admin img[id^="FM"],#admin img[id^="UM"],#Resp img[id^="MM"]').mouseout(function(){
		this.src = "../../assets/images/iconeModifier.png";
	});


	$('#admin img[id^="FS"],#admin img[id^="US"],#Resp img[id^="MS"]').mouseover(function(){
		this.src = "../../assets/images/iconeSupprimerHover.png";
	});

	$('#admin img[id^="FS"],#admin img[id^="US"],#Resp img[id^="MS"]').mouseout(function(){
		this.src = "../../assets/images/iconeSupprimer.png";
	});

	$("#addMatiereResp a").click(function(e){
		e.preventDefault();
		showPopUpM("Ajouter une matière","A",$("#FID").val());
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


	$("#newUser").click(function(e){
		e.preventDefault();
		showPopUp("Ajouter un utilisateur","A",this.id.substring(2));
	});



	$('#admin img[id^="FM"]').click(function(){
		var url = "../ControleurAdminModifierFiliere/?id="+this.id.substring(2);
	    $(location).attr('href',url);
});



	$('#admin img[id^="UM"]').click(function(e){
		    e.preventDefault();
			showPopUp("Modifier Utilisateur","M",this.id.substring(2));
	});


	$('#Resp img[id^="MM"]').click(function(e){
		    e.preventDefault();
			showPopUpM("Modifier matière","M",this.id.substring(2));
	});


	$('#admin img[id^="FS"]').click(function(){

var r=confirm("Êtes-vous sûr de vouloir supprimer cette filière ?");
if (r==true) {

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
xhr.open("GET", "../ControleurAdminHome/FS?id="+this.id.substring(2), true);
xhr.send(null);
}
	});

$('#admin img[id^="US"]').click(function(){

	var r=confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
if (r==true) {

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
	xhr.open("GET",  "../ControleurAdminHome/US?id="+this.id.substring(2), true);
	xhr.send(null);
}
});




	$("#popUpHTD,#popUpHTP,#popUpHC").on('change',function(){
	if($(this).val()==""){$(this).val(0);}
	});
	$("#popUpHTD,#popUpHTP,#popUpHC").on('blur',function(){
	if($(this).val()==""){$(this).val(0);}
	});
	$("#popUpHTD,#popUpHTP,#popUpHC").on('focus',function(){
	if($(this).val()=="0"){$(this).val("");}
	});





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
	                //console.log(xhr.responseText);
	                 var url = "../ControleurAdminModifierFiliere/?id="+$("#FID").val();
	                $(location).attr('href',url);
	        }
	};

	xhr.open("GET", "../ControleurAjax/changeNom/?nom="+$("#FNom").val()+"&fid="+$("#FID").val(), true);
	xhr.send(null);
 });


$("#saveBtnResp").click(function(){

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
	                

	                console.log(xhr.responseText);
	                var url = "../ControleurAdminModifierFiliere/?id="+$("#FID").val();
	                $(location).attr('href',url);
	        }
	};
	xhr.open("GET", "../ControleurAjax/changeResp/?rid="+$("#selectResp").val()+"&fid="+$("#FID").val(), true);
	xhr.send(null);
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
	                var url = "../ControleurAdminModifierFiliere/log?MM=ok&id="+$("#FID").val();
	                $(location).attr('href',url).delay(250);
	        }
	};
	xhr.open("GET", "../ControleurAdminModifierFiliere/modifierM/?id="+$("#popUpID").val()+"&nom="+$("#popUpNom").val()+"&HC="+$("#popUpHC").val()+"&HTD="+$("#popUpHTD").val()+"&HTP="+$("#popUpHTP").val()+"&semestre="+$("#popUpSemestre").val(), true);

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
		                //console.log(xhr.responseText);
		                closePopUp();
		                var url = "../ControleurAdminModifierFiliere/?id="+$("#FID").val();
		                $(location).attr('href',url).delay(250);
		        }
		};
		
		xhr.open("GET", "../ControleurAdminModifierFiliere/ajouterM/?id="+$("#popUpID").val()+"&nom="+$("#popUpNom").val()+"&HC="+$("#popUpHC").val()+"&HTD="+$("#popUpHTD").val()+"&HTP="+$("#popUpHTP").val()+"&semestre="+$("#popUpSemestre").val(), true);

		xhr.send(null);
		}
    });



$("#newF").click(function(){

if($('#FNom').val().length != 0 && $('#selectResp').val() != null){
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
		                console.log(xhr.responseText);
		                closePopUp();
		                var url = "../ControleurAdminModifierFiliere/?id=new";
		                $(location).attr('href',url).delay(250);
		        }
		};
		
		xhr.open("GET", "../ControleurAdminModifierFiliere/creerF/?nom="+$("#FNom").val()+"&rid="+$("#selectResp").val(), true);

		xhr.send(null);
		}
    });


$('#Resp img[id^="MS"]').click(function(){

	var r=confirm("Êtes-vous sûr de vouloir supprimer cette matière ?");
if (r==true) {

			var xhr = null;

			var tr = this.parentNode.parentNode;
			console.log(tr);
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
	xhr.open("GET", "../ControleurAdminModifierFiliere/supprM?id="+this.id.substring(2), true);
	xhr.send(null);
}

});

$('#admin img[id^="FE"]').click(function(){
       var url = "../ControleurAdminHome/FE?id="+this.id.substring(2);
       $(location).attr('href',url);
});


	closePopUp();

});