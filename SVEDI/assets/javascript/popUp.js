
$(window).load(function(){ 


/*-------POPUP functions------*/
var showPopUp = function showPopUp(){
	//$("#modal").show();
	$("#modal").css("visibility", "visible");
	$("#modal").css("opacity","1");
	$("#msgConflit").hide();
	$("#popUp input[type=text]").val("0");
	$("#inscriptionDiv").show();
	$("#confirmationDiv").hide();

}

var closePopUp = function closePopUp(){
	//$("#modal").hide();
	$("#modal").css("visibility", "hidden");
	$("#modal").css("opacity","0");

	$("#popUp input[type=text]").val("");
}

var showMsg = function showMsg(msg){
	console.log($("#msgInfo"));
	$("#inscriptionDiv").hide();

	$("#msgInfo").text(msg);
	$("#confirmationDiv").show();
}
/*----------------------------*/


$("#popUp input[type=text]").on('change',function(){
if($(this).val()==""){$(this).val(0);}
});
$("#popUp input[type=text]").on('blur',function(){
if($(this).val()==""){$(this).val(0);}
});
$("#popUp input[type=text]").on('focus',function(){
if($(this).val()=="0"){$(this).val("");}
});

/******* code prevention conflit *****/

$("#popUp input[type=text]").on('input',function(){
var conflit = false;

 	if ($("#inputHTP").val() > Number($("#TP_dispo").text())){
			conflit = true;
    }
   if ($("#inputHTD").val() > Number($("#TD_dispo").text())){
			conflit = true;
    }
    if ($("#inputHC").val() > Number($("#cours_dispo").text())){
			conflit = true;
    }

    if (conflit){
			$("#msgConflit").show();
    }else{
			$("#msgConflit").hide();
	}

});

/*************************************/


$("#content .resultSearch table tr td img").mouseover(function(){
	this.src = "../../assets/images/inscriptionHover.png";
});

$("#content .resultSearch table tr td img").mouseout(function(){
	this.src = "../../assets/images/inscription.png";
});

//futur code pour le click popUp inscription matière
var Dateclick = document.getElementById("centreDate");
var MaDateclick = Dateclick.innerText || Dateclick.textContent;

var d = new Date();
var DateActuelle = d.getFullYear();



if (MaDateclick >= DateActuelle){

	$("#content .resultSearch table tr td img").click(function(){
		showPopUp();
		
		var id = this.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3].id;
		
		var titre = document.getElementById("NomMatiere"+id);
		var monTitre = titre.innerText || titre.textContent;
		
		var txt = "la matiere " + monTitre;
		
		//var txt = this.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[17].innerText;

		$("#popUpTitleMatiere").text(txt);


	$("#TP_dispo").text($("#"+id+"-HTP").val());
	$("#TD_dispo").text($("#"+id+"-HTD").val());
	$("#cours_dispo").text($("#"+id+"-HC").val());
	$("#TP_max").text($("#"+id+"-HTPMAX").val());
	$("#TD_max").text($("#"+id+"-HTDMAX").val());
	$("#cours_max").text($("#"+id+"-HCMAX").val());
	$("#ID_Matiere").val(id);



	});


} else {

$('.ImgInscription').css('display', 'none');
	
}

//futur code pour le click validation inscription
function validationInscription(){

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
                showMsg(xhr.responseText);
        }
};

var DateI = document.getElementById("centreDate");
var MaDateI = DateI.innerText || DateI.textContent;

xhr.open("GET", $("#baseUrl").val()+"controleurInscription/inscription/"+$("#ID_Matiere").val()+"/"+$("#inputHC").val()+"/"+$("#inputHTD").val()+"/"+$("#inputHTP").val()+"/"+MaDateI+"/", true);
xhr.send(null);


};

$("#retourBtn").click(function(){
	closePopUp();
	location.reload().delay(250);
});

//add listener sur le click de fermeture
$(".closePopUp").click(closePopUp);

//Provisoir pck hover probleme 
/*
$("#modal").click(function(){
	if (!$("#popUp").is(':hover')) {
		closePopUp();
	}
});
*/

$("#validerPopUp").click(validationInscription);

closePopUp();

});