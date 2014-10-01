
$(window).load(function(){ 

//simulation du hover sur l'image loupe
 var loupe = $("#loupeSearchBar");

loupe.mouseover(function () {
	$('#btnLoupe').addClass("hoverBtn");
});

loupe.mouseout(function () {
	$('#btnLoupe').removeClass("hoverBtn");
});

//simulation du click bouton sur l'image loupe
loupe.click(function(){
	$('#btnLoupe').click();
});


$("#enseignant").click(function(){
	console.log("enseignant click");
	if ($("#enseignant").hasClass("ferme") ){
	
		$("#enseignant").addClass("ouvert");
		$("#enseignant").removeClass("ferme");

		$("#responsable").addClass("ferme");
		$("#enseignant").removeClass("ouvert");
		
		
	}
});

$("#responsable").click(function(){
	console.log("responsable click");
	if ($("#responsable").hasClass("ferme") ){
		$("#responsable").addClass("ouvert");
		$("#responsable").removeClass("ferme");

		$("#enseignant").addClass("ferme");
		$("#responsable").removeClass("ouvert");
	}
});

});
 
