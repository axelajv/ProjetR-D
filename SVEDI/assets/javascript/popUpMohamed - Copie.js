
$(window).load(function(){ 

/*-------POPUP functions------*/
var showPopUp = function showPopUp(){
	//$("#modal").show();
	$("#modal").css("visibility", "visible");
	$("#modal").css("opacity","1");
}

var closePopUp = function closePopUp(){
	//$("#modal").hide();
	$("#modal").css("visibility", "hidden");
	$("#modal").css("opacity","0");
}
/*----------------------------*/

$("#content .resultSearch table tr td img").mouseover(function(){
	this.src = "../../assets/images/inscriptionHover.png";
});

$("#content .resultSearch table tr td img").mouseout(function(){
	this.src = "../../assets/images/inscription.png";
});

//futur code pour le click popUp inscription matière
$("#content .resultSearch table tr td img").click(function(){
	showPopUp();
	console.log(this.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3].firstChild.innerHTML);
	$("#popUpTitleMatiere").text(this.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3].firstChild.innerHTML);
	console.log(this.parentNode.parentNode.parentNode.parentNode.parentNode.childNodes[3].id);
});

//futur code pour le click validation inscription
var validationInscription = function(){
console.log("ok man tu es inscrit GG");
closePopUp();
};

//add listener sur le click de fermeture
$("#closePopUp").click(closePopUp);
$("#modal").click(function(){
	if (!$("#popUp").is(':hover')) {
	closePopUp();
	}
});
$("#validerPopUp").click(validationInscription);
closePopUp();
});