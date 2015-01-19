$(window).load(function(){

$('div#nav div#listNotifs div').dblclick(function(){

	var r=confirm("Êtes-vous sûr de vouloir supprimer cette notification ?");
	if (r==true) {
	
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
				
					location.reload(true);
	        }
	};
	
	xhr.open("GET",  "../ControleurHome/SuppNotif?id="+this.id, true);
	xhr.send(null);

	}
	
});





		


















});